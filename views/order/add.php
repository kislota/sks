<?php include ROOT . '/views/layouts/header.php'; ?>
<?php include ROOT . '/views/layouts/header_menu.php'; ?>
<?php include ROOT . '/views/layouts/menu.php'; ?>
<main class="mdl-layout__content mdl-color--grey-100">
    <div class="mdl-grid demo-content">
        <form method="post" action="/order/add">
            <div class="form-group">
                <div class="col-sm-12">
                    <div class="btn-group">
                        <a class="btn btn-default" data-toggle="collapse" title="Вызов специалиста" href="#id_help">Вызов</a>
                        <a class="btn btn-default" data-toggle="collapse" title="Ячейка" href="#cell">Ячейка</a>
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
                    <input type="text" required name="firstname" id="firstname" autocomplete="off" class="form-control" placeholder="Имя" value="<?php if ($clientItem !== Array()) { echo $clientItem['firstname'];} ?>">
                </div>
                <div class="col-sm-4">
                    <input type="text" required name="lastname" id="lastname" autocomplete="off" class="form-control" placeholder="Фамилия" value="<?php if ($clientItem !== Array()) { echo $clientItem['lastname'];} ?>">
                </div>
                <div class="col-sm-4">
                    <input type="text" id="phone" name="phone" required autocomplete="off" class="form-control" placeholder="Телефон" value="<?php if ($clientItem !== Array()) {echo $clientItem['phone'];}  ?>">
                </div>
            </div>
            </br>
            <div class="collapse form-group" id="id_help">
                <div class="col-sm-12">
                    <input type="text" name="address" autocomplete="off" class="form-control" placeholder="Адрес клиента" value="<?php if ($clientItem !== Array() and $clientItem['id_address'] != 0) {echo $clientItem['id_address'];} ?>">
                </div>
                </br>
            </div>
            </br>
            <div class="form-group">
                <div class="col-sm-3">
                    <select class="form-control" name="id_device" autocomplete="off" id="id_device">
                        <?php foreach ($device as $deviceItem): ?>
                            <option value="<?php echo $deviceItem['id']; ?>">
                                <?php echo $deviceItem['device_name']; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-sm-3">
                    <select class="form-control" name="id_brand" autocomplete="off" id="id_brand">
                        <?php foreach ($brands as $brandItem): ?>
                            <option value="<?php echo $brandItem['id']; ?>">
                                <?php echo $brandItem['brand_name']; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-sm-3">
                    <input type="text" name="model" autocomplete="off" class="form-control" placeholder="Модель">
                </div>
                <div class="col-sm-3">
                    <input type="text" name="sn" autocomplete="off" class="form-control" placeholder="Серийный номер">
                </div>
            </div>
            </br>
            <div class="form-group">
                <div class="col-sm-12">
                    <input type="text" name="defect" autocomplete="off" class="form-control" placeholder="Неисправность">
                </div>
            </div>
            </br>
            <div class="form-group">
                <div class="col-sm-4">
                    <input type="text" name="complit" autocomplete="off" class="form-control" placeholder="Комплектация">
                </div>
                <div class="col-sm-4">
                    <select class="form-control" name="id_master">
                        <?php foreach ($users as $userItem): ?>
                            <option value="<?php echo $userItem['id']; ?>">
                                <?php echo $userItem['first_name'] . ' ' . $userItem['last_name']; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-sm-4">
                    <select class="form-control" name="id_media" autocomplete="off" id="id_media">
                        <?php foreach ($medias as $mediaItem): ?>
                            <option value="<?php echo $mediaItem['id']; ?>">
                                <?php echo $mediaItem['media_name']; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            </br>
            <div class="col-xs-6">
                <div class="input-group">
                    <div class="input-group-btn">
                        <button tabindex="-1" class="btn btn-default" type="submit" name="submit" value="save">Сохранить</button>
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
            <input type="hidden" name="id_help" value="0">
        </form>
    </div>
</main>
<?php include ROOT . '/views/layouts/footer.php'; ?>