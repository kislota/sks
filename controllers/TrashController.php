<?php

class TrashController extends Controller {

    public $header = 'Корзина';
    public $top_menu = 'trash';

    public function actionIndex($page = 1) {
        //Проверяем права пользователя
        $user = User::getUserCheckAccess();
        //Заявка удалена
        $trash = 1;
        //Получаем номер страницы
        $page = $this->getPage($page);
        //Выбираем нужные записи из таблицы
        $orderList = $this->getOrderForeach(Order::getOrderList($page, $trash));
        // Общее количетсво заявок (необходимо для постраничной навигации)
        $count = count(Db::getSelect('orders', 'trash = 0'));
        //Постраничная навигация
        $pagination = new Pagination($count, $page, $this->show_def, 'page-');
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
//------------------------------------------------------------------------------
        if ($id) {
            $OrderDel = Trash::getTrash($id, '0');
            // Возвращаем пользователя на страницу с которой он пришел

            $referrer = $_SERVER['HTTP_REFERER'];
            header("Location: $referrer");
        }

//-----------------------------Конец--------------------------------------------
        return true;
    }

}
