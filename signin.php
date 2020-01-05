<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>signIn</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

<?php 
include 'includes/logger.php'
?>

    <div class="titleBar">
        <h1>Logger</h1>
    </div>

    <div class="containerSignIn shadow" >
        <div class="bgGreen signIn" id = "signIn">
        
            <h2 class="whiteText">Crearemos tu cuenta</h2>
            <p class="whiteText comment">Por favor llena el formulario</p>

            <form class="inputsSign" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                <div class="input">
                    <label class = "whiteText" for="user">Usuario</label>
                    <input 
                    type="text" 
                    name="user"
                    placeholder="Nombre de usuario"   
                    value = "<?php echo(isset($_GET['user']))?$_GET['user']:'';?>"  
                    >
                </div><br>
                <div class="input">
                    <label class = "whiteText" for="name">Nombre(s)</label>
                    <input 
                    type="text" 
                    name="name"
                    placeholder="Nombre(s)" 
                    value = "<?php echo(isset($_GET['name']))?$_GET['name']:'';?>"  
                    >
                </div><br>
                <div class="input">
                    <label class = "whiteText" for="user">Apellido Paterno</label>
                    <input 
                    type="text" 
                    name="lastName"
                    placeholder="Apellido Paterno" 
                    value = "<?php echo(isset($_GET['lastName']))?$_GET['lastName']:'';?>"  
                    >
                </div><br>
                <div class="input">
                    <label class = "whiteText" for="user">Apellido Materno</label>
                    <input 
                    type="text" 
                    name="lastName2"
                    placeholder="Apellido Materno" 
                    value = "<?php echo(isset($_GET['lastName2']))?$_GET['lastName2']:'';?>"  
                    >
                </div><br>
                <div class="input">
                    <label class = "whiteText" for="user">Correo electrónico</label>
                    <input 
                    type="email" 
                    name="email"
                    placeholder="correo electrónico" 
                    value = "<?php echo(isset($_GET['email']))?$_GET['email']:'';?>"  
                    >
                </div><br>
                <div class="input">
                    <label class = "whiteText" for="password">Contraseña</label>
                    <input 
                    type="password"  
                    name="password"
                    placeholder="Contraseña"
                    >
                </div><br>
                <div class="input">
                    <label class = "whiteText" for="passwordConfirmation">Confirmar contraseña</label>
                    <input 
                    type="password"  
                    name="passwordConfirmation"
                    placeholder="Confirmar contraseña"
                    >
                    <p class = "whiteText" id="show">Mostrar<p/>
                </div><br>
                <div class="input btnContainerSignIn">
                    <input class ="btn btnSignIn" type="submit" name = "signIn" value="Registrar">
                </div>
                <p class="comment whiteText">¿Tienes un cuenta?
                <input class ="btnChangeToLogin comment redText" type="submit" name = "signIn" value="Iniciar">
                </p> 
            </form>

            <?php 
            if(isset($_GET['error'])){
                if($_GET['error'] == "emptyfields"){
                    echo '<p class="notification error"> Todos los campos deben ser llenados </p>';
                } elseif($_GET['error'] == "invalidemail"){
                    echo '<p class="notification error"> Por favor poner un email válido </p>';
                } elseif($_GET['error'] == "invaliduser"){
                    echo '<p class="notification error"> El usuario solo puede contener <br> letras y numeros sin espacios </p>';
                } elseif($_GET['error'] == "invalidname"){
                    echo '<p class="notification error"> El nombre no puede contener numeros ni espacios </p>';
                } elseif($_GET['error'] == "invalidlastName"){
                    echo '<p class="notification error"> El Apellido Paterno no puede contener <br> numeros ni espacios </p>';
                } elseif($_GET['error'] == "invalidlastName2"){
                    echo '<p class="notification error"> El Apellido Materno no puede contener <br> numeros ni espacios </p>';
                } elseif($_GET['error'] == "invalidpassword"){
                    echo '<p class="notification error"> Las contraseñas no coinciden </p>';
                }
              
            }
            ?>

        </div>
    </div>
</body>
</html>