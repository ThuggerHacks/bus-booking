<?php
session_start();
if (!isset($_SESSION['user']) || $_SESSION['user']['utype'] != "Passenger") {
    header("Location: index.php");
}
include 'inc/basic_template.php';
t_header("Bus Ticket Booking &mdash; History");
t_login_nav();
t_sidebar();
?>

<div class="container" style="margin-top: 100px !important">
    <div class="popup" id="seatViewer"></div>
    <div class="loader text-center" id="wait"><img src="img/bus-loader.gif" alt="Wait..." /></div>
    <h4>Historico</h4>

    <div class="row">
        <?php
        require_once 'inc/database.php';
        $conn = initDB();
        $query = "select t.id as t_id, t.jdate, t.fare, t.seats, b.id as bus_id, b.bname as bus_name,";
        $query .= "b.from_loc, b.to_loc, b.from_time, b.to_time from tickets t, buses b where t.bus_id = b.id and t.passenger_id=" . $_SESSION['user']['id'];
        $res = $conn->query($query);

        if ($res->num_rows == 0) {
            echo '
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        Sem bilhetes
                    </div>
                </div>
            </div>';
        } else {
            while ($row = $res->fetch_assoc()) {
                echo '
                <div class="col-md-6 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">' . $row["bus_name"] . '</h5>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">ID: ' . $row["t_id"] . '</li>
                                <li class="list-group-item">Partida: ' . $row["from_loc"] . '</li>
                                <li class="list-group-item">Destino: ' . $row["to_loc"] . '</li>
                                <li class="list-group-item">Hora de Partida: ' . $row["from_time"] . '</li>
                                <li class="list-group-item">Hora de Chegada: ' . $row["to_time"] . '</li>
                                <li class="list-group-item">Data da Viagem: ' . $row["jdate"] . '</li>
                                <li class="list-group-item">Preço: ' . $row["fare"] . '</li>
                                <li class="list-group-item">Número de Assentos: ' . count(unserialize($row["seats"])) . '</li>
                                <li class="list-group-item">Lugares: ' . $row["seats"] . '</li>
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
        var ticket = $(this).find("li:nth-child(1)").text().split(': ')[1];
        $.ajax({
            url: "inc/ajax.php?type=showseats&ticket=" + ticket,
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
        }, 1000);
    });
</script>
<?php
t_footer();
?>
