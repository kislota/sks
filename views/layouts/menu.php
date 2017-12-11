<div class="demo-drawer mdl-layout__drawer mdl-color--blue-grey-900 mdl-color-text--blue-grey-50">
    <header class="demo-drawer-header">
<!--        <img src="/template/images/user<?php echo $user['id'];?>.jpg" class="demo-avatar">-->
        <div class="demo-avatar-dropdown">
            <span>Добро пожаловать! <?php echo $user['first_name'];?></span>
            <div class="mdl-layout-spacer"></div>
            <button id="accbtn" class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--icon">
                <i class="material-icons" role="presentation">arrow_drop_down</i>
                <span class="visuallyhidden">Профиль</span>
            </button>
            <ul class="mdl-menu mdl-menu--bottom-right mdl-js-menu mdl-js-ripple-effect" for="accbtn">
                <li class="mdl-menu__item">Заказать запчасть</li>
                <a class="mdl-navigation__link" href="/user/<?php echo $user['id'];?>"><li class="mdl-menu__item">Редактировать профиль</li></a>
                <a class="mdl-navigation__link" href="/kassa/user/<?php echo $user['id'];?>"><li class="mdl-menu__item">Баланс 0</li></a>
                <a class="mdl-navigation__link" href="/user/logout"><li class="mdl-menu__item">Выход</li></a>
                <!--<li class="mdl-menu__item"><i class="material-icons">add</i>Add another account...</li>-->
            </ul>
        </div>
    </header>
    <nav class="demo-navigation mdl-navigation mdl-color--blue-grey-800">
        <!--<a class="mdl-navigation__link" href=""><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">home</i>Главная</a>-->
        <a class="mdl-navigation__link" href="/order"><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">inbox</i>Заявки</a>
        <a class="mdl-navigation__link" href="/kassa"><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">attach_money</i>Касса</a>
        <a class="mdl-navigation__link" href="/shop"><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">shopping_cart</i>Магазин</a>
        <a class="mdl-navigation__link" href="/part"><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">memory</i>Склад</a>
        <a class="mdl-navigation__link" href="/client"><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">people</i>Клиенты</a>
        <a class="mdl-navigation__link" href="/report"><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">assessment</i>Отчеты</a>
        <a class="mdl-navigation__link" href="/history"><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">history</i>История</a>
        <a class="mdl-navigation__link" href="/trash"><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">delete</i>Корзина</a>
        <a class="mdl-navigation__link" href="/purchase"><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">shopping_basket</i>Закупка</a>
        <div class="mdl-layout-spacer"></div>
        <a class="mdl-navigation__link" href=""><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">help_outline</i><span class="visuallyhidden">Help</span></a>
    </nav>
</div>