<?php

class Device {

    /**
     * Устройство
     * @param int $id <p>Идентификатор устройства</p>
     * @return array $result <p>Данные о устройстве</p>
     */
    public static function getDeviceById($id) {
        $table = 'device';
        $where = 'id_device = ' . $id;

        $result = Db::getSelect($table, $where);
        //Возвращаем массив с данными для вывода заявки
        return $result;
    }

    /**
     * Все устройства для выбора нужного
     * @param int $active <p>Активено или нет устройство. Активен = 1, Отключен = 0</p>
     * @return array $result <p>Данные о устройствах</p>
     */
    public static function getDeviceList($active = 1) {
        $table = 'device';

        $result = Db::getSelect($table);
        //Возвращаем массив с данными для вывода заявки
        return $result;
    }

    /**
     * Добавление устройства
     * @param string $device_name <p>Назание бренда</p>
     * @param int $active <p>Активен или нет бренд. Активен = 1, Отключен = 0</p>
     * @return int $insertId <p>Идентификатор устройства</p>
     */
    public static function getDeviceAdd($device_name, $active = 1) {
        // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = 'INSERT INTO device (device_name) '
                . 'VALUES (?)';

        $result = $db->prepare($sql);
        $result->bindParam(1, $device_name);
        $result->execute();

        //id последней добавленной записи
        $insertId = $db->lastInsertId();
        return $insertId;
    }

    /**
     * Редактирование устройства
     * @param int $id <p>Идентификатор устройства</p>
     * @param array $param <p>Параметры</p>
     * @return boolean <p>true/false</p>
     */
    public static function getDeviceEdit($id, $param) {
        
    }

    /**
     * Удаление устройства
     * @param string $id <p>Идентификатор устройства</p>
     * @return boolean <p>true/false</p>
     */
    public static function getDeviceDel($id) {
        
    }

}
