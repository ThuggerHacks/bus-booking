<?php
session_start();
if (!isset($_SESSION['user']) || $_SESSION['user']['utype'] != "Admin")
    header("Location: index.php");

include 'inc/basic_template.php';
t_header("Bus User Booking — User Manager");
t_login_nav();
t_admin_sidebar();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Manager</title>
    <style>
        /* Add your CSS styles here */
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
        }

        .container {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            padding: 20px;
            margin: 20px auto;
            max-width: 800px;
            overflow: hidden;
            margin-top: 100px;
        }

        .cards-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }

        .card {
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
            width: calc(33.33% - 20px);
            margin-bottom: 20px;
            padding: 20px;
            transition: transform 0.3s;
        }

        .card:hover {
            transform: scale(1.03);
        }

        .card-content {
            padding: 15px;
            text-align: left;
        }

        h4 {
            color: #333;
        }

        .form-control-sm {
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 5px;
        }

        .btn-primary {
            background-color: #FF5733; /* Use the same non-blue color for buttons */
            color: #fff;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="popup" id="userViewer"></div>
    <div class="loader text-center" id="wait"><img src="/img/bus-loader.gif" alt="Espere..."/></div>
    <div class="row mb-2">
        <h4 class="col-md-3">Usuarios</h4>
        <div class="col-md-8 text-right ml-4">
            <form method="post" action="">
                <input type="text" name="user" class="form-control-sm" value="<?php echo (isset($_POST['user'])) ? $_POST['user'] : ""; ?>">
                <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> Pesquisar</button>
            </form>
        </div>
    </div>
    <div class="cards-container">
        <?php
        require_once 'inc/database.php';
        $conn = initDB();
        $query = "select * from users where id<>" . $_SESSION['user']['id'];
        if (isset($_POST['user'])) {
            $query .= " and (uname like '%" . $_POST['user'] . "%' or name like '%" . $_POST['user'] . "%')";
        }
        $res = $conn->query($query);
        if ($res->num_rows == 0) {
            echo '
            <div class="card">
                <div class="card-content">
                    <p>Sem usuarios</p>
                </div>
            </div>';
        } else {
            while ($row = $res->fetch_assoc()) {
                $userType = $row["utype"] == "Owner"?"Proprietario":"Passageiro";
                echo '
                <div class="card content">
                    <div class="card-content">
                        <h4>ID: ' . $row["id"] . '</h4>
                        <p>Usuario: ' . $row["uname"] . '</p>
                        <p>Sobrenome: ' . $row["name"] . '</p>
                        <p>Email: ' . $row["email"] . '</p>
                        <p>Genero: ' . $row["gender"] . '</p>
                        <p>Tipo: ' . $userType . '</p>
                        <p>Endereço: ' . $row["address"] . '</p>
                        <p>Celular: 0' . $row["mobile"] . '</p>
                    </div>
                </div>';
            }
        }
        $conn->close();
        ?>
    </div>
</div>
<script>
    $(".content").click(function() {
        var user = $(this).find("h4").text().split(' ')[1];
        $.ajax({
            url: "/inc/ajax.php?type=user&user=" + user,
            success: function(result) {
                setTimeout(function() {
                    $("#userViewer").html(result);
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
            $("#userViewer").show();
        }, 1000);
    });
</script>
</body>
</html>

<?php
t_footer();
?>

