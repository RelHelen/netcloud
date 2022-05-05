<?php
//echo 'index view Main    ';
?>
<?php if (!empty($menu)) : ?>
    <nav class="panel-nav">
        <ul class="panel-menu">
            <?php foreach ($menu as $list) : ?>
                <li class="panel-menu-item" id="<?= $list['title'] ?>">
                    <a class="panel-menu-link" href="<?= $list['title'] ?>"><?= $list['header'] ?></a>
                </li>
            <?php endforeach; ?>
        </ul>

    </nav>
<?php endif; ?>

<!-- <h3>Пользователь id=2</h3>
<b>Логин</b>
<?php
//echo ($user2[0]['users_login']);
//$menu2[0]['users_login'];  -->
?>