<?php

class OrderController extends Controller {

    public $header = 'Заказы';

    public function header_menu_top() {
        $header_menu = ROOT . '/views/order/menu_top.php';
        echo file_get_contents($header_menu);
        return true;
    }

//------------------------------------------------------------------------------
//-----------------------------Вывод всех заявок--------------------------------
//------------------------------------------------------------------------------
    public function actionIndex($page = 1) {
        //Проверяем права пользователя
        $user = User::getUserCheckAccess();
        //Получаем номер страницы
        $page = $this->getPage($page);
        //Выбираем нужные записи из таблицы
        $orderList = Order::getOrderList($page);
        // Общее количетсво заявок (необходимо для постраничной навигации)
        $count = Db::getSelectCount('orders');
        //Постраничная навигация
        $pagination = new Pagination($count, $page, $this->show_def, 'page-');
        //-----------------------------Вывод шаблона------------------------------------
        require_once(ROOT . '/views/order/index.php');
        return true;

    }

//------------------------------------------------------------------------------
//-----------------------------Добавить новую заявку----------------------------
//------------------------------------------------------------------------------
    public function actionAdd($id = 0) {
        // Проверка доступа
        $user = User::getUserCheckAccess();
        $device = Device::getDeviceList();
        $users = User::getUserList();
        $medias = Media::getMediaList();
        $brands = Brand::getBrandList();
        $clientItem = Client::getClientById($id);

        // Если форма отправлена
        if (isset($_POST['submit']) == "save") {
            // Данные о клиенте
            $id_client = Client::getClientChek($_POST['firstname'], $_POST['lastname'], $_POST['phone'], $_POST['address']);
            $_POST['id_client'] = $id_client;

            $param = json_encode($_POST);

            $insertId = Order::getOrderAdd($param);
            header("Location: /order/edit/$insertId");
            return true;
        }
//-----------------------------Вывод шаблона------------------------------------
        require_once(ROOT . '/views/order/add.php');
        return true;
    }

//------------------------------------------------------------------------------
//-----------------------------Редактировать заявку-----------------------------
//------------------------------------------------------------------------------
    public function actionEdit($id) {
        // Проверка доступа
        $user = User::getUserCheckAccess();
        $device = Device::getDeviceList();
        $users = User::getUserList();
        $medias = Media::getMediaList();
        $brands = Brand::getBrandList();

//------------------------------------------------------------------------------
        if (isset($_POST['submit']) == "update") {
            //Данные о клиенте
            $_POST['id_client'] = Client::getClientChek($_POST['firstname'], $_POST['lastname'], $_POST['phone']);

            $param = json_encode($_POST);

            $orderEdit = Order::getOrderEditId($param);
            header("Location: /order/edit/$orderEdit");
            return true;
        }
        $orderItem = Order::getOrderById($id);

//-----------------------------Вывод шаблона------------------------------------
        require_once(ROOT . '/views/order/edit.php');
        return true;
    }

//------------------------------------------------------------------------------
//-----------------------------Удалить заявку-----------------------------------
//------------------------------------------------------------------------------
    public function actionDel($id) {
        // Проверка доступа
        $user = User::getUserCheckAccess();

//------------------------------------------------------------------------------
        if ($id) {
            $OrderDel = Trash::getTrash($id);
            // Возвращаем пользователя на страницу с которой он пришел

            $referrer = $_SERVER['HTTP_REFERER'];
            header("Location: $referrer");
        }

//-----------------------------Конец--------------------------------------------
        return true;
    }

//------------------------------------------------------------------------------
//-----------------------------Фильтр по оплатам--------------------------------
//------------------------------------------------------------------------------
    public function actionPayment($page = 1) {
        // Проверка доступа
        $user = User::getUserCheckAccess();
        $page = $this->getPage($page);
//------------------------------------------------------------------------------
        $payment = "id_pay=0 and id_status=6";

        $orderList = array();
        $orderList = Order::getOrderListFilter($page, $payment);

        // Общее количетсво заявок (необходимо для постраничной навигации)
        $total = Order::getOrderPaginationCount($payment);
        $count = count($total);
        $pagination = new Pagination($count, $page, $this->count, 'page-');

//-----------------------------Вывод шаблона------------------------------------
        require_once(ROOT . '/views/order/index.php');
        return true;
    }

//------------------------------------------------------------------------------
//-----------------------------Фильтр по статусу ремонта------------------------
//------------------------------------------------------------------------------
    public function actionStatus($status, $page = 1) {
        // Проверка доступа
        $user = User::getUserCheckAccess();

//------------------------------------------------------------------------------
        $status = "id_status = " . $status;
        $page = $this->getPage($page);
        $orderList = array();
        $orderList = Order::getOrderListFilter($page, $status);

        // Общее количетсво заявок (необходимо для постраничной навигации)
        $total = Order::getOrderPaginationCount($status);
        $count = count($total);
        $pagination = new Pagination($count, $page, $this->count, 'page-');

//-----------------------------Вывод шаблона------------------------------------
        require_once(ROOT . '/views/order/index.php');
        return true;
    }

//------------------------------------------------------------------------------
//-----------------------------Фильтр по мастеру--------------------------------
//------------------------------------------------------------------------------
    public function actionMaster($master, $page = 1) {
        // Проверка доступа
        $user = User::getUserCheckAccess();

//------------------------------------------------------------------------------
        $master = "id_master='" . $master . "'";
        $page = $this->getPage($page);
        $orderList = array();
        $orderList = Order::getOrderListFilter($page, $master);

        // Общее количетсво заявок (необходимо для постраничной навигации)
        $total = Order::getOrderPaginationCount($master);
        $count = count($total);
        $pagination = new Pagination($count, $page, $this->count, 'page-');

//-----------------------------Вывод шаблона------------------------------------
        require_once(ROOT . '/views/order/index.php');
        return true;
    }

//------------------------------------------------------------------------------
//-----------------------------Фильтр по рекламе--------------------------------
//------------------------------------------------------------------------------
    public function actionMedia($media, $page = 1) {
        // Проверка доступа
        $user = User::getUserCheckAccess();

//------------------------------------------------------------------------------
        $media = "id_media='" . $media . "'";
        $page = $this->getPage($page);
        $orderList = array();
        $orderList = Order::getOrderListFilter($page, $media);

        // Общее количетсво заявок (необходимо для постраничной навигации)
        $total = Order::getOrderPaginationCount($media);
        $count = count($total);
        $pagination = new Pagination($count, $page, $this->count, 'page-');

//-----------------------------Вывод шаблона------------------------------------
        require_once(ROOT . '/views/order/index.php');
        return true;
    }

//------------------------------------------------------------------------------
//-----------------------------Фильтр по вызову специалиста---------------------
//------------------------------------------------------------------------------
    public function actionHelp($page = 1) {
        // Проверка доступа
        $user = User::getUserCheckAccess();

//------------------------------------------------------------------------------
        $help = "id_help=1";
        $page = $this->getPage($page);
        $orderList = array();
        $orderList = Order::getOrderListFilter($page, $help);

        // Общее количетсво заявок (необходимо для постраничной навигации)
        $total = Order::getOrderPaginationCount($help);
        $count = count($total);
        $pagination = new Pagination($count, $page, $this->count, 'page-');

//-----------------------------Вывод шаблона------------------------------------
        require_once(ROOT . '/views/order/index.php');
        return true;
    }

//------------------------------------------------------------------------------
//-----------------------------Фильтр по ячейкам--------------------------------
//------------------------------------------------------------------------------
    public function actionCell($cell = "cell>0", $page = 1) {
        // Проверка доступа
        $user = User::getUserCheckAccess();

//------------------------------------------------------------------------------
        $page = $this->getPage($page);
        $orderList = array();
        $orderList = Order::getOrderListFilter($page, $cell);

        // Общее количетсво заявок (необходимо для постраничной навигации)
        $total = Order::getOrderPaginationCount($cell);
        $count = count($total);
        $pagination = new Pagination($count, $page, $this->count, 'page-');

//-----------------------------Вывод шаблона------------------------------------
        require_once(ROOT . '/views/order/index.php');
        return true;
    }

//------------------------------------------------------------------------------
//-----------------------------Оплатить заявку----------------------------------
//------------------------------------------------------------------------------
    public function actionPay($id) {
        // Проверка доступа
        $user = User::getUserCheckAccess();

//------------------------------------------------------------------------------
        if ($id) {
            $OrderPay = Order::getOrderPayID($id);
            // Возвращаем пользователя на страницу с которой он пришел
            $referrer = $_SERVER['HTTP_REFERER'];
            header("Location: $referrer");
        }

//-----------------------------Конец--------------------------------------------
        return true;
    }

//------------------------------------------------------------------------------
//-----------------------------Фильтр по статусу ремонта------------------------
//------------------------------------------------------------------------------
    public function actionSearch() {
        // Проверка доступа
        $user = User::getUserCheckAccess();

//------------------------------------------------------------------------------
        $search = $_REQUEST['client'];
        $clientList = Order::getOrderSearch($search);

//-----------------------------Конец--------------------------------------------
        die();
    }

}
