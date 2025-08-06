		<?php if (isset($_SESSION['user']) && $_SESSION['user']['admin']): ?>
		<article id="userlist" class="panel">
			<header>
				<h2>Liste des utilisateurs</h2>
			</header>
			<table>
				<thead>
					<tr>
						<th>ID</th>
						<th>Login</th>
						<th>Prénom</th>
						<th>Nom</th>
						<th>Date d'inscription</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach (listUsers(getDb()) as $user): ?>
					<tr>
						<td><?php echo htmlspecialchars($user['id']); ?></td>
						<td><?php echo htmlspecialchars($user['login']); ?></td>
						<td><?php echo htmlspecialchars($user['prenom']); ?></td>
						<td><?php echo htmlspecialchars($user['nom']); ?></td>
						<td><?php echo htmlspecialchars($user['date']); ?></td>
					</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
		</article>
		<?php endif; ?>