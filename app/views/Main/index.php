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