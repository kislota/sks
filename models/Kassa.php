<?php

class Kassa {

    /**
     * Колличество записей на страницу
     */
    const SHOW_BY_DEFAULT = 15;

    /**
     * Изменение цвета ячейки
     * @param int $coming <p>Приход</p>
     * @param int $cost <p>Расход</p>
     * @return int $class <p>Стиль оформления</p>
     */
    public static function getKassaPayStyle($coming = 0, $cost = 0) {
        if ($coming > 0) {
            $class = Settings::getStatusClassTable(6);
        } elseif ($cost < 0) {
            $class = Settings::getStatusClassTable(5);
        }
//Расцветка таблицы
        return $class;
    }

    /**
     * Добавление платежа
     * @param int $id <p>Идентификатор записи из базы которой оплачиваем</p>
     * @param string $type <p>Имя базы данных из кторой оплачиваем</p>
     * @param int $coming <p>Приход положительное число из колонки в таблице price</p>
     * @param int $cost <p>Отрицательное число из колонки в таблице price</p>
     * @return int $insertId <p>Результат выполнения метода id в кассе</p>
     */
    public static function getPayAdd($id, $type, $coming = 0, $cost = 0) {
        // Проверка доступа
        $user = User::getUserCheckAccess();
        // Соединение с БД
        $db = Db::getConnection();
        if ($coming == 0 and $cost == 0) {
            //Получаем данные необходимые для оплаты
            $sql = 'SELECT * FROM ' . $type . ' WHERE id_' . $type . ' = :id';
            //Подготовленный запрос PDO
            $result = $db->prepare($sql);
            $result->bindParam(':id', $id, PDO::PARAM_INT);
            // Выполняем запрос
            $result->execute();
            // Указываем, что хотим получить данные в виде массива
            $result->setFetchMode(PDO::FETCH_ASSOC);
            // Возвращаем массив данных
            $arrPay = $result->fetch();
            if ($arrPay['price'] >= 0) {
                //Если сумма положительная тогда это приход
                $coming = $arrPay['price'];
            } else {
                //Если сумма отрицательная то это расход
                $cost = $arrPay['price'];
            }
        }
        $idType = 'id_' . $type;
        $id = $arrPay[$idType];
        $comment = 'Тут будет за что была оплата';
        $pay_user = $user['id_user'];

        // Текст запроса к БД
        $sql = 'INSERT INTO kassa (coming, cost, id_' . $type . ', comment, pay_user) '
                . 'VALUES (?, ?, ?, ?, ?)';

        //Подготовленный запрос PDO
        $result = $db->prepare($sql);
        //Передаём данные в псевдо переменные в запрос
        $result->bindParam(1, $coming);
        $result->bindParam(2, $cost);
        $result->bindParam(3, $id);
        $result->bindParam(4, $comment);
        $result->bindParam(5, $pay_user);

        // Выполняем запрос
        $result->execute();
        //Возвращаем id добавленной записи
        $insertId = $db->lastInsertId();
        return $insertId;
    }

    /**
     * Сколько в кассе денег
     * @param string $data <p>Дата за которую выводить сумму</p>
     */
    public static function getKassaTotalMoney($data = 0) {
        // Соединение с БД
        $db = Db::getConnection();
        $where = '';
        if ($data != 0)
            $where = 'WHERE data LIKE %' . $data . '%';
        // Текст запроса к БД Считаем сколько в кассе денег
        $sql = 'SELECT * FROM kassa ' . $where;
        //Подготовленный запрос PDO
        $result = $db->prepare($sql);
        $result->bindParam(':count', $count, PDO::PARAM_INT);
        // Указываем, что хотим получить данные в виде массива
        $result->setFetchMode(PDO::FETCH_ASSOC);
        // Выполнение коменды
        $result->execute();
        $i = 0;
        $total = 0;
        while ($row = $result->fetch()) {
            $coming = $row['coming'];
            $cost = $row['cost'];
            $total += $coming + $cost;
            $i++;
        }
        echo $total;
        return true;
    }

