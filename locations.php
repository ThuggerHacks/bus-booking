<?php
session_start();
if (!isset($_SESSION['user']) || $_SESSION['user']['utype'] != "Admin")
    header("Location: index.php");

include 'inc/basic_template.php';
t_header("Bus Ticket Booking &mdash; User Manager");
t_login_nav();
t_admin_sidebar();
?>

<div class="container mt-5" style="margin-top:100px !important">
    <div class="row mb-2">
        <h4 class="col-md-3">Transportes</h4>
        <div class="col-md-8 text-right ml-4">
    <form method="post" action="">
        <div class="input-group">
            <input type="text" name="loc" class="form-control form-control-sm" value="<?php echo (isset($_POST['loc'])) ? $_POST['loc'] : ""; ?>">
            <div class="input-group-append">
                <button type="submit" class="btn btn-success btn-sm">
                    <i class="fa fa-search"></i> Pesquisar
                </button>
            </div>
        </div>
    </form>
</div>

    </div>

    <div class="row">
        <?php
        require_once 'inc/database.php';
        $conn = initDB();
        $sql = "select * from locations";
        if (isset($_POST['loc'])) {
            $sql .= " where (name like '%" . $_POST['loc'] . "')";
        }
        $sql .= " order by name";
        $res = $conn->query($sql);
        if ($res->num_rows == 0) {
            echo '<div class="col-md-12 text-center">Sem localiza&ccedil;&otilde;es</div>';
        } else {
            while ($row = $res->fetch_assoc()) {
                echo '
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">' . $row["name"] . '</h5>
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
