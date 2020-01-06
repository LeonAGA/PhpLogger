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

class SignIn {
    
    //Properties
    private $user;
    private $name;
    private $lastName;
    private $lastName2;
    private $email;
    private $password;
    private $passwordConfirmation;

     //Methods
    function set_user($user) {
        $this->user = $user;
    }
    function get_user() {
        return $this->user;
    }
    function set_name($name) {
        $this->name = $name;
    }
    function get_name() {
        return $this->name;
    }
    function set_lastName($lastName) {
        $this->lastName = $lastName;
    }
    function get_lastName() {
        return $this->lastName;
    }
    function set_lastName2($lastName2) {
        $this->lastName2 = $lastName2;
    }
    function get_lastName2() {
        return $this->lastName2;
    }
    function set_email($email) {
        $this->email = $email;
    }
    function get_email() {
        return $this->email;
    }
    function set_password($password) {
        $this->password= $password;
    }
    function get_password() {
        return $this->password;
    }
    function set_passwordConfirmation($passwordConfirmation) {
        $this->passwordConfirmation = $passwordConfirmation;
    }
    function get_passwordConfirmation() {
        return $this->passwordConfirmation;
    }

    function validation_input(){

        if(empty($this->user) || empty($this->name) || empty($this->lastName) || empty($this->lastName2) ||
           empty($this->email) || empty($this->password) || empty($this->passwordConfirmation)) {
            header("Location: signin.php?error=emptyfields&user=".$this->user."&name=".$this->name."&lastName=".$this->lastName.
            "&lastName2=".$this->lastName2."&email=".$this->email); 
            exit();
        } else if(!filter_var($this->email, FILTER_VALIDATE_EMAIL)){
            header("Location: signin.php?error=invalidemail&user=".$this->user."&name=".$this->name."&lastName=".$this->lastName.
            "&lastName2=".$this->lastName2); 
            exit();
        } else if(!preg_match("/^[a-zA-Z0-9]*$/", $this->user) || str_word_count($this->user) > 1){
            header("Location: signin.php?error=invaliduser&name=".$this->name."&lastName=".$this->lastName.
            "&lastName2=".$this->lastName2."&email=".$this->email); 
            exit();
        } else if(!preg_match("/^[a-zA-Z]*$/", $this->name) || str_word_count($this->name) > 1){
            header("Location: signin.php?error=invalidname&user=".$this->user."&lastName=".$this->lastName.
            "&lastName2=".$this->lastName2."&email=".$this->email);
            exit(); 
        } else if(!preg_match("/^[a-zA-Z]*$/", $this->lastName) || str_word_count($this->lastName) > 1){
            header("Location: signin.php?error=invalidlastName&user=".$this->user."&name=".$this->name.
            "&lastName2=".$this->lastName2."&email=".$this->email); 
            exit();
        } else if(!preg_match("/^[a-zA-Z]*$/", $this->lastName2) || str_word_count($this->lastName2) > 1){
            header("Location: signin.php?error=invalidlastName2&user=".$this->user."&name=".$this->name."&lastName=".$this->lastName.
            "&email=".$this->email);
            exit();
        } else if(!preg_match("/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/", $this->password) || str_word_count($this->lastName2) > 1){
            header("Location: signin.php?error=invalidpassword&user=".$this->user."&name=".$this->name."&lastName=".$this->lastName.
            "&lastName2=".$this->lastName2."&email=".$this->email); 
            exit();
        } else if($this->password !== $this->passwordConfirmation){
            header("Location: signin.php?error=notequalpassword&user=".$this->user."&name=".$this->name."&lastName=".$this->lastName.
            "&lastName2=".$this->lastName2."&email=".$this->email); 
            exit();
        } else{

           switch(search_user($this->user, $this->email)){
            case 'user':
            header("Location: signin.php?error=useralreadytaken&name=".$this->name."&lastName=".$this->lastName.
            "&lastName2=".$this->lastName2."&email=".$this->email); 
            exit();
            break;
            case 'email':
            header("Location: signin.php?error=emailalreadytaken&name=".$this->name."&lastName=".$this->lastName.
            "&lastName2=".$this->lastName2); 
            exit();
            break;
            default:         
            user_registration(); 
            header("Location: index.php?signIn=success"); 
            exit();
            break;
           }

        }
    }    
}

