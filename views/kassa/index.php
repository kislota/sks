<?php include ROOT . '/views/layouts/header.php'; ?>
<?php include ROOT . '/views/layouts/header_menu.php'; ?>
<?php include ROOT . '/views/layouts/menu.php'; ?>
<main class="mdl-layout__content mdl-color--grey-100">
    <div class="mdl-grid demo-content">
        <div class="demo-charts mdl-color--white mdl-shadow--2dp mdl-cell mdl-cell--12-col mdl-grid">
            <div class="table-responsive">
                <table class="table table-bordered table-hover" style="text-align: center; margin-bottom: 0px;">
                    <thead>
                        <tr>
                            <th style="text-align: center; min-width: 33px;">№</th>
                            <th style="text-align: center; min-width: 33px;">Приход</th>
                            <th style="text-align: center; min-width: 33px;">Расход</th>
                            <th style="text-align: center; min-width: 33px;">Назначение платежа</th>
                            <th style="text-align: center; min-width: 33px;">Дата</th>
                            <th style="text-align: center; min-width: 33px;">Комментарий</th>
                            <th style="text-align: center; min-width: 33px;">Провел платёж</th>
                            <th style="text-align: center; min-width: 33px;">В кассе: <?php Kassa::getKassaTotalMoney(); ?></th>
                        </tr>
                    </thead>
                    <?php if (isset($kassaList) && is_array($kassaList)): ?>
                        <?php foreach ($kassaList as $kassaItem): ?>
                    <tr role="row" class="drag <?=Kassa::getKassaPayStyle($kassaItem['coming'], $kassaItem['cost'])?>">
                                <td><?php echo $kassaItem['id'] ?></td>
                                <?php if ($kassaItem['coming'] >= 0): ?>
                                    <td><?php echo $kassaItem['coming'] ?></td>
                                <?php endif; ?>
                                <?php if ($kassaItem['cost'] <= 0): ?>
                                    <td><?php echo $kassaItem['cost'] ?></td>
                                <?php endif; ?>
                                <td><?php echo $kassaItem['id_users'] . $kassaItem['id_clients'] . $kassaItem['id_orders'] . $kassaItem['id_parts'] . $kassaItem['id_sales'] ?></td>
                                <td><?php echo $kassaItem['data'] ?></td>
                                <td><?php echo $kassaItem['comment'] ?></td>
                                <td><?php echo $kassaItem['pay_user'] ?></td>
                                <td><a href='/kassa/edit/<?php echo $kassaItem['id'] ?>' class='btn btn-default btn-smile'><i class="material-icons">edit</i></a>
                                    <a href='/kassa/del/<?php echo $kassaItem['id'] ?>'  onClick='return window.confirm(\"Удалить ремонт?\")' class='btn btn-default btn-smile'><i class="material-icons">delete_forever</i></a></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>

                </table>
            </div>
        </div>
    </div>
</main>
<?php include ROOT . '/views/layouts/footer.php'; ?>