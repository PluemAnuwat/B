
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.15/js/dataTables.bootstrap.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.js"></script>


<a type="button" name="add" id="add" class="btn btn-primary rounded-pill">เพิ่มประเภท</a>

<div class=" box">
    <div class="table-responsive">
        <br />
        <div id="alert_message"></div>
        <table id="user_data" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th scope="col">ประเภทสินค้า</th>
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
                url: "type_fetch.php",
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
        var type_name = $('#data1').text();
        if (type_name != '') {
            $.ajax({
                url: "type_insert_sql.php",
                method: "POST",
                data: {
                    type_name: type_name,
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
    function update_data(type_id, column_name, value) {
        $.ajax({
            url: "type_update.php",
            method: "POST",
            data: {
                type_id: type_id,
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
        var type_id = $(this).data("type_id");
        var column_name = $(this).data("column");
        var value = $(this).text();
        update_data(type_id, column_name, value);
    });
// ///////////////////////////////////// update //////////////////////////////////////////////

   


// ///////////////////////////////////// delete //////////////////////////////////////////////
    $(document).on('click', '.delete', function() {
        var type_id = $(this).attr("type_id");
        if (confirm("คุณต้องการลบหรือไม่ ?")) {
            $.ajax({
                url: "type_delete.php",
                method: "POST",
                data: {
                    type_id: type_id
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