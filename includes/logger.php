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

        if(empty($this->user) || empty($this->password)) {
            header("Location: index.php?error=emptyfields&user=".
            $this->user); 
            if(isset($_GET['error'])){
                if($_GET['error'] == "emptyfields"){
                    header("Location: index.php?error=em");
                }
               
            }

        } 
        
        
        
    //     else if(!filter_var($this->email, FILTER_VALIDATE_EMAIL)){
    //         header("Location: index.php?error=invalidemail&user=".$this->user);
    //     } else if(!preg_match("/^[a-zA-Z0-9]*$/", $this->user)){
    //         header("Location: index.php?error=invaliduser&email=".$this->email);
    //    }  else if($this->password !== $this->passwordConfirmation){

    //    } 
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

// switch ($action) {
//     case 'signIn':
//        // $logIn = null;
//         $signIn = new SignIn(); 
//         $signIn->set_user(clean_input($_POST["user"]));
//         $signIn->set_name(clean_input($_POST["name"]));
//         $signIn->set_lastName(clean_input($_POST["lastName"]));
//         $signIn->set_lastName2(clean_input($_POST["lastName2"]));
//         $signIn->set_email(clean_input($_POST["email"]));
//         $signIn->set_password(clean_input($_POST["password"]));
//         $signIn->set_passwordConfirmation(clean_input($_POST["passwordConfirmation"])); 
//         $signIn->validation_input();
        
     
//     break;
//     case 'logIn':
//         $signIn = null;
//         $logIn = new LogIn(); 
//         $logIn->set_user(clean_input($_POST["user"]));
//         $logIn->set_password(clean_input($_POST["password"]));
//         // $logIn->validation_input();

//     break;    
//     default:
//     break;
//     }

?>