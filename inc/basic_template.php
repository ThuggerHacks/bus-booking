<?php
function t_header($title) {
    echo '
    <!DOCTYPE html>
    <html>
    <head>
      <title>'.$title.'</title>
      <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css"/>
      <link rel="stylesheet" type="text/css" href="css/font-awesome.min.css"/>
      <link rel="stylesheet" type="text/css" href="css/style.css?'.date('his').'"/>
      <style>
        /* Add your CSS styles here */
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
        }
        
        .container {

        }
        
        .navbar {
            background-color: #4CAF50; /* Green color */
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
            color: #fff;
        }
        
        .navbar a {
            color: #fff;
        }
        
        .navbar-right {
            float: right;
        }
        
        .navbar form {
            margin-top: 5px;
        }

        /* Header Styles */
        .header {
            background-color: #4CAF50; /* Green color */
            padding: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
            color: #fff;
        }

        /* Sidebar Styles */
        .sidebar {
            background-color: #4CAF50; /* Green color */
            color: #fff;
            border-top-left-radius: 10px;
            border-bottom-left-radius: 10px;
            margin-top: 20px;
            padding: 20px 0;
        }

        .sidebar a {
            color: #fff;
            text-decoration: none;
            display: block;
            padding: 10px 20px;
            border-bottom: 1px solid #fff; /* Border for each item */
        }
      </style>
    </head>
    <body>';
}

function t_navbar() {
    echo '
    <div class="navbar fixed-top navbar-default header" style="background-color: #your-color-code; height: 60px;">
    <div class="container-fluid">
        <h3>TRANSPORTER</h3>
        <div class="navbar-right">
            <form action="index.php" method="post" class="form-inline">
                <input type="text" name="uname" placeholder="Nome de usuario" class="form-control-sm mr-1"/>
                <input type="password" name="upass" placeholder="Senha" class="form-control-sm mr-1"/>
                <input type="submit" name="login" value="Entrar" class="btn btn-success btn-sm"/>
            </form>
        </div>
    </div>
    </div>';
}

function t_login_nav() {
    echo '
    <div class="navbar fixed-top navbar-default header" style="background-color: #your-color-code; height: 60px;">
    <div class="container-fluid">
        <h3>TRANSPORTER</h3>
        <div class="navbar-right">
            Bem-vindo, '.$_SESSION['user']['uname'].' <a href="logout.php"><button class="btn btn-success btn-sm">Sair</button></a>
        </div>
    </div>
    </div>';
}

// Other functions remain the same

function t_sidebar() {
    $file = basename($_SERVER['PHP_SELF'],'.php');
    echo '
    <div class="row">
        <div class="col-md-2 sidebar">
            <div class="sidebar">
                <a href="buy_ticket.php"'.(($file == 'buy_ticket') ? 'class="active"' : '').'><i class="fa fa-ticket"></i> Comprar bilhete</a>
                <a href="profile.php"'.(($file == 'profile') ? 'class="active"' : '').'><i class="fa fa-address-card"></i> Meu perfil</a>
                <a href="history.php"'.(($file == 'history') ? 'class="active"' : '').'><i class="fa fa-history"></i> Historico</a>
            </div>
        </div>
        <div class="col-md-10">
            <div class="container-fluid my-4">
    ';
}

function t_owner_sidebar() {
    $file = basename($_SERVER['PHP_SELF'],'.php');
    echo '
    <div class="row">
        <div class="col-md-2 sidebar">
            <div class="sidebar">
                <a href="my_buses.php"'.(($file == 'my_buses') ? 'class="active"' : '').'><i class="fa fa-bus"></i> Meus transportes</a>
                <a href="earning.php"'.(($file == 'earning') ? 'class="active"' : '').'><i class="fa fa-money"></i> Meus ganhos</a>
                <a href="profile.php"'.(($file == 'profile') ? 'class="active"' : '').'><i class="fa fa-address-card"></i> Meu perfil</a>
            </div>
        </div>
        <div class="col-md-10">
            <div class="container-fluid my-4">
    ';
}

function t_admin_sidebar() {
    $file = basename($_SERVER['PHP_SELF'],'.php');
    echo '
    <div class="row">
        <div class="col-md-2 sidebar">
            <div class="sidebar">
                <a href="users.php"'.(($file == 'users') ? 'class="active"' : '').'><i class="fa fa-users"></i> Usuarios</a>
                <a href="locations.php"'.(($file == 'locations') ? 'class="active"' : '').'><i class="fa fa-map"></i> Localiza&ccedil;&otilde;es</a>
                <a href="buses.php"'.(($file == 'buses') ? 'class="active"' : '').'><i class="fa fa-bus"></i> Transportes</a>
                <a href="profile.php"'.(($file == 'profile') ? 'class="active"' : '').'><i class="fa fa-address-card"></i> Meu perfil</a>
            </div>
        </div>
        <div class="col-md-10">
            <div class="container-fluid my-4">
    ';
}

function t_footer() {
    echo '
    </div>
    </div>
</div>
<div class="footer">
    <div class="row p-4">
        <div class="col-md-4">Sistema de agendamento de transportes públicos para viagens curtas e longas<br/>&copy; '.date("Y").' - Todos os direitos reservados</div>
        <div class="col-md-4 text-center">
        <ul class="list-null">
            <li><a href="#">Sobre nós</a></li>
            <li><a href="#">Contate-nos</a></li>
            <li><a href="#">Termos e condições</a></li>
            <li><a href="#">Política de privacidade</a></li>
        </ul>
        </div>
        <div class="col-md-4 text-center text-light">
            <ul class="list-null">
                <li><a target="_blank" href="//facebook.com/#"><i class="fa fa-facebook"></i></a></li>
                <li><a target="_blank" href="//www.instagram.com/#"><i class="fa fa-instagram"></i></a></li>
                <li><a target="_blank" href="//www.linkedin.com/#"><i class="fa fa-linkedin"></i></a></li>
                <li><a target="_blank" href="//twitter.com/#"><i class="fa fa-twitter"></i></a></li>
            </ul>
        </div>
    </div>
</div>
</body>
</html>';
}
?>
