<?php

$host=getenv("APP_URL");

function createUser($username,$password){
    global $db;
try{
$stmt= $db->query("CREATE TABLE IF NOT EXISTS user (
    user_id   INTEGER PRIMARY KEY,
    username TEXT    NOT NULL,
    password TEXT NOT NULL,

)");
}
catch(Exception $e){
    echo "error creating table <br>".$e->getMessage();
}

try{
$query2="INSERT INTO user (username,password) VALUES (?,?)";

$stmt2= $db->prepare($query2);
$stmt2->execute([$username,$password]);

}
catch(Exception $e){
    echo "error inserting user <br>".$e->getMessage();
    return false;
}

return true;

}

function findUserByUsername($username){
    global $db;
    try{
    $query="SELECT * FROM user WHERE username=?";
    $stmt= $db->prepare($query);
    $stmt->execute([$username]);
    $result=$stmt->fetch();
    }
    catch(Exception $e){
        echo "error finind user name :<br>".$e->getMessage();
        
        return false;
    }
    return $result;
}



function changePassword($currentPassword,$newPassword){
    global $session;
    global $db;
    global $host;

    $username= $session->get("auth-username");
    $new=password_hash($newPassword,PASSWORD_DEFAULT);

    try{
       $query="SELECT * FROM user WHERE username=?";
       $stmt=$db->prepare($query);
       $stmt->execute([$username]);
       $result=$stmt->fetch();
       $oldPassword=$result["password"];
       if(!password_verify($currentPassword,$oldPassword)){
        redirect($host."/account.php");
       
        $session->addFlashBag()->add("error","Incorrect Password");
        return false;
       }

    }catch(Exception $e){
        echo $e->getMessage();
        die();
        redirect($host."/account.php");
        $session->addFlashBag()->add("error","Incorrect Password");
        return false;
    }


    try{
        $query="UPDATE user SET password = ? WHERE username = ?";
        $stmt= $db->prepare($query);
        $stmt->execute([$new,$username]);
        
    }
    catch(Exception $e){
       echo "error updating password:".$e->getMessage();
       die();
       $session->getFlashBag()->add("error","Error changing password");
    redirect($host."/account.php");
    return false;
    }
    
    $session->getFlashBag()->add("success","Password successfully changed");
    redirect($host."/index.php");
    return true;
}

function checkAuth(){

    global $session;

   return  $session->get("auth-userid",false);

}