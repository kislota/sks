<?php

class Controller extends Settings {

    /**
     * Колличество записей на страницу
     */
    public $count = 5;
    public $show_def = 5;
    public $header = 'Система учета';
    public $top_menu = 'site';

    public function getPage($page) {
        $preg = '/[a-z]+.[-]/';
        $page = preg_replace($preg, '', $page);
        return $page;
    }

    public function header_menu_top() {
        $header_menu = ROOT . '/views/' . $this->top_menu . '/menu_top.php';
        return file_get_contents($header_menu);
    }

    /**
     * Подготовка к выводу в шаблон и добавление всего в асоциативный массив
     * @param array() $result <p>Результат выборки из базы по запросам</p>
     * @return array() $orderList <p>Асоциативный массив заявок</p>
     */
    public function getOrderForeach($result) {
        if (!array_key_exists('id_orders', $result)) {
            foreach ($result as $key => $value) {
                $orderList[$key] = $value;
                $clientId = Client::getClientById($orderList[$key]['id_client']);
                $orderList[$key]['clientfname'] = $clientId['firstname'];
                $orderList[$key]['clientlname'] = $clientId['lastname'];
                $orderList[$key]['phone'] = $clientId['phone'];
                $orderList[$key]['address'] = $clientId['address'];
                $managerId = User::getUserById($orderList[$key]['id_manager']);
                $orderList[$key]['manager_firstname'] = $managerId['firstname'];
                $orderList[$key]['manager_lastname'] = $managerId['lastname'];
                $masterId = User::getUserById($orderList[$key]['id_master']);
                $orderList[$key]['master_firstname'] = $masterId['firstname'];
                $orderList[$key]['master_lastname'] = $masterId['lastname'];
                $deviceId = Device::getDeviceById($orderList[$key]['id_device']);
                $orderList[$key]['device_name'] = $deviceId['device_name'];
                $brandId = Brand::getBrandById($orderList[$key]['id_brand']);
                $orderList[$key]['brand_name'] = $brandId['brand_name'];
            }
        } else {
            $orderList = $result;
            $clientId = Client::getClientById($orderList['id_client']);
            $orderList['clientfname'] = $clientId['firstname'];
            $orderList['clientlname'] = $clientId['lastname'];
            $orderList['phone'] = $clientId['phone'];
            $orderList['address'] = $clientId['address'];
            $managerId = User::getUserById($orderList['id_manager']);
            $orderList['manager_firstname'] = $managerId['firstname'];
            $orderList['manager_lastname'] = $managerId['lastname'];
            $masterId = User::getUserById($orderList['id_master']);
            $orderList['master_firstname'] = $masterId['firstname'];
            $orderList['master_lastname'] = $masterId['lastname'];
            $deviceId = Device::getDeviceById($orderList['id_device']);
            $orderList['device_name'] = $deviceId['device_name'];
            $brandId = Brand::getBrandById($orderList['id_brand']);
            $orderList['brand_name'] = $brandId['brand_name'];
        }
        return $orderList;
    }

}

function debug($arr) {
    echo '<pre>' . print_r($arr, true) . '</pre>';
    return true;
}

function status($id = NULL) {

    if ($id) {
        $where = 'id_status = ' . $id;
        $status = Db::getSelect('status', $where);
        return $status;
    } else {
        $status = Db::getSelect('status');
        return $status;
    }
}
