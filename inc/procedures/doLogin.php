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
   
   
    
    $data=[
        "auth-username"=>$user["username"],
        "auth-userid"=>$user["user_id"]
    ];


    
    $time= time()+36000;
    $cookie= createCookie(json_encode($data),$time);

   



    $session->getFlashBag()->add("success","You are now logged in");
    
    redirect($host.'/',["cookies"=>[$cookie]]);
}
else{
    $session->getFlashBag()->add("error","Incorrect credentials");
    redirect($host.'/login.php');
    return false;
}

