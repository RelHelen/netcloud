<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?= PATH ?>" class="brand-link">
        <img src="img/logo.png" alt="Logo" class="brand-image   ">
        <span class="logo__txt">cloud rental</span>
    </a>
    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-2 nav__main">

            menu
            <?php
            //подключаем виджет меню
            new \app\widgets\menu\Menu([
                //можно задавать параметры меню
                'tpl' => WWW . '/menu/menu.php',
                'cacheTime' => false,
                'container' => 'ul',
                'class' => 'nav nav-pills nav-sidebar flex-column menu',
                'table' => 'menu',
                'attrs' => [
                    'style' => 'color:green;',
                    'id' => 'menu',
                ]

            ]); ?>



        </nav>
        <!-- /.sidebar-menu -->
    </div>

    <!-- /.sidebar -->
</aside>