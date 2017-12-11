<?php

class TrashController extends Controller{

    public $header = 'Корзина';

    public function header_menu_top() {
        $header_menu = ROOT . '/views/trash/menu_top.php';
        echo file_get_contents($header_menu);
        return true;
    }

    public function actionIndex($page = 1) {
        $user = User::getUserCheckAccess();
        $trash = 1;
        $page = $this->getPage($page);
        $orderList = array();
        $orderList = Order::getOrderList($page, $trash);

        // Общее количетсво товаров (необходимо для постраничной навигации)
        $total = Order::getOrderPaginationCount('', $trash);
        $count = count($total);
        $pagination = new Pagination($count, $page, $this->count, 'page-');

//-----------------------------Вывод шаблона------------------------------------
        require_once(ROOT . '/views/trash/index.php');
        return true;
    }

//------------------------------------------------------------------------------
//-----------------------------Восстановить заявку------------------------------
//------------------------------------------------------------------------------
    public function actionUndel($id) {
        // Проверка доступа
        $user = User::getUserCheckAccess();
        $trash = 0;

//------------------------------------------------------------------------------
        if ($id) {
            $OrderDel = Trash::getTrash($id, $trash);
            // Возвращаем пользователя на страницу с которой он пришел

            $referrer = $_SERVER['HTTP_REFERER'];
            header("Location: $referrer");
        }

//-----------------------------Конец--------------------------------------------
        return true;
    }

}
