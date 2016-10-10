<?php

date_default_timezone_set("Asia/Bangkok");

include './db-class.php';
$db = new _DATABASE("localhost", "root", "", "test_db");
if (isset($_POST['action_name'])) {
    $_ACTION = $_POST['action_name'];
    if (isset($_POST['field_name']) && isset($_POST['table_name'])) {
        $_FIELD = $_POST['field_name'];
        $_TABLE = $_POST['table_name'];
        if ($_ACTION == "FETCH") {
            $arrDATA = $db->_selectDB($_FIELD, $_TABLE);
            echo json_encode($arrDATA);
        }
        if ($_ACTION == "ADD") {
            $_KEY = $_POST['key_name'];
            $arrDATA = $db->_getID($_FIELD, $_TABLE);
            foreach ($arrDATA as $result) {
                if ($result["result_" . $_FIELD] == "") {
                    echo $_KEY . "0000001";
                } else {
                    echo $_KEY . sprintf("%07d", $result["result_" . $_FIELD]);
                }
            }
        }
        if ($_ACTION == "INSERT") {
            parse_str($_POST['form_data'], $arrDATA);
            $_VALUE = "'" . $arrDATA['txt-emp-id'] . "',"
                    . "'" . $arrDATA['txt-title-name'] . "', "
                    . "'" . $arrDATA['txt-first-name'] . "', "
                    . "'" . $arrDATA['txt-last-name'] . "', "
                    . "'" . $arrDATA['cmb-position'] . "', "
                    . "'" . date('d-m-y H:i') . "', "
                    . "'" . date('d-m-y H:i') . "'";
            $db->_insertDB($_FIELD, $_TABLE, $_VALUE);
        }
        if ($_ACTION == "UPDATE") {
            parse_str($_POST['form_data'], $arrDATA);
            $_VALUE = "SET title_name='" . $arrDATA['txt-title-name'] . "', "
                    . "first_name='" . $arrDATA['txt-first-name'] . "', "
                    . "last_name='" . $arrDATA['txt-last-name'] . "', "
                    . "position='" . $arrDATA['cmb-position'] . "', "
                    . "modify_date='" . date('d-m-y H:i') . "' "
                    . "WHERE emp_id='" . $arrDATA['txt-emp-id'] . "'";
            $db->_updateDB($_TABLE, $_VALUE);
        }

        if ($_ACTION == "DELETE") {
            $db->_deleteDB($_TABLE);
        }
    }
}