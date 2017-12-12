<?php include ROOT . '/views/layouts/header.php'; ?>
<?php include ROOT . '/views/layouts/header_menu.php'; ?>
<?php include ROOT . '/views/layouts/menu.php'; ?>
<main class="mdl-layout__content mdl-color--grey-100">
    <div class="mdl-grid demo-content">
        <div class="demo-charts mdl-color--white mdl-shadow--2dp mdl-cell mdl-cell--12-col mdl-grid">
            <table class="table table-bordered table-hover" style="text-align: center; margin-bottom: 0px;">
                <thead>
                    <tr>
                        <th style="text-align: center;">Код</th>
                        <th style="text-align: center;">Наименование</th>
                        <th style="text-align: center;">Цена</th>
                        <th style="text-align: center;">Кол-во</th>
                        <th style="text-align: center;">Категория</th>
                        <th style="text-align: center;"></th>               
                    </tr>
                </thead>
                    <?php foreach ($partList as $partItem): ?>
                        <tr role="row" class="drag <?php echo Part::getPartStatusStyle($partItem['count']) ?>">
                            <td><?php echo $partItem['code'] ?></td>
                            <td><?php echo $partItem['parts_name'] ?></td>
                            <td><?php echo $partItem['price'] ?></td>
                            <td><?php echo $partItem['count'] ?></td>
                            <td><?php echo $partItem['id_category'] ?></td>
                            <td><a href='/part/edit/<?php echo $partItem['id_parts'] ?>' class='btn btn-default btn-smile'><i class="material-icons">edit</i></a>
                                <a href='/part/del/<?php echo $partItem['id_parts'] ?>'  onClick='return window.confirm(\"Удалить ремонт?\")' class='btn btn-default btn-smile'><i class="material-icons">delete_forever</i></a>
                                <a href='/part/pay/<?php echo $partItem['id_parts'] ?>'  onClick='return window.confirm(\"Оплатить мастеру?\")' class='btn btn-default btn-smile'><i class="material-icons">shopping_cart</i></a></td>
                        </tr>
                    <?php endforeach; ?>
                
            </table>
        </div>
    </div>
</main>
<?php include ROOT . '/views/layouts/footer.php'; ?>