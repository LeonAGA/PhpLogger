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
        } else if(!filter_var($this->email, FILTER_VALIDATE_EMAIL)){
            header("Location: signin.php?error=invalidemail&user=".$this->user."&name=".$this->name."&lastName=".$this->lastName.
            "&lastName2=".$this->lastName2); 
        } else if(!preg_match("/^[a-zA-Z0-9]*$/", $this->user)){
            header("Location: signin.php?error=invaliduser&name=".$this->name."&lastName=".$this->lastName.
            "&lastName2=".$this->lastName2."&email=".$this->email); 
        } else if(!preg_match("/^[a-zA-Z]*$/", $this->name)){
            header("Location: signin.php?error=invalidname&user=".$this->user."&lastName=".$this->lastName.
            "&lastName2=".$this->lastName2."&email=".$this->email); 
        } else if(!preg_match("/^[a-zA-Z]*$/", $this->lastName)){
            header("Location: signin.php?error=invalidlastName&user=".$this->user."&name=".$this->name.
            "&lastName2=".$this->lastName2."&email=".$this->email); 
        } else if(!preg_match("/^[a-zA-Z]*$/", $this->lastName2)){
            header("Location: signin.php?error=invalidlastName2&user=".$this->user."&name=".$this->name."&lastName=".$this->lastName.
            "&email=".$this->email);
        } else if($this->password !== $this->passwordConfirmation){
            header("Location: signin.php?error=invalidpassword&user=".$this->user."&name=".$this->name."&lastName=".$this->lastName.
            "&lastName2=".$this->lastName2."&email=".$this->email); 
        } 
        
        
        
    //    else{

    //      //checar en la hoja .txt si existe el usuario
    //         //if(existe){
    //         //     header("location index.php?error=userTaken");
    //         // } else{
    //             //lo insertamos en la hoja
    //             //header("location index.php?signup=success");
    //         // }


    //    }
    

}
}
$action = isset($_POST['signIn']) ? $_POST['signIn'] : null;

switch ($action) {
    case 'Registrar':

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
     header("Location: index.php?");
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