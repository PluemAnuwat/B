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

  // ///////////////////////////////////// update //////////////////////////////////////////////
  function update_data(customer_id, column_name, value) {
    $.ajax({
      url: "update.php",
      method: "POST",
      data: {
        customer_id: customer_id,
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
    var customer_id = $(this).data("customer_id");
    var column_name = $(this).data("column");
    var value = $(this).text();
    update_data(customer_id, column_name, value);
  });
  // ///////////////////////////////////// update //////////////////////////////////////////////
});
