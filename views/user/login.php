<?php include ROOT . '/views/layouts/header.php'; ?>
<div id="content" style='margin-top: 60px'>
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <?php if (isset($errors) && is_array($errors)): ?>
                <ul>
                    <?php foreach ($errors as $error): ?>
                        <li> - <?php echo $error; ?></li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
            <div class="login-panel panel panel-default">
                <ul id="myTabs" class="nav nav-pills" role="tablist">
                    <li class='active'><a data-toggle='tab' href='#login'>Вход</a></li>
                    <li><a data-toggle='tab' href='#reg'>Регистрация</a></li>
                </ul>

                <div id="myTabContent" class="tab-content">
                    <div id='login' class='tab-pane fade in active'>
                        <form method="post" action="/user/login">
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Логин" name="username" type="username" autofocus value="<?php echo $user_name; ?>"/>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Пароль" name="password" type="password" value="">
                                </div>
                                <button type="submit" name="login" class="btn btn-lg btn-success btn-block">Войти</button>
                            </fieldset>
                        </form>
                    </div>
                    <div id='reg' class='tab-pane fade'>
                        <form method="post" action="/user/reg">
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Логин" name="username" type="username" autofocus value="<?php echo $user_name; ?>"/>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Пароль" name="password" type="password" value="<?php echo $password; ?>"/>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Пароль" name="password2" type="password" value=""/>
                                </div>
                                <button type="submit" name="reg" class="btn btn-lg btn-success btn-block">Зарегистрироваться</button>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include ROOT . '/views/layouts/footer.php'; ?>