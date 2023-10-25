<script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-v4-rtl/4.6.2-1/js/bootstrap.min.js" integrity="sha512-73t+oD9YRdVZBwLUw/FLF+4+mt6JyUhm8xUEgwA2/+QI3pM+t/6ALkELMcin6caoV1GVt3OMudVlHiMei0DXfQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<?php
session_start();
if (!isset($_SESSION['user']) || $_SESSION['user']['utype'] != "Passenger") {
  header("Location: index.php");
}
include 'inc/basic_template.php';
t_header("Bus Ticket Booking &mdash; Buy Tickets");
t_login_nav();
t_sidebar();

if (isset($_POST['buy'])) {
  require_once 'inc/database.php';
  $conn = initDB();
  if (!isset($_POST['seats']) || $_POST['seats'] == "") {
    echo '<div class="alert alert-danger" style="margin-top: 100px !important"><strong>Erro: </strong>Por favor selecione o assento</div>';
  } else {
    $sql = "insert into tickets (passenger_id, bus_id, jdate, seats, fare) values ('";
    $sql .= $_SESSION['user']['id'] . "','" . $_POST['bus_id'] . "','" . $_POST['jdate'] . "','" . serialize($_POST['seats']) . "','";
    $sql .= $_POST['fare'] . "')";

    if ($conn->query($sql)) {
      echo '<div class="alert alert-success" style="margin-top: 100px !important">Agendado <strong>com sucesso!</strong><br><a class="text-right" href="print.php?ticket=' . $conn->insert_id . '"><button class="btn btn-info">Imprimir</button></a></div>';
    } else {
      echo '<div class="alert alert-danger" style="margin-top: 100px !important"><strong>Erro: </strong> Houve um erro</div>';
    }
  }
  $conn->close();
}
?>
<!-- Select Locations -->
<link rel="stylesheet" href="css/easy-autocomplete.min.css" />
<link rel="stylesheet" href="css/bootstrap-datepicker.min.css" />
<form action="" method="get" style="margin-top: 100px !important">
  <div class="form-group row">
    <label for="from" class="col-sm-2 col-form-label">Apartir de</label>
    <div class="col-sm-7 well">
      <input type="text" class="form-control" id="inputFrom" name="from" value="<?php echo (isset($_GET['from'])) ? $_GET['from'] : ''; ?>" />
    </div>
  </div>
  <div class="form-group row">
    <label for="to" class="col-sm-2 col-form-label">Para</label>
    <div class="col-sm-7">
      <input type="text" class="form-control" id="inputTo" name="to" value="<?php echo (isset($_GET['to'])) ? $_GET['to'] : ''; ?>" />
    </div>
  </div>
  <script src="js/jquery.easy-autocomplete.min.js"></script>
  <script>
    var opt = {
      url: "inc/ajax.php?type=locations",
      list: {
        match: {
          enabled: true
        }
      }
    };
    $("#inputFrom").easyAutocomplete(opt);
    $("#inputTo").easyAutocomplete(opt);
  </script>
  <div class="form-group row" >
    <label for="jdate" class="col-sm-2 col-form-label">Data da viagem</label>
    <div class="col-sm-7 input-group">
      <input name="jdate" class="form-control" id="inputJDate"  value="<?php echo (isset($_GET['jdate'])) ? $_GET['jdate'] : ''; ?>" />
    </div>
  </div>
  
  <script src="js/bootstrap-datepicker.min.js"></script>
  <script>
    $('#inputJDate').datepicker({
      format: "dd/mm/yyyy",
      weekStart: 6,
      startDate: "today",
      autoclose: true,
      todayHighlight: true
    });
  </script>
  <div class="form-group row">
    <div class="col-sm-2"></div>
    <div class="col-sm-7">
      <input type="submit" class="btn btn-info" name="submit" value="Procurar" />
    </div>
  </div>
</form>
<div class="popup" id="seatViewer"></div>
<div class="loader text-center" id="wait"><img src="img/bus-loader.gif" alt="Wait..." /></div>
<div class="container">
  <div class="row">
    <?php
    require_once 'inc/database.php';
    $conn = initDB();
    $from = isset($_GET['from']) ? $_GET['from'] : "";
    $to = isset($_GET['to']) ? $_GET['to'] : "";
    $res = $conn->query("select * from buses where  from_loc='" . $from . "' and to_loc='" . $to . "'");
    if ($res->num_rows == 0 || !isset($_GET['jdate']) || $_GET['jdate'] == '') {
      echo '<div class="col-sm-12 text-center"><h4>Sem transportes para essa data</h4></div>';
    } else {
      while ($row = $res->fetch_assoc()) {
        echo '
        <div class="col-md-4 mb-4">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">' . $row['bname'] . '</h5>
              <ul class="list-group list-group-flush">
                <li class="list-group-item">ID: ' . $row['id'] . '</li>
                <li class="list-group-item">Hora de partida: ' . $row['from_time'] . '</li>
                <li class="list-group-item">Hora de chegada: ' . $row['to_time'] . '</li>
                <li class="list-group-item">Preço (Mt): ' . $row['fare'] . '</li>
              </ul>
            </div>
          </div>
        </div>';
      }
    }
    $conn->close();
    ?>
  </div>
</div>
<script>
  $(".card").click(function() {
    var bus = $(this).find("li:nth-child(1)").text().split(': ')[1];
    var date = "<?php echo $_GET['jdate'];?>";
    $.ajax({
      url: "inc/ajax.php?type=showseats&bus=" + bus + "&date=" + date,
      success: function(result) {
        setTimeout(function() {
          $("#seatViewer").html(result);
        }, 1000);
      },
      beforeSend: function() {
        $("#wait").show();
      },
      complete: function() {
        setTimeout(function() {
          $("#wait").hide();
        }, 1000);
      }
    });
    setTimeout(function() {
      $("#seatViewer").show();
    }, 1100);
  });
</script>
<?php
t_footer();
?>

