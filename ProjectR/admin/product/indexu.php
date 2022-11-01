<style>
.bgc {
    background-color: purple;
}

.borderstyle {
    border-style: solid;
    border-width: 5px;
    border-color: purple;
}
</style>

<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
<script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.15/js/dataTables.bootstrap.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.js"></script>


<nav class="navbar navbar-light bgc">
    <div class="container-fluid">
        <a href=javascript:history.back(1)><img src="../images/back1.png" width="80px"></a>
        <a class="navbar-brand text-white" href="#">
            UNIT PRODUCT
        </a>
        <a type="button" name="add" id="add" class="btn rounded-pill"><img src="../images/add-user.png"
                width="80px"></a>
    </div>
</nav>

<div class="container box">
    <div class="table-responsive">
        <br />
        <div id="alert_message"></div>
        <table id="user_data" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th scope="col">หน่วยนับ</th>
                    <th scope="col">เมนู</th>
                </tr>
            </thead>
        </table>
    </div>
</div>

<script type="text/javascript" language="javascript">
    $(document).ready(function() {



// /////////////////////////////////////////////////////////////////////////////////////
    fetch_data();


    function fetch_data() {
        var dataTable = $('#user_data').DataTable({
            "processing": true,
            "serverSide": true,
            "order": [],
            "ajax": {
                url: "fetchu.php",
                type: "POST"
            }
        });
    }
// /////////////////////////////////////////////////////////////////////////////////////




// ///////////////////////////////////// add //////////////////////////////////////////////
    $('#add').click(function() {
        var html = '<tr>';
        html += '<td contenteditable id="data1"></td>';
        html +=
            '<td><button type="button" name="insert" id="insert" class="btn btn-success btn-xs">เพิ่มข้อมูล</button></td>';
        html += '</tr>';
        $('#user_data tbody').prepend(html);
    });


    $(document).on('click', '#insert', function() {
        var unit_name = $('#data1').text();
        if (unit_name != '') {
            $.ajax({
                url: "insertsqlu.php",
                method: "POST",
                data: {
                    unit_name: unit_name,
                },
                success: function(data) {
                    $('#alert_message').html('<div class="alert alert-success">' + data +
                        '</div>');
                    $('#user_data').DataTable().destroy();
                    fetch_data();
                }
            });
            setInterval(function() {
                $('#alert_message').html('');
            }, 5000);
        } else {
            alert("ไม่สามารถเพิ่มได้เพราะไม่มีข้อมูล");
        }
    });
// ///////////////////////////////////// add //////////////////////////////////////////////




// ///////////////////////////////////// update //////////////////////////////////////////////
    function update_data(unit_id, column_name, value) {
        $.ajax({
            url: "updateu.php",
            method: "POST",
            data: {
                unit_id: unit_id,
                column_name: column_name,
                value: value
            },
            success: function(data) {
                $('#alert_message').html('<div class="alert alert-success">' + data + '</div>');
                $('#user_data').DataTable().destroy();
                fetch_data();
            }
        });
        setInterval(function() {
            $('#alert_message').html('');
        }, 5000);
    }

    $(document).on('blur', '.update', function() {
        var unit_id = $(this).data("unit_id");
        var column_name = $(this).data("column");
        var value = $(this).text();
        update_data(unit_id, column_name, value);
    });
// ///////////////////////////////////// update //////////////////////////////////////////////

   


// ///////////////////////////////////// delete //////////////////////////////////////////////
    $(document).on('click', '.delete', function() {
        var unit_id = $(this).attr("unit_id");
        if (confirm("คุณต้องการลบหรือไม่ ?")) {
            $.ajax({
                url: "deleteu.php",
                method: "POST",
                data: {
                    unit_id: unit_id
                },
                success: function(data) {
                    $('#alert_message').html('<div class="alert alert-success">' + data +
                        '</div>');
                    $('#user_data').DataTable().destroy();
                    fetch_data();
                }
            });
            setInterval(function() {
                $('#alert_message').html('');
            }, 5000);
        }
    });
});
// ///////////////////////////////////// update //////////////////////////////////////////////
</script>