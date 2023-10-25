<?php
session_start();
if (!isset($_SESSION['user']) || $_SESSION['user']['utype'] != "Admin")
    header("Location: index.php");

include 'inc/basic_template.php';
t_header("Bus Ticket Booking &mdash; User Manager");
t_login_nav();
t_admin_sidebar();

if (isset($_GET['toggle'])) {
    require_once 'inc/database.php';
    $conn = initDB();
    if ($conn->query("update buses set approved=" . $_GET['toggle'] . " where id=" . $_GET['id']))
        echo '<script>alert("OK");</script>';
    else
        echo '<script>alert("Fail");</script>';
    $conn->close();
}
?>

<div class="row mb-2">
    <h4 class="col-md-3">Transportes</h4>
    <div class="col-md-8 text-right ml-4">
        <form method="post" action="">
            <div class="input-group">
                <input type="text" name="bus" class="form-control form-control-sm"
                    value="<?php echo (isset($_POST['bus'])) ? $_POST['bus'] : ""; ?>">
                <div class="input-group-append">
                    <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-search"></i> Pesquisar</button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="container">
    <div class="row">
        <?php
        require_once 'inc/database.php';
        $conn = initDB();
        $sql = "select *, users.uname as owner, buses.id as bid from buses, users where owner_id=users.id";
        if (isset($_POST['bus'])) {
            $sql .= " and (bname like '%" . $_POST['bus'] . "%' or bus_no like '%" . $_POST['bus'] . "%')";
        }
        $sql .= " order by approved";
        $res = $conn->query($sql);
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
                                <strong>Proprietario:</strong> ' . $row["owner"] . '<br>
                                <strong>De:</strong> ' . $row["from_loc"] . '<br>
                                <strong>Partida:</strong> ' . $row["from_time"] . '<br>
                                <strong>Para:</strong> ' . $row["to_loc"] . '<br>
                                <strong>Chegada:</strong> ' . $row["to_time"] . '<br>
                                <strong>Valor:</strong> ' . $row["fare"] . '<br>
                                <strong>Estado:</strong> <a href="buses.php?id=' . $row["bid"] . '&toggle=';
                if ($row["approved"])
                    echo '0" title="Clique para Desaprovar"><i class="fa fa-check text-success">';
                else
                    echo '1" title="Clique para Aprovar"><i class="fa fa-times text-danger">';
                echo '</i></a>
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
