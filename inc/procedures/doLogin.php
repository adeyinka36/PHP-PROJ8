<?php

require_once '../bootstrap.php';
 
$host=getenv("APP_URL");


$username= request()->get('username');
$password= request()->get('password');


$user=findUserByUsername($username);

if(empty($user)){
    $session->getFlashBag()->add("error","That user does not exist");
    redirect($host.'/');

}

if(password_verify($password,$user["password"])){
   
   
    $session->set("auth-loggedin",true);
    $session->set("auth-username",$user["username"]);
    $session->set("auth-userid",(int) $user["user_id"]);
    
    redirect($host.'/');
 

    $session->getFlashBag()->add("Success","You are now logged in");
    

}
else{
    $session->getFlashBag()->add("error","Incorrect credentials");
    redirect($host.'/login.php');
    return false;
}

