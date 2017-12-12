<?php

class OrderController extends Controller {

    public $header = 'Заказы';
    public $top_menu = 'order';

    /**
     * Список заявок
     * @param int $page <p>Текущаяя страница</p>
     */
    public function actionIndex($page = 1) {
        //Проверяем права пользователя
        $user = User::getUserCheckAccess();
        //Получаем номер страницы
        $page = $this->getPage($page);
        //Выбираем нужные записи из таблицы
        $orderList = $this->getOrderForeach(Order::getOrderList($page));
        // Общее количетсво заявок (необходимо для постраничной навигации)
        $count = Db::getSelectCount('orders');
        //Постраничная навигация
        $pagination = new Pagination($count, $page, $this->show_def, 'page-');
        //-----------------------------Вывод шаблона------------------------------------
        require_once(ROOT . '/views/order/index.php');
        return true;
    }

    /**
     * Добавление новой заявки
     * @param int $id <p>default: id = 0</p>
     * @todo id используеться для принятия заявки от того же клиента что был ранее
     */
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
        $orderItem = $this->getOrderForeach(Order::getOrderById($id));

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
            Trash::getTrash($id);
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
        //Проверяем права пользователя
        $user = User::getUserCheckAccess();
        //Получаем номер страницы
        $page = $this->getPage($page);
        //Условие оплаты
        $payment = "id_pay=0 and id_status=6";
        //Выбираем нужные записи из таблицы
        $orderList = $this->getOrderForeach(Order::getOrderListFilter($page, $payment));
        // Общее количетсво заявок (необходимо для постраничной навигации)
        $count = count(Db::getSelect('orders', $payment));
        //Постраничная навигация
        $pagination = new Pagination($count, $page, $this->count, 'page-');
//-----------------------------Вывод шаблона------------------------------------
        require_once(ROOT . '/views/order/index.php');
        return true;
    }

//------------------------------------------------------------------------------
//-----------------------------Фильтр по статусу ремонта------------------------
//------------------------------------------------------------------------------
    public function actionStatus($status, $page = 1) {
        //Проверяем права пользователя
        $user = User::getUserCheckAccess();
        //Получаем номер страницы
        $page = $this->getPage($page);
        //Условие по статусу
        $status = "id_status = " . $status;
        //Выбираем нужные записи из таблицы
        $orderList = $this->getOrderForeach(Order::getOrderListFilter($page, $status));
        // Общее количетсво заявок (необходимо для постраничной навигации)
        $count = count(Db::getSelect('orders', $status));
        //Постраничная навигация
        $pagination = new Pagination($count, $page, $this->count, 'page-');
//-----------------------------Вывод шаблона------------------------------------
        require_once(ROOT . '/views/order/index.php');
        return true;
    }

//------------------------------------------------------------------------------
//-----------------------------Фильтр по мастеру--------------------------------
//------------------------------------------------------------------------------
    public function actionMaster($master, $page = 1) {
        //Проверяем права пользователя
        $user = User::getUserCheckAccess();
        //Получаем номер страницы
        $page = $this->getPage($page);
        //Условие по статусу
        $master = "id_master='" . $master . "'";
        //Выбираем нужные записи из таблицы
        $orderList = $this->getOrderForeach(Order::getOrderListFilter($page, $master));
        // Общее количетсво заявок (необходимо для постраничной навигации)
        $count = count(Db::getSelect('orders', $master));
        //Постраничная навигация
        $pagination = new Pagination($count, $page, $this->count, 'page-');
//-----------------------------Вывод шаблона------------------------------------
        require_once(ROOT . '/views/order/index.php');
        return true;
    }

//------------------------------------------------------------------------------
//-----------------------------Фильтр по рекламе--------------------------------
//------------------------------------------------------------------------------
    public function actionMedia($media, $page = 1) {
        //Проверяем права пользователя
        $user = User::getUserCheckAccess();
        //Получаем номер страницы
        $page = $this->getPage($page);
        //Условие по статусу
        $media = "id_media='" . $media . "'";
        //Выбираем нужные записи из таблицы
        $orderList = $this->getOrderForeach(Order::getOrderListFilter($page, $media));
        // Общее количетсво заявок (необходимо для постраничной навигации)
        $count = count(Db::getSelect('orders', $media));
        //Постраничная навигация
        $pagination = new Pagination($count, $page, $this->count, 'page-');
//-----------------------------Вывод шаблона------------------------------------
        require_once(ROOT . '/views/order/index.php');
        return true;
    }

//------------------------------------------------------------------------------
//-----------------------------Фильтр по вызову специалиста---------------------
//------------------------------------------------------------------------------
    public function actionHelp($page = 1) {
        //Проверяем права пользователя
        $user = User::getUserCheckAccess();
        //Получаем номер страницы
        $page = $this->getPage($page);
        //Условие по статусу
        $help = "id_help=1";
        //Выбираем нужные записи из таблицы
        $orderList = $this->getOrderForeach(Order::getOrderListFilter($page, $help));
        // Общее количетсво заявок (необходимо для постраничной навигации)
        $count = count(Db::getSelect('orders', $help));
        //Постраничная навигация
        $pagination = new Pagination($count, $page, $this->count, 'page-');
//-----------------------------Вывод шаблона------------------------------------
        require_once(ROOT . '/views/order/index.php');
        return true;
    }

//------------------------------------------------------------------------------
//-----------------------------Фильтр по ячейкам--------------------------------
//------------------------------------------------------------------------------
    public function actionCell($cell = "cell>0", $page = 1) {
        //Проверяем права пользователя
        $user = User::getUserCheckAccess();
        //Получаем номер страницы
        $page = $this->getPage($page);
        //Условие по статусу
        $cell = "cell>0";
        //Выбираем нужные записи из таблицы
        $orderList = $this->getOrderForeach(Order::getOrderListFilter($page, $cell));
        // Общее количетсво заявок (необходимо для постраничной навигации)
        $count = count(Db::getSelect('orders', $cell));
        //Постраничная навигация
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

}
