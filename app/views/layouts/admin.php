<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <title>Система оплаты ренты Сloud Rental</title>  -->
    <!-- Meta  -->
    <?php echo $this->getMeta(); ?>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="<?= PATH ?>assets/fontawesome-free/css/all.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="<?= PATH ?>assets/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= PATH ?>assets/css/adminlte.min.css">

    <link rel="stylesheet" href="<?= PATH ?>assets/icons/style.css">
    <!-- <link rel="stylesheet" href="<?= PATH ?>css/style.css"> -->
    <!-- <script src="<?= PATH ?>script/main.js" type="module"></script> -->

    <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]
-->
</head>

<body class="hold-transition dark-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-dark">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button">
                        <i class="fas fa-bars"></i></a>
                </li>

            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- Messages Dropdown Menu -->
                <?php
                $this->getPart('a-prof-section');
                ?>
                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>
            </ul>
            <!-- /Right navbar links -->
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <!-- aside -->
        <?php
        $this->getPart('aside');
        ?>
        <!-- /.aside -->

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <main class="main">
                <header class="ptl">
                    <h2 class="main-header__h2">
                        <?php
                        echo  $this->title; //вывод заголовка
                        ?>
                    </h2>
                </header>
                <section class="panel panel_view ptl">
                    <?php
                    //$this->getPart('header-section');
                    //default_.php$this->getPart('navmain-section');

                    ?>
                    <?php if (isset($_SESSION['error'])) : ?>
                        <div class="alert alert-danger">
                            <?= $_SESSION['error'];
                            unset($_SESSION['error']); ?>
                        </div>
                    <?php endif; ?>

                    <?php if (isset($_SESSION['success'])) : ?>
                        <div class="alert alert-success">
                            <?= $_SESSION['success'];
                            unset($_SESSION['success']); ?>
                        </div>
                    <?php endif; ?>
                    <?= $content; ?>
                </section>
            </main>
            <hr>
            <p>
                <b>Rоличество запросов:</b>
            </p>
            <?= debug(\fw\core\Db::$countSql) ?>
            <br>
            <p>
                <b>История запросов</b> <br>выполняемый запрос на странице в шаблоне default:
            </p>
            <?= debug(\fw\core\Db::$queries) ?>

        </div><!-- /.content-wrapper -->

        <!-- Main Footer -->
        <footer class="main-footer">
            <!--
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
-->
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
                <!-- <div class="row">
					<div class="col">
						<span>Согласие на обработку персональных данных (пользовательское соглашение)</span>
					</div>
					<div class="col"><span>Политика конфиденциальности </span> </div>
					<div class="col"><span>Использованиe Cookies
						</span></div>
				</div> -->
            </div>
        </footer>


    </div> <!-- /.wrapper -->

    <script src="<?= PATH ?>assets/jquery.js"></script>
    <!-- Bootstrap -->
    <script src="<?= PATH ?>assets/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- overlayScrollbars -->
    <script src="<?= PATH ?>assets/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?= PATH ?>assets/js/adminlte.js"></script>
    <?php
    foreach ($scripts as $script) {
        echo $script;
    }
    ?>
</body>

</html>