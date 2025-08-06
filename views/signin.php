		<article id="login" class="panel">
			<header>
				<h2>Se connecter</h2>
			</header>
			<form action="./connexion.php" method="post">
				<div class="row">
					<?php 
					if (isset($_SESSION['error'])): ?>
						<div class="col-12"><div class="redbox"><?php echo htmlspecialchars($_SESSION['error']) ?></div></div>
						<?php
					endif;
					unset($_SESSION['error']);
					?>
					<div class="col-12">
						<label for="login">Login</label>
						<input type="text" id="login" name="login" required>
					</div>
					<div class="col-12">
						<label for="password">Password</label>
						<input type="password" id="password" name="password" required>
					</div>
					<div class="col-12">
						<input type="submit" value="Envoyer" />
					</div>
				</div>
			</form>
		</article>