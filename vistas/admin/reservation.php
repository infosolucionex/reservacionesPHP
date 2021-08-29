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
    <title>RESERVACION HOTEL MORENO</title>
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
                        <a href="#"><i class="fa fa-home"></i> Reservar
                        </a>
                    </li>

                    <li>
                        <a href="Historial.php"><i class="fa fa-home"></i> Historial de Reservaciones
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
                            RESERVACION <small></small>
                        </h1>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 col-sm-6">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                INFORMACIÓN DE RESERVA

                            </div>
                            <div class="panel-body">
                                <form name="form" method="post">
                                    <div class="form-group">
                                        <label>Tipo de habitación</label>

                                        <select name="cuartos" class="form-control" required>
                                            <option value selected>Seleccionar</option>
                                            <?php
                                            $msql = "SELECT * FROM `habitacion`";
                                            $mre = mysqli_query($con, $msql);
                                            while ($mrow = mysqli_fetch_array($mre)) {
                                            ?>
                                                <option value="<?php echo $mrow['ID_HABITACION'] ?>"><?php echo $mrow['TIPOHABI'] ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>


                                        <div class="form-group">
                                            <label>Entrada</label>
                                            <input name="fechainicial" type="date" class="form-control">

                                        </div>
                                        <div class="form-group">
                                            <label>Salida</label>
                                            <input name="fechafinal" type="date" class="form-control">

                                        </div>
                                    </div>

                            </div>
                        </div>


                        <div class="col-md-12 col-sm-12">
                            <div class="well">
                                <h4>VERIFICACIÓN HUMANA</h4>
                                <p>Escriba debajo de este código
                                    <?php $Random_code = rand();
                                    echo $Random_code; ?> </p><br />
                                <p>Ingrese el código aleatorio
                                    <br />
                                </p>
                                <input type="text" name="code1" title="random code" />
                                <input type="hidden" name="code" value="<?php echo $Random_code; ?>" />
                                <input type="submit" name="submit" class="btn btn-primary" />


                                <?php
                                if (isset($_POST['submit'])) {
                                    
                                    $code1 = $_POST['code1'];
                                    $code = $_POST['code'];
                                    if ($code1 != "$code") {
                                        $msg = "Invalide code";
                                    } else {
                                        $id_rol = $_SESSION["id_rol"];
                                        $id_persona = $_SESSION["id_persona"];
                                   
                                            $newReservation = "INSERT INTO `reservacion` (`id_habitacion`,`cli_id_rol`,`cli_id_persona`,`fechainicio`,`fechafin`,`estado`) VALUES ($_POST[cuartos],$id_rol,$id_persona,'$_POST[fechainicial]','$_POST[fechafinal]',true)";
                                            if (mysqli_query($con, $newReservation)) {
                                                echo "<script type='text/javascript'> alert('Su solicitud de reserva ha sido enviada correctamente')</script>";
                                            } else {
                                                echo "<script type='text/javascript'> alert('Error al realizar reservación')</script>";
                                            }
                                        

                                        $msg = "Tu código es correcto
";
                                    }
                                }
                                ?>
                                </form>

                            </div>
                        </div>
                    </div>

                </div>

            </div>
            <!-- /. PAGE INNER  -->
        </div>
        <!-- /. PAGE WRAPPER  -->
    </div>




</body>

</html>