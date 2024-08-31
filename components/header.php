<?php session_start(); ?>
<?php echo '<link rel="stylesheet" type="text/css" href="/css/header.css">'; ?>
<header class="main-header">
	<div class="container">
		<a href="/" class="logo">
				<img src="/img/logo.png" alt="Логотип магазина">
		</a>
		<nav class="main-menu" >
			<ul>
				<?php if(isset($_SESSION['auth']) && $_SESSION['auth'] === false) { ?>
				<li><a href="/public/register.php"><img src="/img/register.png" alt="регистрация" style="width: 35px; margin: 0px 15px;"></a></li>
				<li><a href="/public/login.php"><img src="/img/login.png" alt="авторизация" style="width: 35px; margin: 0px 15px;"></a></li>
				<?php } ?>
				<li><a href="/"><img src="/img/main-shop.png" alt="главная" style="width: 35px; margin: 0px 15px;"></a></li>
				<li><a href="/public/profile.php"><img src="/img/personal-profile.png" alt="личный кабинет" style="width: 35px; margin: 0px 15px;"></a></li>
				<?php if(isset($_SESSION['login']) && $_SESSION['login'] === 'admin') { ?>
					<li><a href="../admin/admin_panel.php"><img src="/img/management.png" alt="управление" style="width: 35px; margin: 0px 15px;"></a></li>
				<?php } ?>
			</ul>
		</nav>
	</div>
</header>

