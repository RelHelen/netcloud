<section class="device">
    <?php if (!empty($contracts)) : ?>
        <?php foreach ($contracts as $contract) : ?>
            <!-- <artical class="devices-items"> -->
            <?php if (!empty($contract)) : ?>
                <?php if (!empty($contract['devices'])) : ?>
                    <?php foreach ($contract['devices'] as $devices) : ?>
                        <div class="device-item ">
                            <header class="device-header panel-header">
                                <h3 class="panel-header__h3 ">
                                    <span class="par accent-txt">SN</span>
                                    <span class="val"><?= $devices['dev_sernumber'] ?></span>
                                </h3>
                                <div class="signal">
                                    <span class="signal__text">Дата сигнала</span>
                                    <span data-date="" class="signal__date error-bl">????</span>
                                </div>
                            </header>
                            <div class="device-box p-tb ">
                                <div class="box ">
                                    <div class="devices-item">
                                        <ul class="devices-detalies border-item">
                                            <li class="devices-detalies-item ">
                                                <span class="par par_dev spec-txt"><?= $devices['dev_id_type'] ?> </span>
                                            </li>
                                            <li class="devices-detalies-item ">
                                                <span class="par par_rent">Стоимость аренды </span>
                                                <span data-cost="<?= $devices['dev_cost'] ?>" class="val error-txt"><?= $devices['dev_cost'] ?> р</span>
                                            </li>
                                            <li class="devices-detalies-item  ">
                                                <span class="par par_period">Период аренды </span>
                                                <span data-period="<?= $devices['dev_period'] ?>" class="val "><?= $devices['dev_period'] ?> дн</span>
                                            </li>
                                            <li class="devices-detalies-item  ">
                                                <span class="par par_clock">Дата аренды истекает </span>
                                                <span data-dateexp="<?= $devices['dev_date_exp'] ?>" class="val error-txt"><?= $devices['dev_date_exp'] ?> </span>
                                            </li>
                                            <li class="devices-detalies-item  ">
                                                <span class="par par_place">Место </span>
                                                <span class="val "><?= $devices['dev_place'] ?></span>
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

                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            <?php endif; ?>
            <!-- </artical> -->
        <?php endforeach; ?>
    <?php endif; ?>
</section>