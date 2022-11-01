$(document).ready(function () {
  // /////////////////////////////////////////////////////////////////////////////////////
  fetch_data();

  function fetch_data() {
    var dataTable = $("#user_data").DataTable({
      processing: true,
      serverSide: true,
      order: [],
      ajax: {
        url: "fetch.php",
        type: "POST",
      },
    });
  }
  // /////////////////////////////////////////////////////////////////////////////////////

  // ///////////////////////////////////// add //////////////////////////////////////////////
  $("#add").click(function () {
    var html = "<tr>";
    html += '<td contenteditable id="data1"></td>';
    html += '<td contenteditable id="data2"></td>';
    html += '<td contenteditable id="data3"></td>';
    html += '<td contenteditable id="data4"></td>';
    html +=
      '<td><button type="button" name="insert" id="insert" class="btn btn-success btn-xs">เพิ่มข้อมูล</button></td>';
    html += "</tr>";
    $("#user_data tbody").prepend(html);
  });

  $(document).on("click", "#insert", function () {
    var suppiles_name = $("#data1").text();
    var suppiles_company = $("#data2").text();
    var suppiles_phone = $("#data3").text();
    var suppiles_email = $("#data4").text();
    if (suppiles_phone != "") {
      $.ajax({
        url: "insert.php",
        method: "POST",
        data: {
          suppiles_name: suppiles_name,
          suppiles_company: suppiles_company,
          suppiles_phone: suppiles_phone,
          suppiles_email: suppiles_email,
        },
        success: function (data) {
          $("#alert_message").html(
            '<div class="alert alert-success">' + data + "</div>"
          );
          $("#user_data").DataTable().destroy();
          fetch_data();
        },
      });
      setInterval(function () {
        $("#alert_message").html("");
      }, 5000);
    } else {
      alert("ไม่สามารถเพิ่มได้เพราะไม่มีข้อมูล");
    }
  });
  // ///////////////////////////////////// add //////////////////////////////////////////////

  // ///////////////////////////////////// update //////////////////////////////////////////////
  function update_data(suppiles_id, column_name, value) {
    $.ajax({
      url: "update.php",
      method: "POST",
      data: {
        suppiles_id: suppiles_id,
        column_name: column_name,
        value: value,
      },
      success: function (data) {
        $("#alert_message").html(
          '<div class="alert alert-success">' + data + "</div>"
        );
        $("#user_data").DataTable().destroy();
        fetch_data();
      },
    });
    setInterval(function () {
      $("#alert_message").html("");
    }, 5000);
  }

  $(document).on("blur", ".update", function () {
    var suppiles_id = $(this).data("suppiles_id");
    var column_name = $(this).data("column");
    var value = $(this).text();
    update_data(suppiles_id, column_name, value);
  });
  // ///////////////////////////////////// update //////////////////////////////////////////////

  // ///////////////////////////////////// delete //////////////////////////////////////////////
  $(document).on("click", ".delete", function () {
    var suppiles_id = $(this).attr("suppiles_id");
    if (confirm("คุณต้องการลบหรือไม่ ?")) {
      $.ajax({
        url: "delete.php",
        method: "POST",
        data: {
          suppiles_id: suppiles_id,
        },
        success: function (data) {
          $("#alert_message").html(
            '<div class="alert alert-success">' + data + "</div>"
          );
          $("#user_data").DataTable().destroy();
          fetch_data();
        },
      });
      setInterval(function () {
        $("#alert_message").html("");
      }, 5000);
    }
  });
});
// ///////////////////////////////////// update //////////////////////////////////////////////
