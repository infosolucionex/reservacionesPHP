<?php
include('db.php');

session_start();
if (!isset($_SESSION["user"])) {
  header("location:login.html");
}
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>RESERVACION HOTEL Amanecer</title>
  <!-- Bootstrap Styles-->
  <link href="assets/css/bootstrap.css" rel="stylesheet" />
  <!-- FontAwesome Styles-->
  <link href="assets/css/font-awesome.css" rel="stylesheet" />
  <!-- Custom Styles-->
  <link href="assets/css/custom-styles.css" rel="stylesheet" />
  <!-- Google Fonts-->
  <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
</head>

<body>
  <div id="wrapper">
    <nav class="navbar-default navbar-side" role="navigation">
      <div class="sidebar-collapse">
        <ul class="nav" id="main-menu">

          <li>
            <a href="reservation.php"><i class="fa fa-home"></i> Reservar
            </a>
          </li>

          <li>
            <a href="#"><i class="fa fa-home"></i> Historial de Reservaciones
            </a>
          </li>

          <li>
            <a href="cerrarSesion.php"><i class="fa fa-home"></i> Salir
            </a>
          </li>

        </ul>

      </div>

    </nav>


    <div id="page-wrapper">
      <div id="page-inner">
        <div class="row">
          <div class="col-md-12">
            <h1 class="page-header">
              HISTORIAL <small></small>
            </h1>
          </div>
        </div>


        <table class='table'>
          <thead class='thead-dark'>
            <tr>
              <th scope='col'>ID HABITACIÓN</th>
              <th scope='col'>FECHA DE INGRESO</th>
              <th scope='col'>FECHA DE SALIDA</th>
            </tr>
          </thead>


          <?php

          $id_rol = $_SESSION["id_rol"];
          $id_persona = $_SESSION["id_persona"];

          $msql = "SELECT * FROM `reservacion` where cli_id_rol=$id_rol and cli_id_persona=$id_persona";
          $mre = mysqli_query($con, $msql);
          $count = mysqli_num_rows($mre);

          while ($mrow = mysqli_fetch_array($mre)) {  ?> <!-- se bare llave del while -->
            
            <tbody>
              <tr>
                <td><?php echo$mrow['ID_HABITACION'] ?></td>
                <td><?php echo$mrow['FECHAINICIO'] ?></td>
                <td><?php echo$mrow['FECHAFIN'] ?></td>
              </tr>

            <?php
          }      
            ?> <!-- se cierra llave del while -->
        </table>




</body>

</html>