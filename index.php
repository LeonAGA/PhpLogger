<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>LogIn</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

    <?php 

    // global Properties
    class LogIn {

        //Properties
        private $user;
        private $password;

        //Methods
        function set_user($user) {
            $this->user = $user;
        }
        function get_user() {
            return $this->user;
        }
        function set_password($password) {
            $this->password = $password;
        }
        function get_password() {
            return $this->password;
        }

        function validation_input(){
            
            if(empty($this->user)){

                header("Location: index.php?error=emptyuser");
                
            } else if(empty($this->password)){
                header("Location: index.php?error=emptypassword&user=".$this->user);
            }


        }

    }

    $action = isset($_POST['logIn']) ? $_POST['logIn'] : null;

    switch ($action) {
        case 'Iniciar sesión':
            $logIn = new LogIn(); 
            $logIn->set_user($_POST["user"]);
            $logIn->set_password($_POST["password"]);
            $logIn->validation_input();
        break;
        case 'Regístrate':
        header("Location: signin.php?");
        break;    
        default:
        break;
        }

    ?>

    <div class="titleBar">
        <h1>Logger</h1>
    </div>

    <div class="containerLogIn shadow" >
        <div class="bgWhite logIn" id ="logIn">
            <h2 class="greenText">Inicia sesión</h2>
            <p class="greenText comment">Por favor pon tus credenciales</p>
        
            <form class="inputsLog" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                <div class="input">
                    <label class = "greenText" for="user">Usuario</label>
                    <input 
                    type="text" 
                    name="user"
                    placeholder="Usuario o correo electrónico"
                    value = "<?php echo(isset($_GET['user']))?$_GET['user']:'';?>"       
                    >
                </div><br>
                <div class="input">
                    <label class = "greenText" for="password">Contraseña</label>
                    <input 
                    type="password"  
                    name="password"
                    placeholder="Contraseña"
                    >
                    <p class = "greenText" id="show">Mostrar<p/>
                </div><br>
                <div class="input btnContainerLogIn">
                    <input class ="btn btnLogIn" type="submit" name = "logIn" value="Iniciar sesión">
                </div>
                <p class="comment greyText">¿No tienes una cuenta?
                <input class ="btnChangeToSignIn comment greenText" type="submit" name = "logIn" value="Regístrate">
                </p> 
            </form>
            <?php 
            if(isset($_GET['error'])){
                if($_GET['error'] == "emptyuser"){
                    echo '<p class="notification error"> Por favor usa tu usuario o email </p>';
                } elseif($_GET['error'] == "emptypassword"){
                    echo '<p class="notification error"> Por favor escribe tu contraseña </p>';
                }

            }
            ?>
        </div>
    </div>

</body>
</html>
