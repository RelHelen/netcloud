<?php if (!empty($contracts)) : ?>
    <?php foreach ($contracts as $contr) :
        debug($contr);
    ?>

        <div>
            <?php if (!empty($contract)) : ?>
                <?php if (!empty($device)) : ?>
                    <header class="panel-header">
                        <h3 class="panel-header__h3 ">
                            <span class="par accent-txt">SN</span>
                            <span class="val"><?= $device['dev_sernumber'] ?></span>
                        </h3>
                        <div class="signal">
                            <span class="signal__text">Дата сигнала</span>
                            <span class="signal__date error-bl">????</span>
                        </div>
                    </header>
                    <div class="p-tb devices">
                        <div class="box ">
                            <div class="devices-item">
                                <ul class="devices-detalies border-item">
                                    <li class="devices-detalies-item ">
                                        <span class="par par_dev spec-txt"><?= $device['dev_id_type'] ?> </span>

                                    </li>
                                    <li class="devices-detalies-item ">
                                        <span class="par par_rent">Стоимость аренды </span>
                                        <span class="val error-txt"><?= $device['dev_cost'] ?> р</span>
                                    </li>
                                    <li class="devices-detalies-item  ">
                                        <span class="par par_period">Период аренды </span>
                                        <span class="val "><?= $device['dev_period'] ?> дн</span>
                                    </li>
                                    <li class="devices-detalies-item  ">
                                        <span class="par par_clock">Дата аренды истекает </span>
                                        <span class="val error-txt"><?= $device['dev_date_exp'] ?> </span>
                                    </li>
                                    <li class="devices-detalies-item  ">
                                        <span class="par par_place">Место </span>
                                        <span class="val "><?= $device['dev_place'] ?></span>
                                    </li>
                                </ul>
                                <ul class="devices-contract">
                                    <li class="devices-contract-item">
                                        <a href="<?= PATH ?>/contracts/<?= $contract['contr_nomer'] ?>">
                                            <span class="par par_cotract lbl">Договор </span>
                                            <span class="val val_contract rbl">№<?= $contract['contr_nomer'] ?> от <?= $contract['contr_date_st'] ?></span>
                                        </a>
                                    </li>
                                    <li class="devices-contract-item">
                                        <span class="par par_cotract lbl">Адрес: </span>
                                        <span class="val val_contract rbl"><?= $contract['contr_adres_set'] ?></span>

                                    </li>
                                </ul>
                            </div>
                            <div class="devices-button">

                                <a class="btn" id="ctl-count-btn" href="<?= PATH ?>/contracts/<?= $contract['contr_nomer'] ?>"><span>Смотреть другие устройства</span></a>

                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endif; ?>
        </div>
    <?php endforeach; ?>
<?php endif; ?>