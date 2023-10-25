<?php
session_start();
if (!isset($_SESSION['user']) || $_SESSION['user']['utype'] != "Owner")
    header("location:index.php");
$add = "";
if (isset($_POST['add'])) {
    require_once 'inc/database.php';
    $conn = initDB();
    $sql = "insert into buses (bname, bus_no, from_loc, from_time, to_loc, to_time, fare, owner_id) values ('";
    $sql .= $_POST['bname']."','".$_POST['bus_no']."','".$_POST['from_loc']."','".$_POST['from_time']."','";
    $sql .= $_POST['to_loc']."','".$_POST['to_time']."','".$_POST['fare']."','".$_SESSION['user']['id']."')";
    if ($conn->query($sql)) {
        $add = "ok";
    }
    else {
        $add = $sql . "<br/>" .$conn->error;
    }
    $conn->close();
}
include 'inc/basic_template.php';
t_header("Agendamento de transportes");
t_login_nav();
t_owner_sidebar();
?>

<div class="modal" tabindex="-1" role="dialog" style="display: <?php echo ($_GET['act'] == 'add') ? 'block' : 'none';?>">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Adicionar transporte</h5>
        <a href="my_buses.php"><button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button></a>
      </div>
      <form method="post" action="my_buses.php">
      <div class="modal-body">
        <div class="form-group">
            <label for="bname">Nome do transporte</label>
            <input type="text" name="bname" class="form-control" id="bname"/>
        </div>
        <div class="form-group">
            <label for="bus_no">Numero do transporte</label>
            <input type="text" name="bus_no" class="form-control" id="bus_no"/>
        </div>
        <div class="form-group">
            <label for="from_loc">Apartir de</label>
            <input type="text" name="from_loc" class="form-control" id="from_loc"/>
        </div>
        <div class="form-group">
            <label for="from_time">Hora de partida</label>
            <input type="text" name="from_time" class="form-control" id="from_time"/>
        </div>
        <div class="form-group">
            <label for="to_loc">Para</label>
            <input type="text" name="to_loc" class="form-control" id="to_loc"/>
        </div>
        <link rel="stylesheet" href="css/easy-autocomplete.min.css"/>
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
        $("#from_loc, #to_loc").easyAutocomplete(opt);
        </script>
        <div class="form-group">
            <label for="to_time">Hora de chegada</label>
            <input type="text" name="to_time" class="form-control" id="to_time"/>
        </div>
        <div class="form-group">
            <label for="fare">Valor</label>
            <input type="text" name="fare" class="form-control" id="fare"/>
        </div>
      </div>
      <div class="modal-footer">
        <input type="submit" class="btn btn-success" value="Adicionar" name="add"/>
        <a href="my_buses.php"><button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button></a>
      </div>
      </form>
    </div>
  </div>
</div>

<div class="container" style="margin-top:100px !important">
<?php
if ($add!="") {
    if ($add == "ok") {
        echo '<div class="alert alert-success">Transporte adicionado<strong> com </strong>sucesso!</div>';
    }
    else {
        echo '<div class="alert alert-danger"><strong>Erro: </strong>'.$acc.'</div>';
    }
}
?>
<div class="row mb-2" style="margin-top:100px !important">
    <h4 class="col-md-3">Meus transportes</h4>
    <div class="col-md-8 text-right ml-4">
        <a href="my_buses.php?act=add"><button type="button" class="btn btn-success btn-sm">+ Novo transporte</button></a>
    </div>
</div>

<div class="row">
    <?php
    require_once 'inc/database.php';
    $conn = initDB();
    $res = $conn->query("select * from buses where owner_id=" . $_SESSION['user']['id']);
    if ($res->num_rows == 0) {
        echo '<div class="col-md-12 text-center">Sem transportes</div>';
    } else {
        while ($row = $res->fetch_assoc()) {
            echo '
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">' . $row["bname"] . '</h5>
                        <p class="card-text">
                            <strong>Numero de transporte:</strong> ' . $row["bus_no"] . '<br>
                            <strong>Apartir de:</strong> ' . $row["from_loc"] . '<br>
                            <strong>Hora de partida:</strong> ' . $row["from_time"] . '<br>
                            <strong>Para:</strong> ' . $row["to_loc"] . '<br>
                            <strong>Hora de chegada:</strong> ' . $row["to_time"] . '<br>
                            <strong>Valor:</strong> ' . $row["fare"] . '<br>
                            <strong>Estado:</strong> ' . (($row["approved"]) ? '<span class="text-success">Aprovado</span>' : '<span class="text-danger">Rejeitado</span>') . '
                        </p>
                    </div>
                </div>
            </div>';
        }
    }
    $conn->close();
    ?>
</div>
</div>
<?php
t_footer();
?>
