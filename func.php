<?php
function getDB(): array {
	try {
		return [true, mysqli_connect('localhost', 'root', '', 'moduleconnexion')];
	}
	catch (Exception $e) {
		return [false, $e->getMessage()];
	}
}

function createUser(array $db, array $user) {
	$errors = [0, 0]; // login, pw
	switch (true) {
		case !array_filter($user):
			throw new Exception(errorHandler(55));
			break;
		case !$db[0]:
			throw new Exception(errorHandler(66));
			break;
		case empty($user['login']):
			$errors[0] = 1;
		case empty($user['password']):
			$errors[1] = 1;
		case empty($user['pwc']):
			$errors[1] += 2;
		case $user['password'] !== $user['pwc']:
			$errors[1] = 4;
		case mysqli_num_rows(mysqli_query($db[1], 'SELECT `login` FROM `utilisateurs` WHERE `login` = "'.htmlspecialchars($user['login']).'"')) != 0:
			$errors[0] = 2;
	}
	if (array_sum($errors) > 0) {
		throw new Exception(errorHandler(implode($errors)));
	}
	else {
		$date = $_SERVER['REQUEST_TIME'];
		$userPwd = password($user['password'], $date);
		mysqli_query($db[1], 'INSERT INTO `utilisateurs` (`login`, `prenom`, `nom`, `password`) VALUES ("'.htmlspecialchars($user['login']).'", "'.htmlspecialchars($user['prenom']).'", "'.htmlspecialchars($user['nom']).'", "'.$userPwd.'")');
		mysqli_query($db[1], 'INSERT INTO `date_inscription` (`date`, `id_utilisateur`) VALUES (FROM_UNIXTIME("'.$date.'"), "'.mysqli_insert_id($db[1]).'")');
		return true;
	}
	
}

function connectUser(array $db, array $user) {
	$errors = [0, 0]; // login, pw
	switch (true) {
		case !array_filter($user):
			throw new Exception(errorHandler('55'));
			break;
		case !$db[0]:
			throw new Exception(errorHandler('66'));
			break;
		case empty($user['login']):
			$errors[0] = 1;
		case empty($user['password']):
			$errors[1] = 1;
	}
	if (array_sum($errors) > 0) {
		throw new Exception(errorHandler(implode($errors)));
	}
	else {
		$result = mysqli_query($db[1], 'SELECT `utilisateurs`.`id` AS "id", `utilisateurs`.`login` AS `login`, `utilisateurs`.`prenom` AS `prenom`, `utilisateurs`.`nom` AS `nom`,UNIX_TIMESTAMP(`date_inscription`.`date`) AS "date", `password` FROM `utilisateurs` LEFT JOIN `date_inscription` ON `utilisateurs`.`id` = `date_inscription`.`id_utilisateur` WHERE `login` = "'.htmlspecialchars($user['login']).'"');
		if (mysqli_num_rows($result) == 0) {
			throw new Exception(errorHandler('30')); 
		}
		else {
			$userData = mysqli_fetch_assoc($result);
			if (!passwordVerify($user['password'], $userData['date'], $userData['password'])) {
				throw new Exception(errorHandler('05'));
			}
			else {
				unset($userData['password']);
				$userData['admin'] = isAdmin($db[1], $userData['id']);
				return $userData;
			}
		}
	}
}

function updateUser(array $db, array $user, array $userUpdate): bool {
	$errors = [0, 0]; // login, pw
	switch (true) {
		case !array_filter($userUpdate):
			throw new Exception(errorHandler('55'));
			break;
		case !$db[0]:
			throw new Exception(errorHandler('66'));
			break;
		case $userUpdate['password'] !== $userUpdate['pwc']:
			$errors[1] = 3;
	}
	$query = '';
	foreach ($userUpdate as $key => $value) {
		if (in_array($key, ['prenom', 'nom']) && !empty($value) && $user[$key] !== $value) {
			$query .= '`'.$key.'` = "'.htmlspecialchars($value).'", ';
		}
		if ($key === 'password' && !empty($value) && $user['password'] !== $value) {
			$query .= '`password` = "'.password($value, $user['date']).'", ';
		}
	}
	$query = rtrim($query, ', ');
	mysqli_query($db[1], 'UPDATE `utilisateurs` SET '.$query.' WHERE `id` = '.$user['id']);
	return true;
}

function listUsers(array $db, int $offset = 0): array {
	if (!$db[0]) {
		throw new Exception(errorHandler('66'));
	}
	$result = mysqli_query($db[1], 'SELECT `utilisateurs`.`id` AS "id", `utilisateurs`.`login` AS `login`, `utilisateurs`.`prenom` AS `prenom`, `utilisateurs`.`nom` AS `nom`,`date_inscription`.`date` AS "date" FROM `utilisateurs` LEFT JOIN `date_inscription` ON `utilisateurs`.`id` = `date_inscription`.`id_utilisateur` ORDER BY `utilisateurs`.`id` DESC LIMIT 20 OFFSET '.$offset*20);
	$users = [];
	while ($row = mysqli_fetch_assoc($result)) {
		$users[] = $row;
	}
	return $users;
}

function isAdmin(object $db, $id): bool {
	$result = mysqli_query($db, 'SELECT `id_utilisateur` FROM `admins` WHERE `id_utilisateur` = '.intval($id));
	return mysqli_num_rows($result) === 1;
}


function errorHandler(mixed $errorCode): string {
	$errorCode = sprintf("%02d", strval($errorCode));
	$errors = [
		'01' => 'Mot de passe vide',
		'02' => 'Confirmation du mot de passe vide',
		'03' => 'Mot de passe et confirmation du mot de passe vides',
		'04' => 'Les mots de passe ne correspondent pas',
		'05' => 'La combinaison identifiant/mot de passe est incorrecte', //pwd
		'10' => 'Identifiant vide',
		'20' => 'Identifiant déjà utilisé',
		'30' => 'La combinaison identifiant/mot de passe est incorrecte', //login
		'55' => 'Veuillez remplir tous les champs',
		'66' => 'Erreur de connexion à la base de données'
	];
	return $errors[$errorCode] ?? $errors['55'];
}

function password(string $password, int $salt): string {
	return password_hash('saltyicecream'.$password.$salt, PASSWORD_BCRYPT);
}

function passwordVerify(string $password, int $salt, string $hash): bool {
	return password_verify('saltyicecream'.$password.$salt, $hash);
}

function logout() {
	session_destroy();
	header('Location: index.php');
	exit;
}
?>