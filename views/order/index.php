<?php include ROOT . '/views/layouts/header.php'; ?>
<?php include ROOT . '/views/layouts/header_menu.php'; ?>
<?php include ROOT . '/views/layouts/menu.php'; ?>


<main class="mdl-layout__content mdl-color--grey-100">
    <div class="mdl-grid demo-content">
        <div class="demo-charts mdl-color--white mdl-shadow--2dp mdl-cell mdl-cell--12-col mdl-grid">
            <!-- Постраничная навигация -->
            <?php
            if ($count > 4): echo $pagination->get();
            endif;
            ?>
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th style="text-align: center; min-width: 33px;">№</th>
                            <th style="text-align: center; min-width: 90px;">Принял</th>
                            <th style="text-align: center; min-width: 120px;">Клиент</th>
                            <th style="text-align: center; min-width: 120px;">Устройство</th>
                            <th style="text-align: center; min-width: 230px;">Неисправность</th>
                            <th style="text-align: center; min-width: 50px;">Цена</th>
                            <th style="text-align: center; min-width: 90px;">Мастер</th>
                            <th style="text-align: center; min-width: 60px;"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($orderList as $orderItem): ?>
                            <tr role="row" class="drag <?=$this->getStatusClassTable($orderItem[0]['id_status'])?>">
                                <td style="text-align: center; min-width: 33px;">
                                    <?php echo $orderItem['id_orders'] ?>
                                </td>
                                <td style="text-align: center; min-width: 90px;">
                                    <?php echo $orderItem['manager_firstname'] . " " . $orderItem['manager_lastname'] ?>
                                    </br>
                                    <?php echo $orderItem['data'] ?>
                                </td>
                                <td style="text-align: center; min-width: 120px;">
                                    <?php echo $orderItem['firstname'] . " " . $orderItem['lastname'] ?>
                                    <br>
                                    <span style='opacity: .7;'>
                                        <?php echo $orderItem['phone'] ?>
                                    </span>
                                    <br>
                                    <span style='opacity: .7;'>
                                    <?php echo $orderItem['address'] ?>
                                    </span>
                                </td>
                                <td style="text-align: center; min-width: 120px;">
                                    <?php echo $orderItem['device_name'] ?>
                                    <br><?php echo $orderItem['brand_name'] ?>
                                    <br><?php echo $orderItem['model'] ?>
                                    <br><?php echo $orderItem['sn'] ?>
                                </td>
                                <td style="text-align: center; min-width: 230px;">
                                    <?php echo $orderItem['defect'] ?>
                                </td>
                                <td style="text-align: center; min-width: 50px;">
                                    Итого:<br>
                                    <?php echo $orderItem['price'] ?>
                                    <br>ЗП мастера<br>
                                    <?php echo $orderItem['price'] ?>
                                </td>
                                <td style="text-align: center; min-width: 90px;">
                                    <?php echo $orderItem['master_firstname'] . " " . $orderItem['master_lastname'] ?>
                                    <br>Дата опл.
                                </td>
                                <td style="text-align: center; min-width: 60px;">
                                    <a href='/order/edit/<?php echo $orderItem['id_orders'] ?>' class='btn btn-default btn-smile'><i class="material-icons">edit</i></a>
                                    <a href='/order/del/<?php echo $orderItem['id_orders'] ?>'  onClick='return window.confirm(\"Удалить ремонт?\")' class='btn btn-default btn-smile'><i class="material-icons">delete_forever</i></a>
                                    <a href='/order/pay/<?php echo $orderItem['id_orders'] ?>'  onClick='return window.confirm(\"Оплатить мастеру?\")' class='btn btn-default btn-smile'><i class="material-icons">shopping_cart</i></a></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <!-- Постраничная навигация -->
                <?php
                if ($count > 4): echo $pagination->get();
                endif;
                ?>
            </div>
        </div>
    </div>
</main>
<?php include ROOT . '/views/layouts/footer.php'; ?>