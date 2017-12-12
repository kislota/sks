<?php include ROOT . '/views/layouts/header.php'; ?>
<?php include ROOT . '/views/layouts/header_menu.php'; ?>
<?php include ROOT . '/views/layouts/menu.php'; ?>
<main class="mdl-layout__content mdl-color--grey-100">
    <div class="mdl-grid demo-content">
        <form method="post" action="/order/edit/<?php echo $orderItem['id_orders'] ?>">
            <div class="form-group">
                <div class="col-sm-3">
                    <select class="form-control" name="id_status">
                        <?php foreach ($status as $stat): ?>
                            <option 
                            <?php
                            if ($orderItem['id_status'] == $stat['id_status']) {
                                echo "selected='selected'";
                            }
                            ?>
                                value="<?php echo $stat['id_status']; ?>">
                                    <?php echo $stat['status_name']; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-sm-9">
                    <div class="btn-group">
                        <a class="btn btn-default" data-toggle="collapse" title="Вызов специалиста" href="#id_help">Вызов</a>
                        <a class="btn btn-default" data-toggle="collapse" title="Ячейка" href="#cell">Ячейка</a>
                        <a class="btn btn-default" data-toggle="collapse" title="История" href="#history">История | '12'</a>
                        <a class="btn btn-default" target="_blank" title="Печать" href="/print/order/<?php echo $orderItem['id_orders'] ?>">Печать</a>
                        <a class="btn btn-default" target="_blank" title="Добавить ремонт от этого клиента" href="/order/add/<?php echo $orderItem['id_client'] ?>">+ ремонт</a>
                    </div>
                </div>
            </div>
            <div class="collapse form-group" id="cell">
                <div class="col-sm-12">
                    <h3>Выберите ячейку хранения</h3>
                    <label class="btn btn-default ">
                        <input type="radio" name="cell" 
                               onmousedown="this.isChecked = this.checked;" onclick="this.checked = !this.isChecked;" 
                               value="1" id="option1" autocomplete="off"> 1
                    </label>
                    <label class="btn btn-default ">
                        <input type="radio" name="cell" disabled value="1" id="option1" autocomplete="off"> 2
                    </label>
                </div>
            </div>
            </br>
            <div class="form-group">
                <div class="col-sm-4">
                    <input type="text" required name="firstname" id="firstname" autocomplete="off" class="form-control" placeholder="Имя" value="<?php echo $orderItem['clientfname'] ?>">
                </div>
                <div class="col-sm-4">
                    <input type="text" required name="lastname" id="lastname" autocomplete="off" class="form-control" placeholder="Фамилия" value="<?php echo $orderItem['clientlname'] ?>">
                </div>
                <div class="col-sm-4">
                    <input type="text" id="phone" name="phone" required autocomplete="off" class="form-control" placeholder="Телефон" value="<?php echo $orderItem['phone'] ?>">
                </div>
            </div>
            </br>
            <div class="collapse form-group" id="id_help">
                <div class="col-sm-12">
                    <input type="text" name="address" autocomplete="off" class="form-control" placeholder="Адрес клиента" value="<?php echo $orderItem['address'] ?>">
                </div>
                </br>
            </div>
            </br>
            <div class="form-group">
                <div class="col-sm-3">
                    <select class="form-control" name="id_device">
                        <?php foreach ($device as $deviceItem): ?>
                            <option <?php
                            if ($orderItem['id_device'] == $deviceItem['id_device']) {
                                echo "selected='selected'";
                            }
                            ?>
                                value="<?php echo $deviceItem['id_device']; ?>">
                                    <?php echo $deviceItem['device_name']; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-sm-3">
                    <select class="form-control" name="id_brand">
                        <?php foreach ($brands as $brandItem): ?>
                            <option 
                            <?php
                            if ($orderItem['id_brand'] == $brandItem['id_brand']) {
                                echo "selected='selected'";
                            }
                            ?>
                                value="<?php echo $brandItem['id_brand']; ?>">
                                    <?php echo $brandItem['brand_name']; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-sm-3">
                    <input type="text" name="model" autocomplete="off" class="form-control" placeholder="Модель" value="<?php echo $orderItem['model'] ?>">
                </div>
                <div class="col-sm-3">
                    <input type="text" name="sn" autocomplete="off" class="form-control" placeholder="Серийный номер" value="<?php echo $orderItem['sn'] ?>">
                </div>
            </div>
            </br>
            <div class="form-group">
                <div class="col-sm-12">
                    <input type="text" name="defect" autocomplete="off" class="form-control" placeholder="Неисправность" value="<?php echo $orderItem['defect'] ?>">
                </div>
            </div>
            </br>
            <div class="form-group">
                <div class="col-sm-4">
                    <input type="text" name="complit" autocomplete="off" class="form-control" placeholder="Комплектация" value="<?php echo $orderItem['complit'] ?>">
                </div>
                <div class="col-sm-4">
                    <select class="form-control" name="id_master">
                        <?php foreach ($users as $userItem): ?>
                            <option  <?php
                            if ($orderItem['id_master'] == $userItem['id_user']) {
                                echo "selected='selected'";
                            }
                            ?>
                                value="<?php echo $userItem['id_user']; ?>">
                                    <?php echo $userItem['firstname'] . ' ' . $userItem['lastname']; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-sm-4">
                    <select class="form-control" name="id_media" autocomplete="off" id="id_media">
                        <?php foreach ($medias as $mediaItem): ?>
                            <option 
                            <?php
                            if ($orderItem['id_media'] == $mediaItem['id_media']) {
                                echo "selected='selected'";
                            }
                            ?>
                                value="<?php echo $mediaItem['id_media']; ?>">
                                    <?php echo $mediaItem['media_name']; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            </br>
            <input type="hidden" name="id_orders" value="<?php echo $orderItem['id_orders'] ?>">
            <div class="col-xs-6">
                <div class="input-group">
                    <div class="input-group-btn">
                        <button tabindex="-1" class="btn btn-default" type="submit" name="submit" value="update">Сохранить</button>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <!--https://www.jelu.ru/post/pishem-svoy-prostoy-variant-zhivogo-poiska.html-->
                <div class="col-sm-5">
                    <ul class="search_result"></ul>
                </div>
            </div>
            </br>
            <div class="collapse" id="history" style="padding: 10px;border-radius: 5px;height: auto;border: 1px solid #ddd;margin-bottom: 20px;">
                <h3>История заказа</h3>
            </div>
        </form>
    </div>
</main>
<?php include ROOT . '/views/layouts/footer.php'; ?>