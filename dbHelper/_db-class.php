<?php

class _Database {

    private $DB_HOST;
    private $DB_USER;
    private $DB_PASS;
    private $DB_NAME;
    private $MSG_ERR;
    private $TABLE;
    private $FIELD;

    public function __construct($_HOST, $_DBNAME, $_USER, $_PASS) {
        $this->DB_HOST = $_HOST;
        $this->DB_NAME = $_DBNAME;
        $this->DB_USER = $_USER;
        $this->DB_PASS = $_PASS;
    }

    public function _ConnectDB() {
        try {
            $DB = new PDO("pgsql:host={$this->DB_HOST};dbname={$this->DB_NAME};", $this->DB_USER, $this->DB_PASS);
            return $DB;
        } catch (PDOException $ex) {
            $this->MSG_ERR = $ex->getMessage();
            return false;
        }
    }

    public function _dataView($query) {
        try {
            $DB = $this->_ConnectDB();
            $stmt = $DB->prepare($query);
            $stmt->execute();
            if ($stmt->rowCount() > 0) {
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    ?>
                    <tr>
                        <td><?php print($row['user_id']); ?></td>
                        <td><?php print($row['username']); ?></td>
                        <td><?php print($row['password']); ?></td>
                        <td><?php print($row['permission_id']); ?></td>
                        <td><?php print($row['create_date']); ?></td>
                        <td><?php print($row['modify_date']); ?></td>
                    </tr>
                    <?php
                }
            }
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
    }

}
