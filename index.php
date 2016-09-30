<?php
include_once 'dbHelper/_db-class.php';
$_DB = new _Database("localhost", "testuser", "testuser", "testdb");
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Bootstrap 101 Template</title
        <link rel="stylesheet" href="assets/css/bootstrap.min.css"/>
    </head>
    <body>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <td>USER ID</td>
                    <td>USERNAME</td>
                    <td>PASSWORD</td>
                    <td>PERMISSION</td>
                    <td>CREATE_DATE</td>
                    <td>MODIFY_DATE</td>
                </tr>
            </thead>
            <tbody class="content-data-loader"></tbody>
        </table>
        <script type="text/javascript" src="assets/js/jquery.min.js"></script>
        <script src="assets/js/bootstrap.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function () {
                function Fetch() {
                    $.ajax({
                        url: "",
                        type: 'POST',
                        data: {},
                        success: function (data) {
                            console.log(data);
                        }
                    });
                }
                Fetch();
            });
        </script>
    </body>
</html>
