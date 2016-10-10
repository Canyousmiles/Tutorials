<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include './_header.php'; ?>
    </head>
    <body>
        <div class="modal fade" id="modal-result">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="modal-title" id="modal-result-title">ข้อความระบบ</h4>
                    </div>
                    <div class="modal-body" id="modal-result-body"></div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-dismiss="modal">ตกลง</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default hide" id="content-form">
                        <div class="panel-heading">
                            <h5 class="text-center"><strong>EMPLOYEE FORM</strong></h5>
                        </div>
                        <div class="panel-body">
                            <form id="employee-form">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>EMPLOYEE ID</label>
                                            <input type="text" name="txt-emp-id" id="txt-emp-id" value="" placeholder="กรุณาใส่ข้อมูล" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>TITLE NAME</label>
                                            <input type="text" name="txt-title-name" id="txt-title-name" value="" placeholder="กรุณาใส่ข้อมูล" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>FIRST NAME</label>
                                            <input type="text" name="txt-first-name" id="txt-first-name" value="" placeholder="กรุณาใส่ข้อมูล" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>LAST NAME</label>
                                            <input type="text" name="txt-last-name" id="txt-last-name" value="" placeholder="กรุณาใส่ข้อมูล" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>POSITION</label>
                                            <select class="form-control" name="cmb-position" id="cmb-position">
                                                <option value="">SELECT</option>
                                                <option value="POS 1">POS 1</option>
                                                <option value="POS 2">POS 2</option>
                                                <option value="POS 3">POS 3</option>
                                                <option value="POS 4">POS 4</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="panel-footer text-right">
                            <button type="button" name="btn-save" id="btn-save" class="btn btn-primary btn-sm">บันทึกข้อมูล</button>
                            <button type="button" name="btn-cancel" id="btn-cancel" class="btn btn-default btn-sm">ยกเลิก</button>
                        </div>
                    </div>
                    <div class="panel panel-default hide" id="content-table">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-md-2"><button type="button" id="btn-add" class="btn btn-default"><strong>ADD</strong></button></div>
                                <div class="col-md-8 text-center"><h5><strong>EMPLOYEE TABLE</strong></h5></div>
                                <div class="col-md-2 text-right">
                                    <div class="input-group">
                                        <span class="input-group-btn">
                                            <button type="button" id="btn-find" class="btn btn-default"><span class="glyphicon glyphicon-search"></span></button>
                                        </span>
                                        <input type="text" name="txt-find" id="txt-find" value="" class="form-control" placeholder="FIND DATA">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <table class="table text-center">
                            <thead>
                                <tr>
                                    <td><strong>#</strong></td>
                                    <td><strong>EMPLOYEE ID</strong></td>
                                    <td><strong>FULL NAME</strong></td>
                                    <td><strong>POSITION</strong></td>
                                    <td><strong>CREATE DATE</strong></td>
                                    <td><strong>MODIFY DATE</strong></td>
                                    <td><strong>EDIT</strong></td>
                                    <td><strong>DELETE</strong></td>
                                </tr>
                            </thead>
                            <tbody id="content-table-result"></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </body>
    <footer>
        <?php include './_footer.php'; ?>
        <script type="text/javascript">
            $(document).ready(function () {
                var ACTION = "";
                var FIELD = "";
                var TABLE = "";
                var VALUE = "";
                var _DATA = "";
                var _OUTPUT = "";

                function _FETCH() {
                    ACTION = "FETCH";
                    FIELD = "*";
                    TABLE = "test_employee";
                    $.ajax({
                        url: "db-helper/db-action.php",
                        type: "POST",
                        data: {
                            action_name: ACTION,
                            field_name: FIELD,
                            table_name: TABLE
                        },
                        success: function (data) {
                            if (data != "[]") {
                                _DATA = $.parseJSON(data);
                                _OUTPUT = "";
                                $.each(_DATA, function (_key, _val) {
                                    _OUTPUT += "<tr>";
                                    _OUTPUT += "<td><h5><span>" + (_key + 1) + "</span></h5></td>";
                                    _OUTPUT += "<td><h5><span>" + (_val['emp_id']) + "</span></h5></td>";
                                    _OUTPUT += "<td><h5><span>" + (_val['title_name']) + " " + (_val['first_name']) + " " + (_val['last_name']) + "</span></h5></td>";
                                    _OUTPUT += "<td><h5><span>" + (_val['position']) + "</span></h5></td>";
                                    _OUTPUT += "<td><h5><span>" + (_val['create_date']) + "</span></h5></td>";
                                    _OUTPUT += "<td><h5><span>" + (_val['modify_date']) + "</span></h5></td>";
                                    _OUTPUT += "<td><a href='#' key_id='" + (_val['emp_id']) + "' id='link-edit'><button type='button' class='btn btn-warning btn-sm'><span class='glyphicon glyphicon-pencil'></span></button></a></td>";
                                    _OUTPUT += "<td><a href='#' key_id='" + (_val['emp_id']) + "' id='link-delete'><button type='button' class='btn btn-danger btn-sm'><span class='glyphicon glyphicon-trash'></span></button></a></td>";
                                    _OUTPUT += "</tr>";
                                });
                            } else {
                                _OUTPUT = "<tr><td colspan=8><span>ไม่พบข้อมูล</span></td></tr>";
                            }
                        },
                        complete: function () {
                            $("#content-table-result").html(_OUTPUT);
                            $("#content-table").removeClass("hide");
                        }
                    });
                }
                function _CLEAR() {
                    $("#txt-emp-id").val("");
                    $("#txt-title-name").val("");
                    $("#txt-first-name").val("");
                    $("#txt-last-name").val("");
                    $("#cmb-position").val("");
                }
                _FETCH();
                $("#btn-find").on("click", function () {
                    ACTION = "FETCH";
                    FIELD = "*";
                    TABLE = "test_employee WHERE emp_id LIKE '%" + $("#txt-find").val() + "%'";
                    $.ajax({
                        url: "db-helper/db-action.php",
                        type: "POST",
                        data: {
                            action_name: ACTION,
                            field_name: FIELD,
                            table_name: TABLE
                        },
                        success: function (data) {
                            if (data != "[]") {
                                _DATA = $.parseJSON(data);
                                _OUTPUT = "";
                                $.each(_DATA, function (_key, _val) {
                                    _OUTPUT += "<tr>";
                                    _OUTPUT += "<td><h5><span>" + (_key + 1) + "</span></h5></td>";
                                    _OUTPUT += "<td><h5><span>" + (_val['emp_id']) + "</span></h5></td>";
                                    _OUTPUT += "<td><h5><span>" + (_val['title_name']) + " " + (_val['first_name']) + " " + (_val['last_name']) + "</span></h5></td>";
                                    _OUTPUT += "<td><h5><span>" + (_val['position']) + "</span></h5></td>";
                                    _OUTPUT += "<td><h5><span>" + (_val['create_date']) + "</span></h5></td>";
                                    _OUTPUT += "<td><h5><span>" + (_val['modify_date']) + "</span></h5></td>";
                                    _OUTPUT += "<td><a href='#' key_id='" + (_val['emp_id']) + "' id='link-edit'><button type='button' class='btn btn-warning btn-sm'><span class='glyphicon glyphicon-pencil'></span></button></a></td>";
                                    _OUTPUT += "<td><a href='#' key_id='" + (_val['emp_id']) + "' id='link-delete'><button type='button' class='btn btn-danger btn-sm'><span class='glyphicon glyphicon-trash'></span></button></a></td>";
                                    _OUTPUT += "</tr>";
                                });
                            } else {
                                _OUTPUT = "<tr><td colspan=8><span style='color: red'>ไม่พบข้อมูลที่คุณค้นหา</span></td></tr>";
                            }
                        },
                        complete: function () {
                            $("#content-table-result").html(_OUTPUT);
                        }
                    });
                });
                $("#btn-add").on("click", function () {
                    ACTION = "INSERT";
                    FIELD = "emp_id";
                    TABLE = "test_employee";
                    $.ajax({
                        url: "db-helper/db-action.php",
                        type: "POST",
                        data: {
                            action_name: "ADD",
                            field_name: FIELD,
                            table_name: TABLE,
                            key_name: "EMP"
                        },
                        success: function (data) {
                            $("#txt-emp-id").attr("readonly", "true").val(data);
                        },
                        complete: function () {
                            $("#content-form").removeClass("hide");
                            $("#content-table").addClass("hide");
                            $("#txt-title-name").focus();
                        }
                    });
                });
                $("#btn-cancel").on("click", function () {
                    _CLEAR();
                    $("#content-table").removeClass("hide");
                    $("#content-form").addClass("hide");
                });
                $("#btn-save").on("click", function () {
                    FIELD = "emp_id, title_name, first_name, last_name, position, create_date, modify_date";
                    TABLE = "test_employee";
                    VALUE = $("#employee-form").serialize();
                    $.ajax({
                        url: "db-helper/db-action.php",
                        type: "POST",
                        data: {
                            action_name: ACTION,
                            field_name: FIELD,
                            table_name: TABLE,
                            form_data: VALUE
                        },
                        success: function (data) {
                            $("#modal-result-body").html("<p>" + data + "</p>");
                        },
                        complete: function () {
                            $("#content-form").addClass("hide");
                            $("#modal-result").modal("toggle");
                            _FETCH();
                            _CLEAR();
                        }
                    });
                });
                $("#content-table-result").on("click", "#link-edit", function () {
                    ACTION = "UPDATE";
                    FIELD = "*";
                    TABLE = "test_employee WHERE emp_id='" + $(this).attr("key_id") + "'";
                    $.ajax({
                        url: "db-helper/db-action.php",
                        type: "POST",
                        data: {
                            action_name: "FETCH",
                            field_name: FIELD,
                            table_name: TABLE
                        },
                        success: function (data) {
                            _DATA = $.parseJSON(data);
                            $.each(_DATA, function (_key, _val) {
                                $("#txt-emp-id").attr("readonly", "true").val(_val['emp_id']);
                                $("#txt-title-name").val(_val['title_name']);
                                $("#txt-first-name").val(_val['first_name']);
                                $("#txt-last-name").val(_val['last_name']);
                                $("#cmb-position").val(_val['position']);
                            });
                        },
                        complete: function () {
                            $("#content-form").removeClass("hide");
                            $("#content-table").addClass("hide");
                            $("#txt-title-name").focus();
                        }
                    });
                });
                $("#content-table-result").on("click", "#link-delete", function () {
                    ACTION = "DELETE";
                    TABLE = "test_employee WHERE emp_id='" + $(this).attr("key_id") + "'";
                    $.ajax({
                        url: "db-helper/db-action.php",
                        type: "POST",
                        data: {
                            action_name: ACTION,
                            field_name: "",
                            table_name: TABLE
                        },
                        success: function (data) {
                            console.log(data);
                        },
                        complete: function () {
                            _FETCH();
                        }
                    });
                });
            });
        </script>
    </footer>
</html>
