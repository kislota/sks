<?php

class Trash {

//------------------------------------------------------------------------------
//-----------------------------Добавление в корзину-----------------------------
//------------------------------------------------------------------------------
    public static function getTrash($id, $trash = 1) {
        // Соединение с БД
        $db = Db::getConnection();
        //Выбираем заявку которую надо удалить
        $result = $db->query('UPDATE orders SET trash = ' . $trash . ' WHERE id_orders = ' . $id);
        // Выполнение коменды
        $result->execute();

        return true;
    }
}