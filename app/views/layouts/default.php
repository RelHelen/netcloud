<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Default: Система оплаты ренты Сloud Rental</title> 

	<link rel="stylesheet" href="css/reboot.css">
	<link rel="stylesheet" href="icons/style.css">
	<link rel="stylesheet" href="css/style.css">

<!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->

</head>
<body><div class="container cont_p">
	<header class="header">		
			<nav class="nav-main">
				<div class="logo">
					<a href="#">
						<img class="logo__img" src="img/logo.png" alt="">
					</a>
					<a href="#">
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
						    	<a class="menu__item" href="#">Проекты</a></li>
						    <li>
						    	<a class="menu__item" href="#">Команда</a></li>
						    <li>
						    	<a class="menu__item" href="#">Блог</a></li>
						    <li>
						    	<a class="menu__item" href="#">Контакты</a></li>
						  </ul>
					</div>
				</div>
			</nav>
		
	</header>
	<main class="main">
	
    
			<header class="main-header ptl">
				<h2 class="main-header__h2">
					Default:: Ваши данные
				</h2>
			</header>
			<section class="panel panel_view ptl">
				<header class="panel-header">
					<ul class="panel-status">
						<li class="panel-status-item panel-balance panel-balance_limit">
							<span class="panel-par">Баланс:</span>
							<span class="panel-value panel-value_currency">27 000</span>	
						</li>
						<li class="panel-status-item panel-date panel-date_limit">
							<span class="panel-par">Дата списания:</span>
							<span class="panel-value">28.03.21</span>	
						</li>
					</ul>	
					<div class="ctl-count">			
						<form action="#" class="ctl-count-form">
							<button type="submit"class="ctl-count-btn" id="ctl-count-btn"><span>Пополнить счет</span></button>
						</form>
					</div>
				</header>
                <!-- подключили шаблон layouts/default -->
                <?=$content?>
                 <!--
				<nav class="panel-nav">
               
               
					<ul class="panel-menu">
						<li class="panel-menu-item" id="contracts">
							<a class="panel-menu-link" href="contracts.php">Договора</a>
						</li>
						<li class="panel-menu-item" id="devaces"><a class="panel-menu-link"  href="" >Объекты</a></li>
						<li class="panel-menu-item" id="operation"><a class="panel-menu-link"  href="">Операции по счету</a></li>
						<li class="panel-menu-item" id="personal"><a class="panel-menu-link"  href="">Личный кабинет</a></li>
					</ul>
				</nav>
                -->					
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
					<div class="col"><span>Политика конфиденциальности </span>	</div>
					<div class="col"><span>Использованиe Cookies
					 </span></div>
		   </div>
		</div>
	</footer>
</div>
</body>
</html>