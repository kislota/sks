<?php

class ShopController extends Controller{

    public $header = 'Магазины';
    public $top_menu = 'shop';

    public function actionIndex() {
        $user = User::getUserCheckAccess();

        require_once(ROOT . '/views/shop/index.php');
        return true;
    }

}
