<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Meta  -->
    <?php echo $this->getMeta(); ?>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="<?= PATH ?>/assets/fontawesome-free/css/all.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="<?= PATH ?>/assets/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= PATH ?>/assets/css/adminlte.min.css">

    <!-- <link rel="stylesheet" href="<?= PATH ?>/css/reboot.css">
	<link rel="stylesheet" href="<?= PATH ?>/css/bootstrap-grid.min.css"> -->
    <link rel="stylesheet" href="<?= PATH ?>/assets/icons/style.css">
    <link rel="stylesheet" href="<?= PATH ?>/css/style.css">
    <!-- <script src="<?= PATH ?>/script/main.js" type="module"></script> -->

    <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]
-->
</head>

<body class="hold-transition dark-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
    <div class="wrapper">
        <!-- Preloader -->
        <!-- <div class="preloader flex-column justify-content-center align-items-center">
			<img class="animation__wobble" class="logo__img" src="<?= PATH ?>/img/logo.png" alt="logo" height="60" width="60">
		</div> -->

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-dark">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button">
                        <i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="index3.html" class="nav-link">??????????????</a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="#" class="nav-link">????????????????</a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- Messages Dropdown Menu -->
                <?php
                $this->getPart('prof-section');
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
        //$this->getPart('aside'); 
        ?>
        <!-- /.aside -->

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <main class="main">
                <header class="ptl">
                    <h2 class="main-header__h2">
                        <?php
                        echo  $this->title; //?????????? ??????????????????
                        ?>
                    </h2>
                </header>
                <section class="panel panel_view ptl">
                    <?php
                    //$this->getPart('header-section');
                    //$this->getPart('navmain-section');

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
                <b>R?????????????????? ????????????????:</b>
            </p>
            <?= debug(\fw\core\Db::$countSql) ?>
            <br>
            <p>
                <b>?????????????? ????????????????</b> <br>?????????????????????? ???????????? ???? ???????????????? ?? ?????????????? default:
            </p>
            <?= debug(\fw\core\Db::$queries) ?>

        </div><!-- /.content-wrapper -->

        <!-- Main Footer -->
        <footer class="main-footer">
            <!--
			<div class="footer-menu">
				<div class="footer-menu-item">
					<h4 class="footer-head">?? ??????????????</h4>
					<ul class="footer-menu-item-list">
						<li><a href="#">??????????????????????</a></li>
						<li><a href="#">????????????????????</a></li>
						<li><a href="#">????????</a></li>

					</ul>
				</div>
				<div class="footer-menu-item">
					<h4 class="footer-head">????????????????</h4>
					<ul class="footer-menu-item-list">
						<li><a href="#">????????????????</a></li>
						<li><a href="#">??????????????</a></li>
						<li><a href="#">????????????</a></li>
					</ul>
				</div>
				<div class="footer-menu-item">
					<h4 class="footer-head">??????????????????</h4>
					<ul class="footer-menu-item-list">
						<li><a href="#">???????????? ??????????????????</a></li>
						<li><a href="#">????????????-??????????</a></li>

					</ul>
				</div>
			</div>
-->
            <div class="footer-bottom">
                <div class="row">
                    <div class="col">
                        <span>&copy;</span>
                        <span>??loud Rental,</span>
                        <span>2021?? </span>
                    </div>
                    <div class="col"></div>
                    <div class="col"></div>
                </div>
                <!-- <div class="row">
					<div class="col">
						<span>???????????????? ???? ?????????????????? ???????????????????????? ???????????? (???????????????????????????????? ????????????????????)</span>
					</div>
					<div class="col"><span>???????????????? ???????????????????????????????????? </span> </div>
					<div class="col"><span>????????????????????????e Cookies
						</span></div>
				</div> -->
            </div>
        </footer>


    </div> <!-- /.wrapper -->

    <script src="<?= PATH ?>/assets/jquery.js"></script>
    <!-- Bootstrap -->
    <script src="<?= PATH ?>/assets/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- overlayScrollbars -->
    <script src="<?= PATH ?>/assets/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?= PATH ?>/assets/js/adminlte.js"></script>
    <?php
    foreach ($scripts as $script) {
        echo $script;
    }
    ?>
</body>

</html>