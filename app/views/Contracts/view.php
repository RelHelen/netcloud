<!--  Устройства по договору-->
<?php if (!empty($contract)) :  ?>
    <div class="contract">
        id= <?= $contract['id'] ?>
        <div class="contract-item">
            <h3 class="contract-header">
                Договор <?= $contract['contr_nomer'] ?> от <?= $contract['contr_date_st'] ?>
            </h3>
            <ul class="contract-detalies">
                <li class="contract-detalies-item">
                    <span class="par par_cotract lbl">Адрес: </span>
                    <span class="val val_contract rbl"><?= $contract['contr_adres_set'] ?></span>
                </li>
                <li class="contract-detalies-item">
                    <span class="par par_cotract lbl">Сумма аренды: </span>
                    <span class="val val_contract rbl"><?= $contract['cust'] ?>р/<?= $contract['period'] ?>дней</span>
                </li>
                <li class="contract-detalies-item">
                    <span class="par par_cotract lbl">Стоимость оборудования: : </span>
                    <span class="val val_contract rbl">2000р</span>
                </li>
                <li class="contract-detalies-item">
                    <span class="par par_cotract lbl">Дата списания: </span>
                    <span class="val val_contract rbl"> 21.02.2022г</span>
                </li>
            </ul>
        </div>

    </div>
    <?php if (!empty($devices)) : ?>

        <div class="p-tb devices">
            <h4 class="devices-header">Устройства объекта:</h3>
                <div class="box ">
                    <?php foreach ($devices as $res) : ?>
                        <div class="devices-item">
                            <a href="#" class="link-shadow">
                                <ul class="devices-detalies">
                                    <li class="devices-detalies-item">
                                        <span class="par par_dev">Номер устройства </span>
                                        <span class="val "> <?= $res['dev_sernumber']; ?></span>
                                    </li>
                                    <li class="devices-detalies-item">
                                        <span class="par par_rent">Аренда </span>
                                        <span class="val "><?= $res['dev_cost']; ?>р / <?= $res['dev_period']; ?>дней</span>
                                    </li>
                                    <li class="devices-detalies-item">
                                        <span class="par par_clock">Дата списания </span>
                                        <span class="val ">24.07.2021</span>
                                    </li>
                                    <li class="devices-detalies-item">
                                        <span class="par par_place">Место </span>
                                        <span class="val "> <?= $res['dev_place']; ?> </span>
                                    </li>
                                </ul>
                            </a>
                        </div>


                    <?php endforeach; ?>
                </div>
        </div>

    <?php endif; ?>
<?php endif; ?>