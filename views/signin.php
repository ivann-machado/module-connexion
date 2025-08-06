		<article id="login" class="panel">
			<header>
				<h2>Se connecter</h2>
			</header>
			<form action="./connexion.php" method="post">
				<div class="row">
					<?php if ((isset($_GET['error']) && isset($_SESSION['error']))XOR (isset($_GET['success']) && isset($_SESSION['success']))): ?>
						<div class="col-12"><div class="<?php echo isset($_SESSION['error']) ? 'red' : 'green'?>box"><?php echo isset($_SESSION['error']) ? htmlspecialchars($_SESSION['error']) : htmlspecialchars($_SESSION['success']) ?></div></div>
					<?php endif;?>
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