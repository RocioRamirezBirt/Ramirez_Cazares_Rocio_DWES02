<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>FORMULARIO BIBLIOTECA</title>
</head>
<body>
<br>
<div id="container">
  
        <h3 class="request_h3">Detalles del Prestamo</h3>   
        <fieldset class="request">
            <label for="name">Nombre del Usuario: </label>
            <input class="d_inbox" type="text" value="<?php echo strtoupper($_SESSION['name'])." ". strtoupper($_SESSION['lastname']) ?>" readonly="readonly">
            <label for="name">DNI: </label>
            <input class="d_inbox" type="text" value="<?php echo strtoupper($_SESSION['dni']); ?>"readonly="readonly">
            <label class="underline" for="name">Fecha de devolucion:</label>
            <input class="d_inbox" type="text" value="<?php echo date("d-m-Y",strtotime($_SESSION['fecha']."+ 10 days"));?>"readonly="readonly"><br>
        </fieldset>
        
        <h4 class="footer">Gracias por visitarnos! </h4>
        <br>
    </div>

</body>
</html>