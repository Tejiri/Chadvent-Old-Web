<?php include("databasehelper.php") ?>
<?php

if ($_SESSION['username'] == "") {
    header("Location: index.php");
} else {
}
?>

<?php 

$firstname = $_SESSION['firstname'];
$lastname = $_SESSION['lastname'];


?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.4.2/js/dataTables.buttons.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.4.2/js/buttons.print.js"></script>
    
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.4.2/css/buttons.dataTables.min.css">
    <style>
		table.blueTable {
  border: 1px solid #1C6EA4;
  background-color: #EEEEEE;
  width: 100%;
  text-align: left;
  border-collapse: collapse;
}
table.blueTable td, table.blueTable th {
  border: 1px solid #AAAAAA;
  padding: 3px 2px;
}
table.blueTable tbody td {
  font-size: 13px;
}
table.blueTable tr:nth-child(even) {
  background: #D0E4F5;
}
table.blueTable thead {
  background: #1C6EA4;
  background: -moz-linear-gradient(top, #5592bb 0%, #327cad 66%, #1C6EA4 100%);
  background: -webkit-linear-gradient(top, #5592bb 0%, #327cad 66%, #1C6EA4 100%);
  background: linear-gradient(to bottom, #5592bb 0%, #327cad 66%, #1C6EA4 100%);
  border-bottom: 2px solid #444444;
}
table.blueTable thead th {
  font-size: 15px;
  font-weight: bold;
  color: #FFFFFF;
  border-left: 2px solid #D0E4F5;
}
table.blueTable thead th:first-child {
  border-left: none;
}

table.blueTable tfoot {
  font-size: 14px;
  font-weight: bold;
  color: #FFFFFF;
  background: #D0E4F5;
  background: -moz-linear-gradient(top, #dcebf7 0%, #d4e6f6 66%, #D0E4F5 100%);
  background: -webkit-linear-gradient(top, #dcebf7 0%, #d4e6f6 66%, #D0E4F5 100%);
  background: linear-gradient(to bottom, #dcebf7 0%, #d4e6f6 66%, #D0E4F5 100%);
  border-top: 2px solid #444444;
}
table.blueTable tfoot td {
  font-size: 14px;
}
table.blueTable tfoot .links {
  text-align: right;
}
table.blueTable tfoot .links a{
  display: inline-block;
  background: #1C6EA4;
  color: #FFFFFF;
  padding: 2px 8px;
  border-radius: 5px;
}
	</style>
</head>


<body>
    <div>
        <table class="display blueTable">
            <thead>
                <th style="text-align: center;">S/N</th>
                <th>Date</th>
                <th>Narration</th>
                <th>Debit</th>
                <th>Credit</th>
                <th>Balance</th>
                
            </thead>

            <tbody>
                <?php
                $statement = getStatement($_SESSION['username']);
                foreach ($statement as $key => $value) {
                    $nextArray = $statement[$key]; ?>
                    <tr>
                        <td><?php echo $key + 1 ?></td>
                        <td><?php echo $nextArray[1] ?></td>
                        <td><?php echo $nextArray[2] ?></td>
                        <td><?php echo $nextArray[3] ?></td>
                        <td><?php echo $nextArray[4] ?></td>
                        <td><?php echo $nextArray[5] ?></td>


                    </tr>
                <?php       }

                ?>
            </tbody>
        </table>
    </div>

    <script>
        $(document).ready(function() {
            $('.display').dataTable({
                
                info:false,
                responsive: true,
			"lengthMenu": [ 10, 25, 50, 75, 100 ],
			dom: 'lfrtiBp',		
        buttons: [
          {
            extend:'print',
            messageTop: "<?php echo $firstname." ".$lastname?>",
            title: "My Account Statement"
          }
        ]
            });
        });
    </script>
<form action="profile.php" method="post">
								<input type="submit" value="Back to profile">
							</form>
<form action="logout.php" method="post">
								<input type="submit" value="Logout">
							</form>
</body>

</html>