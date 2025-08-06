		<article id="profil" class="panel">
			<header>
				<h2>Profil</h2>
			</header>
			<form action="./update.php" method="post">
				<div class="row">
					<?php if (isset($_GET['error']) && isset($_SESSION['error'])): ?>
						<div class="col-12"><div class="redbox"><?php echo htmlspecialchars($_SESSION['error']) ?></div></div>
					<?php endif;?>
					<div class="col-12">
						<label for="login">Login</label>
						<div id="login"><?php echo htmlspecialchars($_SESSION['user']['login']); ?></div>
					</div>
					<div class="col-6 col-12-medium">
						<label for="prenom">Prénom</label>
						<input type="text" id="prenom" name="prenom" value="<?php echo htmlspecialchars($_SESSION['user']['prenom']); ?>" required>
					</div>
					<div class="col-6 col-12-medium">
						<label for="nom">Nom</label>
						<input type="text" id="nom" name="nom" value="<?php echo htmlspecialchars($_SESSION['user']['nom']); ?>" required>
					</div>
					<div class="col-12">
						<label for="password">Password</label>
						<input type="password" id="password" name="password">
					</div>
					<div class="col-12">
						<label for="pwc">Confirm Password</label>
						<input type="password" id="pwc" name="pwc">
					</div>
					<div class="col-12">
						<input type="submit" value="Envoyer" />
					</div>
				</div>
			</form>
		</article>