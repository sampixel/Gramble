<div class="main-form-div">	
	<span class="main-form-title">Join our Community ! :D</span>
	<br>
	<form class="main-form" action="" method="post">
		<input class="form-input" name="username" type="text" placeholder="username">
		<br>
		<input class="form-input" name="password" type="password" placeholder="password">
		<br>
		<input class="form-input" name="address" type="text" placeholder="address">
		<br>
		<button class="form-button" name="submit" type="submit">Submit</button>
	</form>
</div>
<div>
	<?php if (!empty($submitted)): ?>
		<h3>Cogratulations <?= $submitted["username"] ?> !</h3>
		<span>These are your credentials:</span>
		<br>
		<ul>
			<li>Password: <?= $submitted["password"] ?></span></li>
			<li>Address: <?= $submitted["address"] ?></span></li>
		</ul>
	<?php endif ?>
</div>