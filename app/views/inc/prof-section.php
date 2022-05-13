<?php if (isset($_SESSION['user'])) : ?>
    <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="far fa-comments"></i>
            <span class="badge badge-danger navbar-badge">2</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <a href="#" class="dropdown-item">
                <!-- Message Start -->
                <div class="media">
                    <div class="media-body">
                        <h3 class="dropdown-item-title">
                            Система оплаты
                            <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                        </h3>
                        <p class="text-sm">Вам необходимо внести сумму по договору №1111 до 10.07.2022</p>
                        <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i>30.06.2022</p>
                    </div>
                </div>
                <!-- Message End -->
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
                <!-- Message Start -->
                <div class="media">
                    <div class="media-body">
                        <h3 class="dropdown-item-title">
                            Система оплаты
                            <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                        </h3>
                        <p class="text-sm">Срок аренды заканчивается 30.06.2022</p>
                        <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i>29.06.2022</p>
                    </div>
                </div>
                <!-- Message End -->
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
        </div>
    </li>
    <li class="nav-item">
        <a href="<?= PATH ?> " class="nav-link" role="button">
            <p class="text-sm"><i class="far fa-user"></i>
                <?php
                // debug($_SESSION['user']);
                echo $_SESSION['user']['users_login']; ?>

            </p>
        </a>
    </li>
    <li class="nav-item">
        <a href="<?= PATH ?>/user/logout" class="nav-link" role="button">
            <p class="text-sm"><i class="fas fa-sign-out-alt mr-1"></i> Выйти</p>
            <!-- Alexander Pierce -->
        </a>
    </li>
<?php
else : ?>
    <li class="nav-item">
        <a href="<?= PATH ?>/user/login" class="nav-link" role="button">
            <p class="text-sm"><i class="far fa-user"></i>
                Войти
            </p>
        </a>
    </li>
    <li class="nav-item">
        <a href="<?= PATH ?>/user/singup" class="nav-link" role="button">
            <p class="text-sm">
                Регистрация</p>
            <!-- Alexander Pierce -->
        </a>
    </li>

<?php endif;  ?>