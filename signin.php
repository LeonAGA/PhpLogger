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
                    >
                </div><br>
                <div class="input">
                    <label class = "whiteText" for="name">Nombre(s)</label>
                    <input 
                    type="text" 
                    name="name"
                    placeholder="Nombre(s)" 
                    >
                </div><br>
                <div class="input">
                    <label class = "whiteText" for="user">Apellido Paterno</label>
                    <input 
                    type="text" 
                    name="lastName"
                    placeholder="Apellido Paterno" 
                    >
                </div><br>
                <div class="input">
                    <label class = "whiteText" for="user">Apellido Materno</label>
                    <input 
                    type="text" 
                    name="lastName2"
                    placeholder="Apellido Materno" 
                    >
                </div><br>
                <div class="input">
                    <label class = "whiteText" for="user">Correo electrónico</label>
                    <input 
                    type="email" 
                    name="email"
                    placeholder="correo electrónico" 
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
                <p class="comment ">¿Tienes un cuenta?
                <input class ="btnChange comment whiteText" type="submit" name = "logIn" value="Entrar">
                </p> 
            </form>

        </div>
    </div>
</body>
</html>