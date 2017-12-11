<?php include ROOT . '/views/layouts/header.php'; ?>
<?php include ROOT . '/views/layouts/header_menu.php'; ?>
<?php include ROOT . '/views/layouts/menu.php'; ?>
<main class="mdl-layout__content mdl-color--grey-100">
    <div class="mdl-grid demo-content">
        <div class="demo-charts mdl-color--white mdl-shadow--2dp mdl-cell mdl-cell--12-col mdl-grid">
            <!-- Постраничная навигация -->
            <?php echo $pagination->get(); ?>
            <table class="table table-bordered table-hover" style="text-align: center; margin-bottom: 0px;">
                <thead>
                    <tr>
                        <th style="text-align: center;">№</th>
                        <th style="text-align: center;">Принял</th>
                        <th style="text-align: center;">Клиент</th>
                        <th style="text-align: center;">Устройство</th>
                        <th style="text-align: center;">Неисправность</th>
                        <th style="text-align: center;">Цена</th>
                        <th style="text-align: center;">Мастер</th>
                        <th style="text-align: center;"></th>               
                    </tr>
                </thead>
                <?php foreach ($orderList as $orderItem): ?>
                    <tr role="row" class="drag">
                        <td><?php echo $orderItem['id'] ?></td>
                        <td>Менеджер</td>
                        <td><?php echo $orderItem['firstname'] ?> <?php echo $orderItem['lastname'] ?><br><span style='opacity: .7;'><?php echo $orderItem['phone'] ?></span></td>
                        <td>Техника<br>Бренд<br>Модель<br>Серийный номер</td>
                        <td><?php echo $orderItem['defect'] ?></td>
                        <td><?php echo $orderItem['price'] ?><br>ЗП мастера<br>ЗП Joto</td>
                        <td>Мастер<br>Дата опл. мастеру<br>Дата опл. joto</td>
                        <td>
                            <a href='/trash/undel/<?php echo $orderItem['id'] ?>'  onClick='return window.confirm(\"Удалить ремонт?\")' class='btn btn-default btn-smile'>
                                <i class="material-icons">delete_forever</i>
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
            <!-- Постраничная навигация -->
            <?php echo $pagination->get(); ?>
        </div>
    </div>
</main>
<?php include ROOT . '/views/layouts/footer.php'; ?>