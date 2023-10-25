<?php
function initDB()
{
    $connStr = mysqli_connect("localhost","root","","bus_ticket");
    if ($connStr->connect_error)
        die("<script>alert('Conexao falhou: " . $connStr->connect_error . "');</script>");
    return $connStr;
}
?>