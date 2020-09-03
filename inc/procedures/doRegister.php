<?php

require_once '../bootstrap.php';
 
$host=getenv("APP_URL");


$username= request()->get('username');
$password= request()->get('password');
$confirmPassord=request()->get('confirm_password');

if($password!=$confirmPassord){
    $session->getFlashBag()->add("error","Passwords do not match");
    redirect($host.'/register.php');

}



$user= findUserByUsername($username);

if(!empty($user)){
    $session->getFlashBag()->add("error","This user already exists");
    redirect($host.'/register.php');
    
}

$hash= password_hash($password,PASSWORD_DEFAULT);
$user=createUser($username,$hash);
$session->getFlashBag()->add("sucess","User is created");
redirect($host.'/');