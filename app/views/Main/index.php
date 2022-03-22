<?php
echo 'index view Main    ';
echo __FILE__;
//echo "<h2>$hi</h2>";

?>
<!-- <?=$name?>;
<?=$mas['user']?>; -->
<?php if (!empty($res)): ?>
    <?php foreach($res as $item): ?>
    <li> <?=$item['name']?> </li>
    <?php endforeach; ?>
<?php endif; ?>

<h3>Пункт меню <b><?=$list[0]['name']?> </b></h3>
<!--  
    [0] => Array
        (
            [id_menu] => 1
            [name] => contracts
            [page] => main
        )
 -->