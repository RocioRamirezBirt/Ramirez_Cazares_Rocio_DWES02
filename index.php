<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>FORMULARIO BIBLIOTECA</title>
</head>
<body>
    <?php
            // define variables and set to empty values
            $name = $lastname = $book = $email = $date = $dni = "";
            $nameErr = $lastnameErr = $emailErr = $dateErr = $dniErr = "";
            $fechaActual = new DateTime();
            $fechaActualFormat = $fechaActual->format('Y-m-d');

            if(isset($_POST["submit"]) && $_SERVER["REQUEST_METHOD"] == "POST"){   
                $valid = true;
                
                if(empty($_POST["email"])){
                    $emailErr = "vacio";
                    $valid = false;
                }else {
                    $email =test_input($_POST['email']);

                    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                        $emailErr = "Formato de correo Invalido";
                        $valid = false;
                    }
                    
                }
                if(empty($_POST['date'])){
                    $dateErr = "No puede estar vacia la fecha";
                    $valid = false;
                }else{
                    $date = $_POST['date'];
                    $d = new DateTime($date);
                    $fechaUser = $d -> format('Y-m-d');

                    if($fechaUser > $fechaActualFormat){
                        
                    }elseif($fechaUser === $fechaActualFormat){
                        
                    }else {
                        $dateErr ="La Fecha tiene que ser mayor o igual a la fecha actual";
                        $valid = false;
                    }
                }
                
                if(empty($_POST["dni"])){
                    $dniErr = "No puede estar vacio el DNI";
                    $valid = false;

                }else {
                    $dni = $_POST['dni'];
                    $letter = substr($dni, -1);
                    $letter = strtoupper($letter); //convierte a mayuscula
                    $numbers = substr($dni, 0, -1);
                    
                    if(substr("TRWAGMYFPDXBNJZSQVHLCKE", $numbers%23,1) == $letter && strlen($letter) == 1){
                            
                    }else {
                        $let = valid_dni($dni); //LLAMADA A LA FUNCION VALID_DNI PARA SABER LA LETRA CORRECTA
                        $dniErr = "DNI INCORRECTO, LA LETRA CORRECTA ES LA: ".$let;
                        $valid = false;
                    }
                }       
                if ($valid){
                    /* Redirecciona a una página diferente en el mismo directorio el cual se hizo la petición */
                        $_SESSION['name'] = $_POST['name'];
                        $_SESSION['lastname'] = $_POST['lastname'];
                        $_SESSION['fecha'] = ($fechaUser);
                        $_SESSION['dni'] = $_POST['dni'];
                        include ('request.php');
                        exit();
                }
            } 

            function test_input($data) {
                $data = trim($data);
                $data = stripslashes($data);
                $data = htmlspecialchars($data);
                return $data;
            }

            function valid_dni($dni){
                $letter = substr($dni, -1);
                $letter = strtoupper($letter); //convierte a mayuscula
                $numbers = substr($dni, 0, -1);
            
                $letraCorrecta = (substr("TRWAGMYFPDXBNJZSQVHLCKE", $numbers%23,1));

                return $letraCorrecta;
            }
    ?>

    <div id="container">
        <form id ="contact" action=" <?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
            <h3>Formulario Biblioteca</h3>   
            <h4>Introduzca sus datos y presione enviar</h4>
            <fieldset>
                <label for="name">Nombre:</label><br>
                <input type="text" name="name" required="required" placeholder="name:">
            </fieldset>

            <fieldset>
                <label for="lastname">Apellido:</label><br>
                <input type="text" name="lastname" required="required" placeholder="lastname: ">
            </fieldset>

            <fieldset>
                <label for="book">Libro:</label><br>
                <input type="text" name="book" required="required" placeholder="book: ">
            </fieldset>

            <fieldset>
                <label for="email">Email:</label><br>
                <input type="email" name="email"  placeholder="Email: "><span class="error"><?php echo $emailErr ?></span>
            </fieldset>

            <fieldset>
                <label for="date">Fecha Alquiler:</label><br>
                <input type="date" name="date" ><span class="error"><?php echo $dateErr ?></span>
            </fieldset>

            <fieldset>
                <label for="dni">DNI:</label><br>
                <input type="text" name="dni" placeholder="DNI: " pattern="[0-9]{8}[A-Za-z]{1}" minlength="9" maxlength="9"><span class="error"><?php echo $dniErr ?></span>
            </fieldset>
            <button type="submit" name="submit" value="Enviar">Enviar</button>
        </form>
    </div>

    
</body>
</html>

