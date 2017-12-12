<?php

class History {
    /**
     * Колличество записей на страницу
     */
    const SHOW_BY_DEFAULT = 5;
    
    /**
     * Постраничный вывод истории
     * @param int $page = 1 <p>Номер страницы</p>
     * @return array() <p>Асоциативный массив готовый к выводу</p>
     */
    public static function getHistoryList($page = 1) {
        $count = self::SHOW_BY_DEFAULT;
        // Смещение (для запроса)
        $offset = ($page - 1) * self::SHOW_BY_DEFAULT;
        $table = 'history';
        $table.= ' ORDER BY data DESC LIMIT ' . $count . ' OFFSET ' . $offset;
        //Возвращаем массив с данными для вывода заявки
        return Db::getSelect($table);
    }

    /**
     * Добавление истории
     * @param string $id_type <p>К какому типу относиться история id записи</p>
     * @param int $id_users <p>Пользователь который сделал изменения</p>
     * @param int $action <p>Что было сделано описание</p>
     * @return boolean <p>true</p>
     */
    public static function getHistoryAdd() {
        // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = 'INSERT INTO history (id_type, id_users, action) '
                . 'VALUES (?, ?, ?)';

        $result = $db->prepare($sql);
        $result->bindParam(1, $id_type);
        $result->bindParam(2, $id_users);
        $result->bindParam(2, $action);
        $result->execute();

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
