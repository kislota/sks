<?php

class ShopController extends Controller{

    public $header = 'Магазины';

    public function header_menu_top() {
        $header_menu = ROOT . '/views/shop/menu_top.php';
        echo file_get_contents($header_menu);
        return true;
    }

    public function actionIndex() {
        $user = User::getUserCheckAccess();

        require_once(ROOT . '/views/shop/index.php');
        return true;
    }

}
