<?php
if (!isset($_GET['ticket']))
	die("Error: Bilhete invalido");

require_once 'inc/database.php';
$conn = initDB();
$res = $conn->query("select *,t.id as tid, b.id as bid, u.id as uid from tickets t, buses b, users u where t.bus_id = b.id and t.id =".$_GET['ticket']);
$ticket = $res->fetch_assoc();
$conn->close();

?>

<table border="5">
	<tr>
		<th>Pre&ccedil;o</th>
		<th>Acento</th>
		<th>Numero do carro</th>
		<th>Nome do carro</th>
		<th>Destino</th>
		<th>Apartir de</th>
		<th>Data de partida</th>
		<th>Hora de partida</th>
		
	</tr>

	<tr>
		<td><?=$ticket['fare']?></td>
		<td><?=$ticket['bus_no']?></td>
		<td><?=$ticket['bname']?></td>
		<td><?=$ticket['to_loc']?></td>
		<td><?=$ticket['from_loc']?></td>
		<td><?=$ticket['jdate']?></td>
		<td><?=$ticket['from_time']?></td>
		<td><?=$ticket['to_time']?></td>
	</tr>

</table>


<script>

	window.onload = () => {
		let open = window.print();

		onafterprint = () => {
			window.location.href = "buy_ticket.php"
		}
		
	}
</script>