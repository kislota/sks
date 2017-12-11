<?php

class PurchaseController extends Controller{

    public $header = 'Закупка';

    public function header_menu_top() {
        $header_menu = ROOT . '/views/purchase/menu_top.php';
        echo file_get_contents($header_menu);
        return true;
    }

    public function actionIndex() {
        $user = User::getUserCheckAccess();

        require_once(ROOT . '/views/purchase/index.php');
        return true;
    }

}
