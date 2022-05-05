<?php $parent = isset($category['childs']);
?>

<!-- выводим меню -->
<li class="nav-item">
    <a class="nav-link" href="<?= PATH . '/' . $category['title']; ?>">
        <?= $category['header']; ?>
    </a>
    <?php if (isset($category['childs'])) : ?>
        <ul class="nav">
            <?= $this->getMenuHtml($category['childs']); ?>
        </ul>
    <?php endif; ?>
</li>