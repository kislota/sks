<?php include ROOT . '/views/layouts/header.php'; ?>
<?php include ROOT . '/views/layouts/header_menu.php'; ?>
<?php include ROOT . '/views/layouts/menu.php'; ?>
<main class="mdl-layout__content mdl-color--grey-100">
    <div class="mdl-grid demo-content">
        <div class="demo-charts mdl-color--white mdl-shadow--2dp mdl-cell mdl-cell--12-col mdl-grid">
            <table class="table table-bordered table-hover" style="text-align: center; margin-bottom: 0px;">
                <thead>
                    <tr>
                        <th style="text-align: center;">ID</th>
                        <th style="text-align: center;">Имя Фамилия</th>
                        <th style="text-align: center;">Телефон</th>
                        <th style="text-align: center;">Адресс</th>
                        <th style="text-align: center;">Статус</th>
                        <th style="text-align: center;"></th>               
                    </tr>
                </thead>
                    <?php foreach ($clientList as $clientItem): ?>
                <tr role="row" class="drag <?php echo Settings::getStatusClassTable($clientItem['problem']) ?>">
                            <td><?php echo $clientItem['id_client'] ?></td>
                            <td><?php echo $clientItem['firstname'] . $clientItem['lastname'] ?></td>
                            <td><?php echo $clientItem['phone'] ?></td>
                            <td><?php echo $clientItem['address'] ?></td>
                            <td><?php echo $clientItem['problem'] ?></td>
                            <td><a href='/part/edit/<?php echo $clientItem['id'] ?>' class='btn btn-default btn-smile'><i class="material-icons">edit</i></a>
                                <a href='/part/del/<?php echo $clientItem['id'] ?>'  onClick='return window.confirm(\"Удалить ремонт?\")' class='btn btn-default btn-smile'><i class="material-icons">delete_forever</i></a>
                                <a href='/part/pay/<?php echo $clientItem['id'] ?>'  onClick='return window.confirm(\"Оплатить мастеру?\")' class='btn btn-default btn-smile'><i class="material-icons">shopping_cart</i></a></td>
                        </tr>
                    <?php endforeach; ?>
                
            </table>
        </div>
    </div>
</main>
<?php include ROOT . '/views/layouts/footer.php'; ?>