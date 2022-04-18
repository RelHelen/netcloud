<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- <title>Система оплаты ренты Сloud Rental</title>  -->
	<?php app\vendor\core\base\View::getMeta(); ?>
	<link rel="stylesheet" href="<?= PATH ?>css/reboot.css">
	<link rel="stylesheet" href="<?= PATH ?>css/bootstrap-grid.min.css">
	<link rel="stylesheet" href="<?= PATH ?>icons/style.css">
	<link rel="stylesheet" href="<?= PATH ?>css/style.css">
	<!-- <script src="<?= PATH ?>script/main.js" type="module"></script> -->

	<!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]
-->
</head>

<body>
	<div class="container cont_p">
		<header class="header">

			<nav class="nav-main">
				<div class="logo">
					<a href="index.php">
						<img class="logo__img" src="<?= PATH ?>img/logo.png" alt="">
					</a>
					<a href="index.php">
						<span class="logo__txt">cloud rental</span>
					</a>
				</div>
				<div class="menu">
					<div class="menu-hamburger">
						<input id="menu__toggle" type="checkbox" />
						<label class="menu__btn" for="menu__toggle">
							<span></span>
						</label>
						<ul class="menu__box">
							<li>
								<a class="menu__item" href="#">Главная</a>
							</li>
							<li>
								<a class="menu__item" href="#">Проекты</a>
							</li>
							<li>
								<a class="menu__item" href="#">Команда</a>
							</li>
							<li>
								<a class="menu__item" href="#">Блог</a>
							</li>
							<li>
								<a class="menu__item" href="#">Контакты</a>
							</li>
						</ul>
					</div>
				</div>
			</nav>

		</header>
		<main class="main" id="main">
			<header class="main-header ptl">
				<h2 class="main-header__h2">
					<?php
					echo  $this->title; //вывод заголовка

					?>
				</h2>
			</header>
			<section class="panel panel_view ptl">
				<?php

				require 'header-section.php';

				?>

				<!-- подключили шаблон layouts/default -->
				<?= $content ?>
			</section>

		</main>

		<footer class="footer">
			<div class="footer-contact">

			</div>
			<div class="footer-menu">
				<div class="footer-menu-item">
					<h4 class="footer-head">О сервисе</h4>
					<ul class="footer-menu-item-list">
						<li><a href="#">Возможности</a></li>
						<li><a href="#">Применение</a></li>
						<li><a href="#">Цены</a></li>

					</ul>
				</div>
				<div class="footer-menu-item">
					<h4 class="footer-head">Клиентам</h4>
					<ul class="footer-menu-item-list">
						<li><a href="#">Договора</a></li>
						<li><a href="#">Объекты</a></li>
						<li><a href="#">Оплата</a></li>
					</ul>
				</div>
				<div class="footer-menu-item">
					<h4 class="footer-head">Поддержка</h4>
					<ul class="footer-menu-item-list">
						<li><a href="#">Служба поддержки</a></li>
						<li><a href="#">Вопрос-ответ</a></li>

					</ul>
				</div>
			</div>
			<div class="footer-bottom">
				<div class="row">
					<div class="col">
						<span>&copy;</span>
						<span>Сloud Rental,</span>
						<span>2021г </span>
					</div>
					<div class="col"></div>
					<div class="col"></div>
				</div>
				<div class="row">
					<div class="col">
						<span>Согласие на обработку персональных данных (пользовательское соглашение)</span>
					</div>
					<div class="col"><span>Политика конфиденциальности </span> </div>
					<div class="col"><span>Использованиe Cookies
						</span></div>
				</div>
			</div>
		</footer>
		<hr>
		<p>
			<b>Rоличество запросов:</b>
		</p>
		<?= debug(\app\vendor\core\Db::$countSql) ?>
		<br>
		<p>
			<b>История запросов</b> <br>выполняемый запрос на странице в шаблоне default:
		</p>
		<?= debug(\app\vendor\core\Db::$queries) ?>
	</div>
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<?php
	foreach ($scripts as $script) {
		echo $script;
	}
	?>
</body>

</html>