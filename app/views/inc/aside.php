<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?= ADMIN ?>" class="brand-link">
        <img src="img/logo.png" alt="Logo" class="brand-image   ">
        <span class="logo__txt">cloud rental</span>
    </a>
    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-2 nav__main">
            <p class="light-header">
                <i class="fas fa-bars"></i> админ меню
            </p>
            <ul class="nav nav-sidebar flex-column " data-widget="treeview" role="menu" data-accordion="false">

                <?php if (isset($_SESSION['user'])) :
                    // debug($_SESSION['user']);
                    //меню для админки
                    $this->getPart('a-sidebar-section');
                ?>
                <?php endif;  ?>

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>

    <!-- /.sidebar -->
</aside>