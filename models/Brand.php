<?php

class Brand {

    /**
     * Бренд
     * @param int $id <p>Идентификатор бренда</p>
     * @return array $result <p>Данные о бренде</p>
     */
    public static function getBrandById($id) {
        $table = 'brand';
        $where = 'id_brand = ' . $id;

        $result = Db::getSelect($table, $where);
        return $result;
    }
    
    /**
     * Все бренды для выбора нужного
     * @param int $active <p>Активен или нет бренд. Активен = 1, Отключен = 0</p>
     * @return array $result <p>Данные о бренде</p>
     */
    public static function getBrandList($active = 1) {
        $table = 'brand';

        $result = Db::getSelect($table);
        //Возвращаем массив с данными
        return $result;
    }
    
    /**
     * Добавление бренда
     * @param string $brand_name <p>Назание бренда</p>
     * @param int $id_device <p>Массив устройств которым соотвествует бренд</p>
     * @param int $active <p>Активен или нет бренд. Активен = 1, Отключен = 0</p>
     * @return int $insertId <p>Идентификатор бренда</p>
     */
    public static function getBrandAdd($brand_name, $id_device, $active = 1) {
        // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = 'INSERT INTO brand (brand_name, id_device) '
                . 'VALUES (?, ?)';

        $result = $db->prepare($sql);
        $result->bindParam(1, $brand_name);
        $result->bindParam(2, $id_device);
        $result->execute();

        //id последней добавленной записи
        $insertId = $db->lastInsertId();
        return $insertId;
    }
    
    /**
     * Редактирование бренда
     * @param int $id <p>Идентификатор бренда</p>
     * @param array $param <p>Параметры</p>
     * @return boolean <p>true/false</p>
     */
    public static function getBrandEdit($id, $param) {
        return true;
    }
    
    /**
     * Удаление бренда
     * @param string $id <p>Идентификатор бренда</p>
     * @return boolean <p>true/false</p>
     */
    public static function getBrandDel($id) {
        return true;
    }

}
