<?php
include('db.php')
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
                        <a href="login.php"><i class="fa fa-home"></i> Salir
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
                                <div class="form-group">
                                    <label>Tipo de habitación*</label>
                                    <select name="troom" class="form-control" required>
                                        <option value selected></option>
                                        <option value="Superior Room"> HABITACIÓN SUPERIOR</option>
                                        <option value="Deluxe Room">HABITACIÓN DE LUJO</option>
                                        <option value="Guest House">CASA DE HUESPEDES</option>
                                        <option value="Single Room">HABITACIÓN INDIVIDUAL
                                        </option>
                                    </select>
                                    <div class="form-group">
                                        <label>Entrada</label>
                                        <input name="cin" type="date" class="form-control">

                                    </div>
                                    <div class="form-group">
                                        <label>Salida</label>
                                        <input name="cout" type="date" class="form-control">

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
                                <input type="submit" name="submit" class="btn btn-primary">
                                <?php
                                if (isset($_POST['submit'])) {
                                    $code1 = $_POST['code1'];
                                    $code = $_POST['code'];
                                    if ($code1 != "$code") {
                                        $msg = "Invalide code";
                                    } else {

                                        $con = mysqli_connect("localhost", "root", "", "hotel");
                                        $check = "SELECT * FROM roombook WHERE email = '$_POST[email]'";
                                        $rs = mysqli_query($con, $check);
                                        $data = mysqli_fetch_array($rs, MYSQLI_NUM);
                                        if ($data[0] > 1) {
                                            echo "<script type='text/javascript'> alert('El usuario ya existe')</script>";
                                        } else {
                                            $new = "Not Conform";
                                            $newUser = "INSERT INTO `roombook`(`Title`, `FName`, `LName`, `Email`, `National`, `Country`, `Phone`, `TRoom`, `Bed`, `NRoom`, `Meal`, `cin`, `cout`,`stat`,`nodays`) VALUES ('$_POST[title]','$_POST[fname]','$_POST[lname]','$_POST[email]','$_POST[nation]','$_POST[country]','$_POST[phone]','$_POST[troom]','$_POST[bed]','$_POST[nroom]','$_POST[meal]','$_POST[cin]','$_POST[cout]','$new',datediff('$_POST[cout]','$_POST[cin]'))";
                                            if (mysqli_query($con, $newUser)) {
                                                echo "<script type='text/javascript'> alert('Su solicitud de reserva ha sido enviadat')</script>";
                                            } else {
                                                echo "<script type='text/javascript'> alert('Error al agregar usuario en la base de datos')</script>";
                                            }
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
    <!-- /. WRAPPER  -->
    <!-- JS Scripts-->
    <!-- jQuery Js -->
    <script src="assets/js/jquery-1.10.2.js"></script>
    <!-- Bootstrap Js -->
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- Metis Menu Js -->
    <script src="assets/js/jquery.metisMenu.js"></script>
    <!-- Custom Js -->
    <script src="assets/js/custom-scripts.js"></script>


</body>

</html>