<?php

class Client {

    /**
     * Колличество записей на страницу
     */
    const SHOW_BY_DEFAULT = 15;

    /**
     * Список клиентов
     * @param int $page <p>Текущаяя страница</p>
     * @return array $clientList <p>Данные о клиентах</p>
     */
    public static function getClientList($page = 1) {
        $count = self::SHOW_BY_DEFAULT;
        $offset = ($page - 1) * self::SHOW_BY_DEFAULT;
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = 'SELECT clients.*, clients_address.* FROM clients LEFT '
                . 'JOIN clients_address ON clients.id_address = '
                . 'clients_address.id_address '
                . 'ORDER BY clients.id_client DESC LIMIT :count OFFSET :offset';

        // Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':count', $count, PDO::PARAM_INT);
        $result->bindParam(':offset', $offset, PDO::PARAM_INT);
        // Выполнение коменды
        $result->execute();
        foreach ($result as $key => $value) {
            $clientList[$key] = $value;
        }
        return $clientList;
    }

    /**
     * Проверка на существование клиента в базе
     * @param string $firstname <p>Имя клиента</p>
     * @param string $lastname <p>Фамилия клиента</p>
     * @param string $phone <p>Номер телефона клиента</p>
     * @param string $address <p>Номер телефона клиента</p>
     * @return int $clientId <p>Идентификатор клиента</p>
     */
    public static function getClientChek($firstname, $lastname, $phone, $address = '') {
        // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = 'SELECT * FROM clients WHERE firstname = :firstname AND lastname = :lastname';

        // Получение результатов. Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':firstname', $firstname, PDO::PARAM_INT);
        $result->bindParam(':lastname', $lastname, PDO::PARAM_INT);
        $result->execute();
        // Обращаемся к записи
        $client = $result->fetch();

        if ($client) {
            // Если запись существует, возвращаем id пользователя
            $clientId = $client['id_client'];
            return $clientId;
        }

        if (!$client['id']) {
            $clientId = self::getClientAdd($firstname, $lastname, $phone, $address);
            return $clientId;
        }
    }

    /**
     * Добавление нового клиента
     * @param string $firstname <p>Имя клиента</p>
     * @param string $lastname <p>Фамилия клиента</p>
     * @param string $phone <p>Номер телефона клиента</p>
     * @param int $id_address <p>Идентификатор адресса клиента в базе</p>
     * @param int $problem <p>Проблемный или нет клиент. Проблемный = 1. Нет = 0</p>
     * @return int $insertId <p>Идентификатор клиента</p>
     */
    public static function getClientAdd($firstname, $lastname, $phone, $address = 0, $problem = 0) {
        // Соединение с БД
        $db = Db::getConnection();
        // Текст запроса к БД
        $sql = 'INSERT INTO clients_address (address) '
                . 'VALUES (?)';

        $result = $db->prepare($sql);
        $result->bindParam(1, $address);
        $result->execute();
        //id последней добавленной записи
        $id_address = $db->lastInsertId();

        // Текст запроса к БД
        $sql = 'INSERT INTO clients (firstname, lastname, phone, id_address, problem) '
                . 'VALUES (?, ?, ?, ?, ?)';

        $result = $db->prepare($sql);
        $result->bindParam(1, $firstname);
        $result->bindParam(2, $lastname);
        $result->bindParam(3, $phone);
        $result->bindParam(4, $id_address);
        $result->bindParam(5, $problem);
        $result->execute();

        //id последней добавленной записи
        $insertId = $db->lastInsertId();
        return $insertId;
    }

    /**
     * Редактирование клиента
     * @param int $id <p>Идентификатор клиента</p>
     * @return boolean true/false
     */
    public static function getClientEdit($id) {
        return true;
    }

    /**
     * Удаление клиента
     * @param int $id <p>Идентификатор клиента</p>
     * @return boolean true/false
     */
    public static function getClientDel($id) {
        return true;
    }

    /**
     * Вывод данных одного клиента
     * @param int $id <p>Идентификатор клиента</p>
     * @return array $clientId <p>Массив с клентам</p>
     */
    public static function getClientById($id) {

        $db = Db::getConnection();
        // Текст запроса к БД
        $sql = 'SELECT clients.*, clients_address.* FROM clients LEFT '
                . 'JOIN clients_address ON clients.id_address = '
                . 'clients_address.id_address '
                . 'WHERE clients.id_client = :id';
        // Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        // Выполнение коменды
        $result->execute();
        $result->setFetchMode(PDO::FETCH_ASSOC);
        return $result->fetch();
    }

    /**
     * Вывод данных одного клиента
     * @param int $id_address <p>Идентификатор адреса клиента</p>
     * @return array $addressId <p>Массив с адресом клента</p>
     */
    public static function getClientAddressById($id_address) {
        /*        $table = 'clients_address';
          $where = 'id_client = ' . $id_address;

          $result = Db::getSelect($table, $where);
          debug($result);
          die;
          $addressId = [];
          foreach ($result as $key) {
          $addressId = $key;
          }
          //Возвращаем массив с данными для вывода заявки
          return $addressId;
         */
        return true;
    }

    /**
     * Поиск по клиенту AJAX
     * @param int $search <p>строка поиска</p>
     * @return array $clientList <p>Массив с клентам</p>
     */
    public static function getClientSearch($search) {
        // Соединение с БД
        $db = Db::getConnection();
        // Текст запроса к БД
        $sql = 'SELECT * FROM clients '
                . 'WHERE firstname LIKE ? '
                . 'ORDER BY id_client DESC';
        // Используется подготовленный запрос
        $result = $db->prepare($sql);
        //Выполняем запрос
        $result->execute(array("%$search%"));
        // Указываем, что хотим получить данные в виде массива
        $result->setFetchMode(PDO::FETCH_ASSOC);
        // Массив для клиентов
        foreach ($result as $key => $value) {
            $clientList = $value;
            echo "<li>" . $clientList['firstname'] . " " . $clientList['lastname'] . " " . $clientList['phone'] . "</li>";
        }
        //Возврящаем массив с клиентами
        return true;
    }

}
