<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Tutorials</title>
        <link rel="stylesheet" href="assets/css/bootstrap.css"/>
    </head>
    <body>
        <div class="panel panel-default"  id="content-form">
            <div class="panel-heading">
                <center><strong>ฟอร์มกรอกข้อมูล</strong></center>
            </div>
            <div class="panel-body">
                <form id="user-form">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">USER ID</label>
                                <input type="text" class="form-control" placeholder="ใส่ข้อมูล" name="txt_user_id" id="txt_user_id">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">USERNAME</label>
                                <input type="text" class="form-control" placeholder="ใส่ข้อมูล" name="txt_username" id="txt_username">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">PASSWORD</label>
                                <input type="password" class="form-control" placeholder="ใส่ข้อมูล" name="txt_password" id="txt_password">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">PERMISSION ID</label>
                                <input type="text" class="form-control" placeholder="ใส่ข้อมูล" name="txt_permission" id="txt_permission">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="panel-footer text-right">
                <button class="btn btn-primary" id="btn-save">บันทึก</button>
                <button class="btn btn-default" id="btn-cancel">กลับ</button>
            </div>
        </div>
        <div class="panel panel-default" id="content-table">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-md-1"><button class="btn btn-default" id="btn-add">เพิ่มข้อมูล</button></div>
                    <div class="col-md-11"><h5 class="text-center"><strong>USER TABLE</strong></h5></div>
                </div>
            </div>
            <table class="table table-hover text-center">
                <thead>
                    <tr>
                        <td><strong>No.</strong></td>
                        <td><strong>USER ID</strong></td>
                        <td><strong>USERNAME</strong></td>
                        <td><strong>PASSWORD</strong></td>
                        <td><strong>PERMISSION</strong></td>
                        <td><strong>CREATE DATE</strong></td>
                        <td><strong>MODIFY DATE</strong></td>
                        <td><strong>EDIT</strong></td>
                        <td><strong>DELETE</strong></td>
                    </tr>
                </thead>
                <tbody class="content-data-loader"></tbody>
            </table>
        </div>
        <script type="text/javascript" src="assets/js/jquery.min.js"></script>
        <script src="assets/js/bootstrap.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function () {
                var actionType = "";
                var tableName = "";
                var fieldName = "";
                function FetchData() {
                    actionType = "fetch";
                    tableName = "project_user";
                    fieldName = "*";
                    $.ajax({
                        url: "dbHelper/_db-action.php",
                        type: "POST",
                        data: {
                            action_type: actionType,
                            tb_name: tableName,
                            field_name: fieldName
                        },
                        success: function (data) {
                            var _data = $.parseJSON(data);
                            var _output = "";
                            $.each(_data, function (_key, _value) {
                                _output += "<tr>";
                                _output += "<td><span>" + (_key + 1) + "<span></td>";
                                _output += "<td><span>" + (_value['user_id']) + "</span></td>";
                                _output += "<td><span>" + (_value['username']) + "</span></td>";
                                _output += "<td><span>" + (_value['password']) + "</span></td>";
                                _output += "<td><span>" + (_value['permission']) + "</span></td>";
                                _output += "<td><span>" + (_value['create_date']) + "</span></td>";
                                _output += "<td><span>" + (_value['modify_date']) + "</span></td>";
                                _output += "<td><a href='#'user_id='" + (_value['user_id']) + "' id='btn-edit'><span class='glyphicon glyphicon-pencil'></span></a></td>";
                                _output += "<td><a href='#'user_id='" + (_value['user_id']) + "' id='btn-delete'><span class='glyphicon glyphicon-trash'></span></a></td>";
                                _output += "</tr>";
                            });
                            $('.content-data-loader').html(_output);
                            $('#content-table').removeClass('hide');
                        }
                    });
                }
                function ClearValues() {
                    $('#txt_user_id').val("");
                    $('#txt_username').val("");
                    $('#txt_password').val("");
                    $('#txt_permission').val("");
                }
                FetchData();
                $('#content-form').addClass('hide');
                $('#content-table').addClass('hide');


                $('#btn-add').on('click', function () {
                    $('#content-table').addClass('hide');
                    $('#content-form').removeClass('hide');
                    $('#txt_user_id').removeAttr('readonly').focus();
                    actionType = "insert";
                });
                $('.content-data-loader').on('click', '#btn-edit', function () {
                    fieldName = "*";
                    tableName = "project_user WHERE user_id='" + $(this).attr('user_id') + "' ";
                    actionType = "update";
                    console.log(tableName);
                    $.ajax({
                        url: "dbHelper/_db-action.php",
                        type: "POST",
                        data: {
                            action_type: "fetch",
                            tb_name: tableName,
                            field_name: fieldName
                        }, beforeSend: function () {
                            $('#content-form').removeClass('hide');
                            $('#content-table').addClass('hide');
                        },
                        success: function (data) {
                            var _data = $.parseJSON(data);
                            $.each(_data, function (_key, _value) {
                                $('#txt_user_id').val(_value['user_id']).attr('readonly', 'true');
                                $('#txt_username').val(_value['username']).focus();
                                $('#txt_password').val(_value['password']);
                                $('#txt_permission').val(_value['permission']);
                            });
                        }
                    });
                });
                $('.content-data-loader').on('click', '#btn-delete', function () {
                    tableName = "project_user WHERE user_id='" + $(this).attr('user_id') + "' ";
                    actionType = "delete";
                    $.ajax({
                        url: "dbHelper/_db-action.php",
                        type: "POST",
                        data: {
                            action_type: actionType,
                            tb_name: tableName,
                            field_name: ""
                        },
                        success: function (data) {
                            FetchData();
                        }
                    });
                });
                $('#btn-save').on('click', function () {
                    var tableName = "project_user";
                    var filedName = "user_id, username, password, permission, create_date, modify_date";
                    $.ajax({
                        url: "dbHelper/_db-action.php",
                        type: "POST",
                        data: {
                            action_type: actionType,
                            tb_name: tableName,
                            field_name: filedName,
                            form_data: $('#user-form').serialize()
                        }, beforeSend: function () {
                            ClearValues();
                            $('#content-form').addClass('hide');
                        },
                        success: function (data) {
                            alert(data);
                            FetchData();
                        }
                    });
                });
                $('#btn-cancel').on('click', function () {
                    ClearValues();
                    $('#content-table').removeClass('hide');
                    $('#content-form').addClass('hide');
                });
            });
        </script>
    </body>
</html>
