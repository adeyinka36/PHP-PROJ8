<?php

require_once '../bootstrap.php';

$host=getenv("APP_URL");

$session->remove("auth-loggedin");
$session->remove("auth-userid");

$session->getFlashBag()->add("success","sucessfully logged out");
redirect($host."/login.php");