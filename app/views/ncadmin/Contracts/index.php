<section class="content-header">
    <ol class="breadcrumb ">
        <li class="breadcrumb-item"><a href="<?= ADMIN; ?>"><i class="fa fa-dashboard"></i> Главная</a>
        </li>
        <li class="breadcrumb-item" class="active">Список договоров</li>
    </ol>
</section>
<!-- Main content -->
<section class="card">
    <div class="card-header">
        <h3 class="card-title">Список договоров</h3>
    </div>
    <div class="card-body">

        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover table-hover__row">
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
                                    $i = 1;
                                    foreach ($contracts as $contract) : ?>
                                        <?php

                                        $class = $contract['contr_status'] ? 'bg-lite' : 'bg-grey'; ?>

                                        <tr class="<?= $class; ?>" data-id="<?= $contract['id']; ?>">
                                            <td><?= $i; ?></td>
                                            <td><?= $contract['contr_nomer']; ?></td>
                                            <td><?= $contract['cust_name']; ?></td>
                                            <td><?= $contract['contr_status'] ? 'Рабочий' : 'Новый'; ?></td>
                                            <td><?= $contract['sum']; ?> </td>
                                            <td><?= $contract['contr_date_st']; ?></td>
                                            <td><?= $contract['contr_date_exp']; ?></td>
                                            <td><?= $contract['contr_adres_set']; ?></td>
                                            <td>
                                                <a href="<?= ADMIN; ?>/contracts/view?id=<?= $contract['id']; ?>"><i class="fa fa-fw fa-eye mr-2"></i></a>

                                                <a href="<?= ADMIN; ?>/contracts/change?id=<?= $contract['id']; ?>"><i class="fa fa-pen text-success mr-2"></i></a>

                                                <a class="delete" href="<?= ADMIN; ?>/contract/delete?id=<?= $contract['id']; ?>"><i class="fa fa-window-close text-danger"></i></a>
                                            </td>
                                        </tr>

                                    <?php $i++;
                                    endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="d-flex flex-column align-items-center">
                            <p>(<?= count($contracts); ?> заказа(ов) из <?= $count; ?>)</p>
                            <?php if ($pagination->countPages > 1) : ?>
                                <?= $pagination; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- /.content -->