// Global properties
$action = isset($_POST['signIn']) ? $_POST['signIn'] : null;
$signIn = '';

// The Begining of the script
switch ($action) {
    case 'Registrar':

        global $signIn; 
        $signIn = new SignIn();  
        $signIn->set_user(clean_input($_POST["user"]));
        $signIn->set_name(clean_input($_POST["name"]));
        $signIn->set_lastName(clean_input($_POST["lastName"]));
        $signIn->set_lastName2(clean_input($_POST["lastName2"]));
        $signIn->set_email(clean_input($_POST["email"]));
        $signIn->set_password($_POST["password"]);
        $signIn->set_passwordConfirmation($_POST["passwordConfirmation"]); 
        $signIn->validation_input();
        
    break;
    case 'Iniciar':

        header("Location: index.php");
        exit();
    break;    
    default:
    break;
    }

    //Function to clean the data
    function clean_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    // Function to search register users
    function search_user($user, $email){
        
        $file = fopen("users.txt", "a+");
        $read = file('users.txt');
     
        for($i = 0; $i <= sizeof($read)-1; $i= $i+6){ 

            if(strtolower(trim($read[$i])) == strtolower($user)){
                fclose($file);  
                return 'user';
            }elseif(strtolower(trim($read[$i+4])) == strtolower($email)){
                fclose($file);   
                return 'email';
            }
            
        }
            fclose($file); 
            return 'valid';
    }

    //Function to register a new user
    function user_registration(){
        
        $file = fopen("users.txt", "a+");
        $read = file('users.txt');
        if(count($read) > 0){
            $userData =  "\n".$signIn->get_user()."\n";
        }else{
            $userData = $signIn->get_user()."\n";
        } 
        $userData =  $userData.$signIn->get_name()."\n";
        $userData =  $userData.$signIn->get_lastName()."\n";
        $userData =  $userData.$signIn->get_lastName2()."\n";
        $userData =  $userData.$signIn->get_email()."\n";
        $userData =  $userData.sha1($signIn-> get_password());
        fwrite($file, $userData);
        fclose($file);
    }

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
                    echo '<p class="notification error">Todos los campos deben ser llenados</p>';
                } elseif($_GET['error'] == "invalidemail"){
                    echo '<p class="notification error">Por favor poner un email válido</p>';
                } elseif($_GET['error'] == "invaliduser"){
                    echo '<p class="notification error">El usuario solo puede contener <br>letras y numeros sin espacios</p>';
                } elseif($_GET['error'] == "invalidname"){
                    echo '<p class="notification error">El nombre no puede contener numeros ni espacios</p>';
                } elseif($_GET['error'] == "invalidlastName"){
                    echo '<p class="notification error">El Apellido Paterno no puede contener <br>numeros ni espacios</p>';
                } elseif($_GET['error'] == "invalidlastName2"){
                    echo '<p class="notification error">El Apellido Materno no puede contener <br>numeros ni espacios</p>';
                } elseif($_GET['error'] == "invalidpassword"){
                    echo '<p class="notification error">La contraseña debe contener al menos 8 caracteres, <br>1 minúscula, 1 mayúscula y 1 número <br> y sin espacios</p>';
                } elseif($_GET['error'] == "notequalpassword"){
                    echo '<p class="notification error">Las contraseñas no coinciden</p>';
                } elseif($_GET['error'] == "useralreadytaken"){
                    echo '<p class="notification error">Ya existe ese numbre de usuario</p>';
                } elseif($_GET['error'] == "emailalreadytaken"){
                    echo '<p class="notification error">Ya existe ese numbre de usuario y email</p>';
                }    
            }
            
            ?>

        </div>
    </div>
</body>
</html>