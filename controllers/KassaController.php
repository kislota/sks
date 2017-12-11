<?php


class KassaController extends Controller{

    public $header = 'Касса';

    public function header_menu_top() {
        $header_menu = ROOT . '/views/kassa/menu_top.php';
        echo file_get_contents($header_menu);
        return true;
    }

    /**
     * Вывод всех платежей
     */
    public function actionIndex() {
        $user = User::getUserCheckAccess();
        $kassaList = Kassa::getKassaList();

//-----------------------------Вывод шаблона------------------------------------
        require_once(ROOT . '/views/kassa/index.php');
        return true;
    }

    /**
     * Дабавить оплату в ручную
     */
    public function actionAdd($id, $type) {
        $user = User::getUserCheckAccess();
//------------------------------------------------------------------------------
        if (isset($_POST['submit']) == "save") {
            // Если форма отправлена
            // Получаем данные из формы
            $insertId = Kassa::getPayAdd($id, $type);

            header("Location: /kassa/edit/$insertId");
            return true;
        }
//-----------------------------Вывод шаблона------------------------------------
        require_once(ROOT . '/views/kassa/add.php');
        return true;
    }

    /**
     * Вывод платежей по заявкам
     */
    public function actionOrder() {
        $user = User::getUserCheckAccess();
//------------------------------------------------------------------------------
        $where = "id_orders > 0";
        $kassaList = Kassa::getKassaListFilter($where);

//-----------------------------Вывод шаблона------------------------------------
        require_once(ROOT . '/views/kassa/index.php');
        return true;
    }

    /**
     * Вывод платежи по складу
     */
    public function actionPart() {
        $user = User::getUserCheckAccess();
//------------------------------------------------------------------------------
        $where = "id_parts > 0";
        $kassaList = Kassa::getKassaListFilter($where);

//-----------------------------Вывод шаблона------------------------------------
        require_once(ROOT . '/views/kassa/index.php');
        return true;
    }

    /**
     * Вывод платежей по пользователям
     */
    public function actionUser() {
        $user = User::getUserCheckAccess();
//------------------------------------------------------------------------------
        $where = "id_users > 0";
        $kassaList = Kassa::getKassaListFilter($where);

//-----------------------------Вывод шаблона------------------------------------
        require_once(ROOT . '/views/kassa/index.php');
        return true;
    }

    /**
     * Вывод платежей по клиентам
     */
    public function actionClient() {
        $user = User::getUserCheckAccess();
//------------------------------------------------------------------------------
        $where = "id_clients > 0";
        $kassaList = Kassa::getKassaListFilter($where);

//-----------------------------Вывод шаблона------------------------------------
        require_once(ROOT . '/views/kassa/index.php');
        return true;
    }

    /**
     * Вывод платежей по продажам
     */
    public function actionSale() {
        $user = User::getUserCheckAccess();
//------------------------------------------------------------------------------
        $where = "id_sales > 0";
        $kassaList = Kassa::getKassaListFilter($where);

//-----------------------------Вывод шаблона------------------------------------
        require_once(ROOT . '/views/kassa/index.php');
        return true;
    }

    /**
     * Вывод платежей по доходам
     */
    public function actionComing() {
        $user = User::getUserCheckAccess();
//------------------------------------------------------------------------------
        $where = "coming > 0";
        $kassaList = Kassa::getKassaListFilter($where);

//-----------------------------Вывод шаблона------------------------------------
        require_once(ROOT . '/views/kassa/index.php');
        return true;
    }

    /**
     * Вывод платежей по расходам
     */
    public function actionCost() {
        $user = User::getUserCheckAccess();
//------------------------------------------------------------------------------
        $where = "cost < 0";
        $kassaList = Kassa::getKassaListFilter($where);

//-----------------------------Вывод шаблона------------------------------------
        require_once(ROOT . '/views/kassa/index.php');
        return true;
    }

    /**
     * Совершаем платёж
     * @var $type имя базы данных
     * @var $id номер записи в базе по которой произвдится оплата
     */
    public function actionPay($type, $id) {
        // Проверка доступа
        $user = User::getUserCheckAccess();
//------------------------------------------------------------------------------
        //Добавляем оплату
        $insertPay = Kassa::getPayAdd($id, $type);
//------------------------------------------------------------------------------
        // Возвращаем пользователя на страницу с которой он пришел
        $referrer = $_SERVER['HTTP_REFERER'];
        header("Location: $referrer");
//-----------------------------Конец--------------------------------------------
        return true;
    }

}
