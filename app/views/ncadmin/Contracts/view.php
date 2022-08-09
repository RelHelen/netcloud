<section class="content-header">
    <ol class="breadcrumb ">
        <li class="breadcrumb-item"><a href="<?= ADMIN; ?>"><i class="fa fa-dashboard"></i> Главная</a>
        </li>
        <li class="breadcrumb-item"><a href="<?= ADMIN; ?>/contracts">Список договоров</a></li>
        <li class="breadcrumb-item" class="active">Договор</li>
    </ol>
</section>
<!-- Main content -->
<section class="card">
    <div class="card-header">
        <h3>Договор №
            <?php if (!empty($contract)) :
                echo $contract['contr_nomer'];
                if ($contract['contr_status'] == 1) : ?>
                    <a href="<?= ADMIN; ?>/contracts/change?id=<?= $contract['id']; ?>&status=1" class="btn btn-success btn-xs">Изменить</a>
                <?php endif; ?>
                <?php if ($contract['contr_status'] == 0) : ?>
                    <a href="<?= ADMIN; ?>/contracts/change?id=<?= $contract['id']; ?>&status=0" class="btn btn-default btn-xs">Одобрить</a>
                <?php endif; ?>

                <a href="<?= ADMIN; ?>/contracts/delete?id=<?= $contract['id']; ?>" class="btn btn-danger btn-xs delete">Удалить</a>
            <?php endif; ?>
        </h3>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <?php if (!empty($contract)) : ?>
                    <div class="box">
                        <div class="box-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover">

                                    <tbody>
                                        <th>Номер договора</th>
                                        <td><?= $contract['contr_nomer']; ?></td>
                                        </tr>
                                        <tr>
                                            <th>Заказчик</th>
                                            <td><?= $contract['cust_name']; ?></td>
                                        </tr>
                                        <tr>
                                            <th>Дата создания </th>
                                            <td><?= $contract['contr_date_st']; ?></td>
                                        </tr>
                                        <tr>
                                            <th>Срок действия</th>
                                            <td><?= $contract['contr_date_exp'];; ?></td>
                                        </tr>
                                        <tr>
                                            <th>Сумма аренды</th>
                                            <td><?= $contract['sum']; ?> </td>
                                        </tr>
                                        <tr>
                                            <th>Количество устройств</th>
                                            <td> </td>
                                        </tr>
                                        <tr>
                                            <th>Адрес</th>
                                            <td><?= $contract['contr_adres_set']; ?></td>
                                        </tr>
                                        <tr>
                                            <th>Статус</th>
                                            <td><?= $contract['contr_status'] ? 'Активен' : 'Новый'; ?></td>
                                        </tr>
                                        <tr>
                                            <th>Комментарий</th>
                                            <td><?= $contract['contr_comment'] ?></td>
                                        </tr>
                                    </tbody>

                                </table>
                                <!--
                            <table class="table table-bordered table-hover ">
                                <thead>
                                    <tr>
                                        <th>№</th>
                                        <th>Номер договора</th>
                                        <th>Клиент</th>
                                        <th>Статус</th>
                                        <th>Сумма</th>
                                        <th>Дата создания</th>
                                        <th>Срок действия</th>
                                        <th>Адрес</th>
                                        <th>Действие</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php
                                    if (!empty($contract)) :
                                        $i = 1;
                                    ?>
                                        <tr>
                                            <td><?= $i; ?></td>
                                            <td><?= $contract['contr_nomer']; ?></td>
                                            <td><?= $contract['cust_name']; ?></td>
                                            <td><?= $contract['contr_status'] ? 'Рабочий' : 'Новый'; ?></td>
                                            <td><?= $contract['sum']; ?> </td>
                                            <td><?= $contract['contr_date_st']; ?></td>
                                            <td><?= $contract['contr_date_exp']; ?></td>
                                            <td><?= $contract['contr_adres_set']; ?></td>
                                            <td><a href="<?= ADMIN; ?>/contracts/view?id=<?= $contract['id']; ?>"><i class="fa fa-fw fa-eye"></i></a> <a class="delete" href="<?= ADMIN; ?>/contract/delete?id=<?= $contract['id']; ?>"><i class="fa fa-fw fa-close text-danger"></i></a></td>
                                        </tr>
                                    <?php $i++;
                                    endif ?>

                                </tbody>
                            </table>
                            -->
                            </div>
                        </div>
                    </div>

                    <h3>Детали контракта</h3>
                    <div class="box">
                        <div class="box-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>№</th>
                                            <th>Тип</th>
                                            <th>Серийный номер</th>
                                            <th>Mac</th>
                                            <th>Место</th>
                                            <th>Аренда</th>
                                            <th>Дата н </th>
                                            <th>Дата к </th>
                                            <th>Включен </th>
                                            <th>Действие </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 0;
                                        foreach ($devices as $device) : $i++ ?>
                                            <tr>
                                                <td><?= $i ?></td>
                                                <td><?= $device['dev_id_type']; ?></td>
                                                <td><?= $device['dev_sernumber']; ?></td>
                                                <td><?= $device['dev_mac']; ?></td>
                                                <td><?= $device['dev_place']; ?></td>
                                                <td><?= $device['dev_cost']; ?></td>
                                                <td><?= $device['dev_date_st']; ?></td>
                                                <td><?= $device['dev_date_exp']; ?></td>
                                                <td><?= $device['dev_includ']; ?></td>
                                                <td><a href="<?= ADMIN; ?>/contracts/changedev?id=<?= $contract['id']; ?>"><i class="fa fa-pen text-success mr-3"></i></a>

                                                    <a class="delete" href="<?= ADMIN; ?>/contract/deletedev?id=<?= $contract['id']; ?>"><i class="fa fa-window-close text-danger"></i></a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
</section>
<!-- /.content -->