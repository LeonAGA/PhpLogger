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

// Gloabal properties
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

        header("Location: index.php?");
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

            if(trim($read[$i]) == $user){
                fclose($file);  
                return 'user';
            }elseif(trim($read[$i+4]) == $email){
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