    /**
     * Вывод всех платежей
     * @return $kassaList <p>Возвращаем массив с данными платежей</p>
     */
    public static function getKassaList($page = 1) {
        $count = self::SHOW_BY_DEFAULT;
        // Смещение (для запроса)
        $offset = ($page - 1) * self::SHOW_BY_DEFAULT;
        // Соединение с БД
        $db = Db::getConnection();
        // Текст запроса к БД
        $sql = 'SELECT * FROM kassa '
                . 'ORDER BY data DESC '
                . 'LIMIT :count OFFSET :offset';
        //Подготовленный запрос PDO
        $result = $db->prepare($sql);
        $result->bindParam(':count', $count, PDO::PARAM_INT);
        $result->bindParam(':offset', $offset, PDO::PARAM_INT);
        // Указываем, что хотим получить данные в виде массива
        $result->setFetchMode(PDO::FETCH_ASSOC);
        // Выполнение коменды
        $result->execute();
        $i = 0;
        while ($row = $result->fetch()) {
            $kassaList[$i]['id'] = $row['id_kassa'];
            $kassaList[$i]['coming'] = $row['coming'];
            $kassaList[$i]['cost'] = $row['cost'];
            $kassaList[$i]['id_users'] = $row['id_users'];
            $kassaList[$i]['id_clients'] = $row['id_clients'];
            $kassaList[$i]['id_orders'] = $row['id_orders'];
            $kassaList[$i]['id_parts'] = $row['id_parts'];
            $kassaList[$i]['id_sales'] = $row['id_sales'];
            $kassaList[$i]['data'] = $row['data'];
            $kassaList[$i]['comment'] = $row['comment'];
            $kassaList[$i]['pay_user'] = $row['pay_user'];
            //Получаем данные о пользователе
            $userId = User::getUserById($kassaList[$i]['pay_user']);
            $kassaList[$i]['pay_user'] = $userId['firstname'];
            $i++;
        }

        //Возвращаем массив с данными
        return $kassaList;
    }

    /**
     * Вывод по фильтрам
     * @param string $where условие для выборки из базы
     * @return $kassaList <p>Возвращаем массив с данными по фильтру</p>
     */
    public static function getKassaListFilter($where, $page = 1) {
        $count = self::SHOW_BY_DEFAULT;
        // Смещение (для запроса)
        $offset = ($page - 1) * self::SHOW_BY_DEFAULT;
        // Соединение с БД
        $db = Db::getConnection();
        // Текст запроса к БД
        $sql = 'SELECT * FROM kassa WHERE ' . $where . ' ORDER BY data DESC LIMIT :count OFFSET :offset';
        //Подготовленный запрос PDO
        $result = $db->prepare($sql);
        $result->bindParam(':count', $count, PDO::PARAM_INT);
        $result->bindParam(':offset', $offset, PDO::PARAM_INT);
        // Указываем, что хотим получить данные в виде массива
        $result->setFetchMode(PDO::FETCH_ASSOC);
        // Выполнение коменды
        $result->execute();
        $kassaList = array();
        $i = 0;
        while ($row = $result->fetch()) {
            $kassaList[$i]['id'] = $row['id_kassa'];
            $kassaList[$i]['coming'] = $row['coming'];
            $kassaList[$i]['cost'] = $row['cost'];
            $kassaList[$i]['id_users'] = $row['id_users'];
            $kassaList[$i]['id_clients'] = $row['id_clients'];
            $kassaList[$i]['id_orders'] = $row['id_orders'];
            $kassaList[$i]['id_parts'] = $row['id_parts'];
            $kassaList[$i]['id_sales'] = $row['id_sales'];
            $kassaList[$i]['data'] = $row['data'];
            $kassaList[$i]['comment'] = $row['comment'];
            $kassaList[$i]['pay_user'] = $row['pay_user'];
            //Получаем данные о пользователе
            $userId = User::getUserById($kassaList[$i]['pay_user']);
            $kassaList[$i]['pay_user'] = $userId['firstname'];
            $i++;
        }
        //Возвращаем массив с данными
        return $kassaList;
    }

    public static function getPayDel($id) {
        // Соединение с БД
        $db = Db::getConnection();
        //Получаем данные необходимые для удаления оплаті оплаты
        $sqlSelect = 'SELECT * FROM kassa WHERE id_kassa = :id';
        //Подготовленный запрос PDO
        $result = $db->prepare($sqlSelect);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        // Выполняем запрос
        $result->execute();
        // Указываем, что хотим получить данные в виде массива
        $result->setFetchMode(PDO::FETCH_ASSOC);
        // Возвращаем массив данных
        $arrPayDel = $result->fetch();
        $sql = false;
        if ($arrPayDel['id_orders']) {
            $sql = 'UPDATE orders SET id_pay = 0 WHERE id_orders = ' . $arrPayDel['id_orders'];
        } elseif ($arrPayDel['id_parts']) {
            $sql = 'UPDATE parts SET id_pay = 0 WHERE id_parts = ' . $arrPayDel['id_parts'];
        } elseif ($arrPayDel['id_sales']) {
            $sql = 'UPDATE sales SET id_pay = 0 WHERE id_sales = ' . $arrPayDel['id_sales'];
        }
        if ($sql) {
            //Подготовленный запрос
            $kassaPayDel = $db->prepare($sql);
            //Выполняем запрос
            $kassaPayDel->execute();
        }
        if ($id) {
            //Удаляем запись об оплате
            $sqlKassa = 'DELETE FROM kassa WHERE id_kassa = ' . $id;
            //Подготовленный запрос
            $kassaDel = $db->prepare($sqlKassa);
            //Выполняем запрос
            $kassaDel->execute();
        }
        return true;
    }

}
