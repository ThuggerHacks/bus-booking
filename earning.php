<?php
session_start();
if (!isset($_SESSION['user']) || $_SESSION['user']['utype'] != "Owner") {
    header("Location: index.php");
}

include 'inc/basic_template.php';
t_header("Bus Ticket Booking &mdash; Earnings");
t_login_nav();
t_owner_sidebar();
?>

<div class="container" style="margin-top: 100px !important">
    <h4>Historico de Ganhos</h4>
    <div class="row">
        <?php
        require_once 'inc/database.php';
        $conn = initDB();
        $res = $conn->query("select jdate,bus_id, b.bname, b.from_loc,b.to_loc,b.from_time, sum(t.fare) as earn from tickets t, buses b where t.bus_id = b.id and b.owner_id = " . $_SESSION['user']['id'] . " group by(jdate)");
        if ($res->num_rows == 0) {
            echo '<h4 class="col-md-12 text-center">Histórico de ganhos vazio</h4>';
        } else {
            while ($row = $res->fetch_assoc()) {
                echo '<div class="col-md-4 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">' . $row['bname'] . '</h5>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">Data: ' . $row['jdate'] . '</li>
                                <li class="list-group-item">Apartir de: ' . $row['from_loc'] . '</li>
                                <li class="list-group-item">Para: ' . $row['to_loc'] . '</li>
                                <li class="list-group-item">Hora de Saída: ' . $row['from_time'] . '</li>
                                <li class="list-group-item">Ganho (Mt): ' . $row['earn'] . '</li>
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

<?php
t_footer();
?>
