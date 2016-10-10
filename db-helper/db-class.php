<?php

class _DATABASE {

    private $_HOST;
    private $_DBNAME;
    private $_USER;
    private $_PASS;
    private $_MSG;

    public function __construct($HOST, $USER, $PASS, $DBNAME) {
        $this->_HOST = $HOST;
        $this->_USER = $USER;
        $this->_PASS = $PASS;
        $this->_DBNAME = $DBNAME;
    }

    protected function _connectDB() {
        try {
            $db = new PDO("mysql:host={$this->_HOST};dbname={$this->_DBNAME};", $this->_USER, $this->_PASS);
            $db->query("SET NAMES UTF8");
            return $db;
        } catch (PDOException $ex) {
            return $this->_MSG = $ex->getMessage();
        }
    }

    public function _getID($FIELD, $TABLE) {
        $strQUERY = "SELECT MAX(substr($FIELD,-7))+1 AS result_{$FIELD} FROM  {$TABLE}";
        try {
            $db = $this->_connectDB();
            $result = $db->query($strQUERY);
            if ($result == false) {
                echo $strQUERY;
            } else {
                return $result->fetchAll(PDO::FETCH_ASSOC);
            }
        } catch (PDOException $ex) {
            return $this->_MSG = $ex->getMessage();
        }
    }

    public function _selectDB($FIELD, $TABLE) {
        $strQUERY = "SELECT {$FIELD} FROM {$TABLE}";
        try {
            $db = $this->_connectDB();
            $result = $db->query($strQUERY);
            if ($result == false) {
                echo $strQUERY;
            } else {
                return $result->fetchAll(PDO::FETCH_ASSOC);
            }
        } catch (PDOException $ex) {
            return $this->_MSG = $ex->getMessage();
        }
    }

    public function _insertDB($FIELD, $TABLE, $VALUE) {
        $strQUERY = "INSERT INTO {$TABLE} ({$FIELD}) VALUES ({$VALUE})";
        try {
            $db = $this->_connectDB();
            $result = $db->query($strQUERY);
            if ($result == false) {
                echo $strQUERY;
            } else {
                echo "INSERT SUCCESSFULLY";
            }
        } catch (PDOException $ex) {
            return $this->_MSG = $ex->getMessage();
        }
    }

    public function _updateDB($TABLE, $VALUE) {
        $strQUERY = "UPDATE {$TABLE} {$VALUE}";
        try {
            $db = $this->_connectDB();
            $result = $db->query($strQUERY);
            if ($result == false) {
                echo $strQUERY;
            } else {
                echo "UPDATE COMPLETE";
            }
        } catch (PDOException $ex) {
            return $this->_MSG = $ex->getMessage();
        }
    }

    public function _deleteDB($TABLE) {
        $strQUERY = "DELETE FROM {$TABLE}";
        try {
            $db = $this->_connectDB();
            $result = $db->query($strQUERY);
            if ($result == false) {
                echo $strQUERY;
            } else {
                echo "DELETE COMPLETE";
            }
        } catch (PDOException $ex) {
            $this->_MSG = $ex->getMessage();
        }
    }

}
