<?php

if(isset($_SESSION['userId'])){
    echo '<p class="login-status"> You are logged out!</p>';
}else{
    echo '<p class="login-status"> You are logged In!</p>';
}



?>