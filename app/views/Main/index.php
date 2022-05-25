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





<div class="row">
    <div class="col-12 col-sm-6 col-md-4">
        <div class="info-box">
            <!-- <span class="info-box-icon bg-info">
                <i class="fas fa-ruble-sign"></i>
            </span> -->

            <div class="info-box-content">
                <span class="par">Доступно на сегодня</span>
                <span class="">
                    <?php
                    date_default_timezone_set('UTC');
                    echo  date("m.d.Y"); ?>
                </span>
                <span class="info-box-number">
                    <span style="font-size: 1.5rem">
                        <?php if (!empty($balanse)) {
                            $balanse = $balanse ? $balanse : 0;
                            echo $balanse;
                        }
                        ?>
                    </span>
                    <small<i class="fas fa-ruble-sign"></i></small>
                </span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
    <!-- /.col -->
    <div class="col-12 col-sm-6 col-md-4">
        <div class="info-box">
            <!-- <span class="info-box-icon bg-danger"><i class="fas fa-thumbs-up"></i></span> -->

            <div class="info-box-content">
                <span class="par">С начала <?= date("M"); ?></span>

                <span class="info-box-number">
                    <p>
                        <span class="par">Расходы</span>
                        <span class="val">1000
                            <small<i class="fas fa-ruble-sign"></i></small>
                        </span>
                    </p>
                    <p>
                        <span class="par">Пополнения</span>
                        <span class="val">2000
                            <small<i class="fas fa-ruble-sign"></i></small>
                        </span>
                    </p>

                </span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
    <!-- /.col -->

    <div class="col-12 col-sm-6 col-md-4">
        <div class="info-box">
            <!-- <span class="info-box-icon bg-success elevation-1"><i class="fas fa-shopping-cart"></i></span> -->
            <div class="info-box-content">
                <span class="info-box-text mb-4">
                    Пополнить счет</span>

                <div class="ctl-count ">
                    <form action="#" class="ctl-count-form">
                        <button type="submit" class="btn" id="ctl-count-btn">
                            <span>Оплатить</span>
                        </button>
                    </form>
                </div>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
    <!-- /.col -->


</div>
<div>
    Доступные договора
    <?php if (!empty($contracts)) : ?>
        <div class="box contract">
            <?php foreach ($contracts as $contract) :
            ?>
                <a class="link-shadow link-contracts" id="<?= $contract['contr_nomer'] ?>" data-title="<?= $contract['contr_nomer'] ?>" data-id="<?= $contract['id'] ?>" href="<?= PATH ?>/contracts/<?= $contract['contr_nomer'] ?>" id="<?= $contract['id'] ?>">
                    <div class="contract-item">
                        <h3 class="contract-header">
                            Договор <?= $contract['contr_nomer'] ?> от <?= $contract['contr_date_st'] ?> </h3>
                        <ul class="contract-detalies">
                            <li class="contract-detalies-item">
                                <span class="par par_cotract lbl">Адрес: </span>
                                <span class="val val_contract rbl">
                                    <?= $contract['contr_adres_set'] ?> </span>
                            </li>

                            <li class="contract-detalies-item">
                                <span class="par par_cotract lbl">Сумма аренды: </span>
                                <span class="val val_contract rbl">
                                    <?php if (!empty($contract['cust'])) : ?>
                                        <?= $contract['cust'] ?>р/
                                    <?php endif; ?>

                                    <?php if (!empty($contract['period'])) : ?>
                                        <?= $contract['period']; ?>дней
                                    <?php endif; ?>

                                </span>
                            </li>

                        </ul>
                    </div>
                </a>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>