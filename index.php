<?php
$acc = "";
session_start();

if (isset($_GET['logout'])) {
    session_destroy();
} elseif (isset($_SESSION['user'])) {
    if ($_SESSION['user']['utype'] == "Passenger") {
        header("location: buy_ticket.php");
    } elseif ($_SESSION['user']['utype'] == "Owner") {
        header("location: my_buses.php");
    } elseif ($_SESSION['user']['utype'] == "Admin") {
        header("location: users.php");
    } else {
        header("location: logout.php");
    }
} elseif (isset($_POST['signup'])) {
    require_once 'inc/database.php';

    if ($_POST['name'] != "" && $_POST['uname'] != "" && $_POST['email'] != "" && $_POST['password'] != "") {
        $conn = initDB();
        $sql = "insert into users (name, uname, email, password, gender, utype, address, mobile) values ('";
        $sql .= $_POST['name'] . "','" . $_POST['uname'] . "','" . $_POST['email'] . "','" . $_POST['password'] . "','";
        $sql .= $_POST['gender'] . "','" . $_POST['utype'] . "','" . $_POST['address'] . "','" . $_POST['mobile'] . "')";

        if ($conn->query($sql)) {
            $acc = "ok";
        } else {
            $acc = $sql . "<br/>" . $conn->error;
        }
        $conn->close();
    } else {
       // header("location: index.php");
    }
} elseif (isset($_POST['login'])) {
    require_once 'inc/database.php';
    $conn = initDB();
    $res = $conn->query("select id,utype from users where uname='" . $_POST['uname'] . "' and password='" . $_POST['upass'] . "'");
    if ($res->num_rows == 0)
        $acc = "Dados incorrectos";
    else {
        $data = $res->fetch_assoc();
        $_SESSION['user'] = array('id' => $data['id'], 'uname' => $_POST['uname'], 'utype' => $data['utype']);
        header("Location: index.php");
    }
    $conn->close();
} else {}
include 'inc/basic_template.php';
t_header("Agendamento de bilhetes");
t_navbar();
?>

<div class="d-flex justify-content-center align-items-center min-vh-100">
    <div class="card" style="width: 28rem;">
        <div class="card-body">
            <?php
            if ($acc != "") {
                if ($acc == "ok") {
                    echo '<div class="alert alert-success text-center my-2">Conta criada com sucesso!</div>';
                } else {
                    echo '<div class="alert alert-danger text-center my-2">Erro: Houve um problema</div>';
                }
            }
            ?>

            <form action="index.php" method="post">
                <h4 class="my-3">Criar conta</h4>
                <hr>
                <div class="form-group row">
                    <label for="uname" class="col-sm-3 col-form-label">Nome de usuário</label>
                    <div class="col-sm-9">
                        <input name="uname" type="text" class="form-control" id="inputUname" placeholder="Nome" />
                    </div>
                    <div class="col-sm-3" id="infoUname"></div>
                </div>
                <div class="form-group row">
                    <label for="name" class="col-sm-3 col-form-label">Sobrenome</label>
                    <div class="col-sm-9">
                        <input name="name" type="text" class="form-control" id="inputName" placeholder="Sobrenome" />
                    </div>
                    <div class="col-sm-3" id="infoName"></div>
                </div>
                <div class="form-group row">
                    <label for="email" class="col-sm-3 col-form-label">Email</label>
                    <div class="col-sm-9">
                        <input name="email" type="text" class="form-control" id="inputEmail" placeholder="Email" />
                    </div>
                    <div class="col-sm-3" id="infoEmail"></div>
                </div>
                <div class="form-group row">
                    <label for="upass" class="col-sm-3 col-form-label">Senha</label>
                    <div class="col-sm-9">
                        <input name="password" type="password" class="form-control" id="inputPassword" placeholder="Senha">
                    </div>
                    <div class="col-sm-3" id="infoPass"></div>
                </div>
                <div class="form-group row">
                    <label class="col-form-legend col-sm-3" for="gender">Gênero</label>
                    <div class="col-sm-9 px-5">
                        <input class="form-check-input" type="radio" name="gender" id="radioMale" value="1" checked> Masculino <br/>
                        <input class="form-check-input" type="radio" name="gender" id="radioFemale" value="2"> Feminino
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-form-legend col-sm-3" for="utype">Tipo de usuário</label>
                    <div class="col-sm-9 px-5">
                        <input class="form-check-input" type="radio" name="utype" id="radioPass" value="3" checked> Passageiro <br/>
                        <input class="form-check-input" type="radio" name="utype" id="radioBO" value="2"> Proprietário do transporte
                    </div>
                </div>
                <div class="form-group row">
                    <label for="address" class="col-sm-3 col-form-label">Endereço</label>
                    <div class="col-sm-9">
                        <input name="address" type="text" class="form-control" id="inputAddress" placeholder="Endereço" />
                    </div>
                    <div class="col-sm-3" id="infoAddress"></div>
                </div>

                <!-- <script type="text/javascript">
                    var autocomplete;

                    function initialize() {
                        autocomplete = new google.maps.places.Autocomplete(document.getElementById("inputAddress"));
                        autocomplete.setComponentRestrictions({'country': 'bd'});
                        google.maps.event.addListener(autocomplete, 'place_changed', function() {});
                    }
                </script> -->
                <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places&callback=initialize" async defer></script>
                <div class="form-group row">
                    <label for="mobile" class="col-sm-3 col-form-label">Celular</label>
                    <div class="col-sm-9 input-group">
                        <span class="input-group-addon">+258</span>
                        <input name="mobile" type="text" class="form-control" id="inputMobile" placeholder="Número de celular" />
                    </div>
                    <div class="col-sm-3" id="infoMobile"></div>
                </div>
                <div class="form-group row">
                    <div class="offset-sm-3 col-sm-9">
                        <button type="submit" class="btn btn-success" name="signup">Registrar</button>
                    </div>
                </div>
                <script async>
                    $("#inputUname").keyup(function() {
                        $.ajax({
                            url: "inc/ajax.php?type=username&q=" + $(this).val(),
                            success: function(result) {
                                $("#infoUname").html(result);
                            }
                        });
                    });
                    $("#inputName").keyup(function() {
                        if ($(this).val().match('^[a-zA-Z ]{3,16}$')) {
                            $("#infoName").html(' ');
                        } else {
                            $("#infoName").html('<span class="text-danger">Nome inválido</span>');
                        }
                    });
                    $("#inputEmail").keyup(function() {
                        $.ajax({
                            url: "inc/ajax.php?type=email&q=" + $(this).val(),
                            success: function(result) {
                                $("#infoEmail").html(result);
                            }
                        });
                    });
                    $("#inputPassword").keyup(function() {
                        if ($(this).val().length >= 6) {
                            $("#infoPass").html(' ');
                        } else {
                            $("#infoPass").html('<span class="text-danger">Senha fraca</span>');
                        }
                    });
                </script>
            </form>
        </div>
    </div>
</div>

<?php
t_footer();
?>
