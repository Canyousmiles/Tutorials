<?php

class _Database {

    private $DB_HOST;
    private $DB_USER;
    private $DB_PASS;
    private $DB_NAME;
    private $MSG_ERROR;

    public function __construct($HOST, $USER, $PASS, $DBNAME) {
        $this->DB_HOST = $HOST;
        $this->DB_USER = $USER;
        $this->DB_PASS = $PASS;
        $this->DB_NAME = $DBNAME;
    }

    protected function _connectDB() {
        try {
            $DB = new PDO("mysql:host={$this->DB_HOST};dbname={$this->DB_NAME}", $this->DB_USER, $this->DB_PASS);
            return $DB;
        } catch (PDOException $ex) {
            $this->MSG_ERROR = $ex->getMessage();
        }
    }

    public function _getView($TABLE, $FIELD) {
        $strQuery = "SELECT $FIELD FROM $TABLE";
        try {
            $DB = $this->_connectDB();
            $RESULT = $DB->query($strQuery);
            if ($RESULT == true) {
                return $RESULT->fetchAll(PDO::FETCH_ASSOC);
            } else {
                echo $this->MSG_ERROR;
            }
        } catch (PDOException $ex) {
            $this->MSG_ERROR = $ex->getMessage();
        }
    }

    public function _insert($TABLE, $FIELD, $VALUE) {
        $strQuery = "INSERT INTO $TABLE ($FIELD) VALUES ($VALUE)";
        try {
            $DB = $this->_connectDB();
            $RESULT = $DB->query($strQuery);
            if ($RESULT == true) {
                echo "เพิ่มข้อมูลเรียบร้อย!";
            } else {
                echo $strQuery;
            }
        } catch (PDOException $ex) {
            $this->MSG_ERROR = $ex->getMessage();
        }
    }

    public function _update($TABLE, $VALUE) {
        $strQuery = "UPDATE $TABLE $VALUE";
        try {
            $DB = $this->_connectDB();
            $RESULT = $DB->query($strQuery);
            if ($RESULT == true) {
                echo "แก้ไขข้อมูลเรียบร้อย!";
            } else {
                echo $strQuery;
            }
        } catch (PDOException $ex) {
            $this->MSG_ERROR = $ex->getMessage();
        }
    }

    public function _delete($TABLE) {
        $strQuery = "DELETE FROM $TABLE";
        try {
            $DB = $this->_connectDB();
            $RESULT = $DB->query($strQuery);
            if ($RESULT == true) {
                echo "ลบข้อมูลเรียบร้อย!";
            } else {
                echo $strQuery;
            }
        } catch (Exception $ex) {
            $this->MSG_ERROR = $ex->getMessage();
        }
    }

}
