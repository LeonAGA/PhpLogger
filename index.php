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
            exit();
            
        } else if(empty($this->password)){
            header("Location: index.php?error=emptypassword&user=".$this->user);
            exit();
        } else{

                $var = search_user($this->user, $this->password);
                $fullName = '';
                foreach ($var as $value){
                    $fullName =  $fullName."/n".$value;
                }
               // header("Location: index.php?logIn=success&fullName=".$fullName); 
               // exit();
        }


    }

}

// Global properties
$action = isset($_POST['logIn']) ? $_POST['logIn'] : null;
$logIn = '';

// The Begining of the script
switch ($action) {
    case 'Iniciar sesión':

        global $logIn;
        $logIn = new LogIn(); 
        $logIn->set_user($_POST["user"]);
        $logIn->set_password($_POST["password"]);
        $logIn->validation_input();

    break;
    case 'Regístrate':

    header("Location: signin.php");
    exit();
    break;    
    default:
    break;
}

// Function to search register users
function search_user($user, $password){

    $var = array();
    $file = fopen("users.txt", "a+");
    $read = file('users.txt');
    $i = 0;
    while($i <= sizeof($read)-1){

        header("Location: index.php?".trim($read[$i+5]));
        exit();
        if(strtolower(trim($read[$i])) == strtolower($user) ||
           strtolower(trim($read[$i+4])) == strtolower($user) &&
           trim($read[$i+5]) == sha1($password)){
            array_push($var, trim($read[$i+1]));
            array_push($var, trim($read[$i+2]));
            fclose($file); 
            return $var;
        }elseif (strtolower(trim($read[$i])) == strtolower($user) ||
              strtolower(trim($read[$i+4])) == strtolower($user)){
            fclose($file); 
            header("Location: indfex.php?error=wrongpassword&user=".$user);
            exit();  
        }
        
        $i= $i+6;
    }

    fclose($file); 
    header("Location: Location: indejx.php?error=usernofound"); 
    exit();

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
                    echo '<p class="notification error">Por favor usa tu usuario o email</p>';
                } elseif($_GET['error'] == "emptypassword"){
                    echo '<p class="notification error">Por favor escribe tu contraseña</p>';
                } elseif($_GET['error'] == "wrongpassword"){
                    echo '<p class="notification error">La contraseña es incorrecta</p>';
                } elseif($_GET['error'] == "usernofound"){
                    echo '<p class="notification error">No existe un usuario con esas credenciales</p>';
                }

            }

            if(isset($_GET['signIn'])){
                if($_GET['signIn'] == "success"){
                    echo '<p class="notification successful">Usuario registrado <br> ¡Inicia sesión!</p>';
                } 
            }

            if(isset($_GET['logIn'])){
                if($_GET['logIn'] == "success"){
                    echo '<p class="notification successful">Felicitaciones <br> ¡Has iniciado sesión!</p>';
                } 
            }


            ?>
        </div>
    </div>

</body>
</html>
