<?php
session_start();
include 'inc/basic_template.php';
t_header("Bus Ticket Booking");

$ok = "";
require_once 'inc/database.php';

if (isset($_POST['edit'])) {

  $id = intval($_POST['id']);
    $conn = initDB();
    $sql = "UPDATE users SET 
    name = '" . $_POST['name'] . "',
    email = '" . $_POST['email'] . "',
    gender = '" . $_POST['gender'] . "',
    address = '" . $_POST['address'] . "',
    mobile = '" . $_POST['mobile'] . "'";

if (isset($_POST['password']) && $_POST['password'] !== "") {
    $sql .= ", password = '" . $_POST['password'] . "'";
}

$sql .= " WHERE id = " . $_SESSION['user']['id'];

    if ($conn->query($sql))
        $ok = "ok";
    else {
        $ok = $sql . "<br/>" . $conn->error;
       var_dump($conn->error);
    }
    $conn->close();
}

$conn = initDB();
$res = $conn->query("select * from users where id=" . $_SESSION['user']['id']);
$userinfo = $res->fetch_assoc();
$conn->close();

t_login_nav();
if ($_SESSION['user']['utype'] == "Admin")
    t_admin_sidebar();
elseif ($_SESSION['user']['utype'] == "Owner")
    t_owner_sidebar();
else
    t_sidebar();
?>
<div class="modal fade" id="editModal" style="width:500px !important; margin:10px auto !important;left:50%;transform:translateX(-50%)" role="dialog">
    <div class="modal-content">
        <div class="modal-body">
            <div class="card">
                <div class="card-header text-center bg-success text-white">
                    <h5>Editar Perfil</h5>
                </div>
                <div class="card-body">
                    <form method="post" action="profile.php" id="editForm">
                        <div class="form-group">
                            <label for="name">Nome</label>
                            <input name="name" type="text" class="form-control" id="inputName"
                                value="<?php echo $userinfo['name']; ?>" />
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input name="email" type="text" class="form-control" id="inputEmail"
                                value="<?php echo $userinfo['email']; ?>" />
                        </div>
                        <div class="form-group">
                            <label for="upass">Nova senha</label>
                            <input name="password" type="password" class="form-control" id="inputPassword"
                                placeholder="Mantenha vazio para utilizar a senha anterior">
                        </div>
                        <div class="form-group">
                            <label>Genero</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="gender" id="radioMale" value="1"
                                    <?php echo ($userinfo['gender'] == 'Male') ? 'checked' : ''; ?>>
                                <label class="form-check-label" for="radioMale">Masculino</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="gender" id="radioFemale" value="2"
                                    <?php echo ($userinfo['gender'] == 'Female') ? 'checked' : ''; ?>>
                                <label class="form-check-label" for="radioFemale">Feminino</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="address">Endereço</label>
                            <input name="address" type="text" class="form-control" placeholder="Sua localizacao"
                                id="inputAddress" value="<?php echo $userinfo['address']; ?>" />
                        </div>
                        <div class="form-group">
                            <label for="mobile">Celular</label>
                            <div class="input-group">
                                <span class="input-group-addon">+258</span>
                                <input name="mobile" type="text" class="form-control" id="inputMobile"
                                    value="<?php echo $userinfo['mobile']; ?>" />
                                    <input name="id" type="hidden" class="form-control" id="inputMobile"
                                    value="<?php echo $userinfo['id']; ?>" />
                            </div>
                        </div>
                        <button type="submit" id="submitButton" name="edit" class="btn btn-success">Salvar</button>
                        <a type="button" class="btn btn-secondary" href="./profile.php">Fechar</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php
    if ($ok != "") {
        if ($ok == "ok") {
            echo '<div class="alert alert-success mt-3" style="margin-top: 100px !important">Alterações guardadas com sucesso</div>';
        } else {
            echo '<div class="alert alert-danger mt-3" style="margin-top: 100px !important"><strong>Houve um erro ao guardar as informações</strong></div>';
        }
    }
    ?>
</div>
<div class="container" style="margin-top: 100px !important">
    <div class="card">
        <div class="card-header text-center">
            <h5>Detalhes do Perfil</h5>
        </div>
        <div class="card-body">
            <div class="form-group row">
                <label for="uname" class="col-sm-2 col-form-label">Usuario</label>
                <div class="col-sm-10">
                    <?php echo $_SESSION['user']['uname']; ?>
                </div>
            </div>
            <div class="form-group row">
                <label for="name" class="col-sm-2 col-form-label">Sobrenome</label>
                <div class="col-sm-10">
                    <?php echo $userinfo['name']; ?>
                </div>
            </div>
            <div class="form-group row">
                <label for="email" class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-10">
                    <?php echo $userinfo['email']; ?>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Genero</label>
                <div class="col-sm-10">
                    <?php echo $userinfo['gender'] == "Male" ? "Masculino" : "Feminino"; ?>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Tipo de usuario</label>
                <div class="col-sm-10">
                    <?php
                    if ($_SESSION['user']['utype'] == "Passenger") {
                        echo "Passageiro";
                    } elseif ($_SESSION['user']['utype'] == "Owner") {
                        echo "Proprietario";
                    } else {
                        echo "Administrador";
                    }
                    ;
                    ?>
                </div>
            </div>
            <div class="form-group row">
                <label for="address" class="col-sm-2 col-form-label">Endereço</label>
                <div class="col-sm-10">
                    <?php echo $userinfo['address']; ?>
                </div>
            </div>
            <div class="form-group row">
                <label for="mobile" class="col-sm-2 col-form-label">Celular</label>
                <div class="col-sm-10 input-group">
                    +258
                    <?php echo $userinfo['mobile']; ?>
                </div>
            </div>
            <div class="form-group row">
                <div class="offset-sm-2 col-sm-10">
                    <button id="editButton" data-target="#editModal" data-toggle="modal" class="btn btn-success">Editar
                        Perfil</button>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
t_footer();
?>
<script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-v4-rtl/4.6.2-1/js/bootstrap.min.js" integrity="sha512-73t+oD9YRdVZBwLUw/FLF+4+mt6JyUhm8xUEgwA2/+QI3pM+t/6ALkELMcin6caoV1GVt3OMudVlHiMei0DXfQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>