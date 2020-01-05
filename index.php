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
            
            if(empty($this->user) || empty($this->password)){

                header("Location: index.php?error=emptyfields&user=".$this->user."&password=".$this->password);
                
            } else if(!preg_match("/^[a-zA-Z0-9]*$/", $this->user)){
                header("Location: index.php?error=invaliduser");
            }

        }

    }

    $action = isset($_POST['logIn']) ? $_POST['logIn'] : null;

    switch ($action) {
        case 'Iniciar sesión':
            $logIn = new LogIn(); 
            $logIn->set_user(clean_input($_POST["user"]));
            $logIn->set_password(clean_input($_POST["password"]));
            $logIn->validation_input();
        break;
        case 'Regístrate':
        header("Location: signin.php?");
        die();
        break;    
        default:
        break;
        }

    function clean_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
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
                <input class ="btnChange comment greenText" type="submit" name = "logIn" value="Regístrate">
                </p> 
            </form>
        </div>
    </div>

</body>
</html>
