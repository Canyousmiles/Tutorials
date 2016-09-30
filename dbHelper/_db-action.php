<?php

include_once './_db-class.php';

if (isset($_POST['action_type']) && isset($_POST['tb_name']) && isset($_POST['field_name'])) {
    $DB = new _Database('localhost', 'root', '', 'db_project');
    $actionType = $_POST['action_type'];
    $tableName = $_POST['tb_name'];
    $filedName = $_POST['field_name'];

    if ($actionType == "fetch") {
        $arrData = $DB->_getView($tableName, $filedName);
        echo json_encode($arrData);
    }
    if ($actionType == "insert") {
        parse_str($_POST['form_data'], $arrData);
        $valueData = "'" . $arrData['txt_user_id'] . "', '" . $arrData['txt_username'] . "', '" . $arrData['txt_password'] . "', '" . $arrData['txt_permission'] . "', '" . date('d-m-Y H:i') . "', '" . date('d-m-Y H:i') . "'";
        $arrData = $DB->_insert($tableName, $filedName, $valueData);
    }
    if ($actionType == "update") {
        parse_str($_POST['form_data'], $arrData);
        $valueData = "SET username ='" . $arrData['txt_username'] . "',password ='" . $arrData['txt_password'] . "',permission ='" . $arrData['txt_permission'] . "' WHERE user_id ='" . $arrData['txt_user_id'] . "'";
        $arrData = $DB->_update($tableName, $valueData);
    }
}