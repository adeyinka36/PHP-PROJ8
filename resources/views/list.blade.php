<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>
    </head>
    <body>
    <?php
      
       $process= curl_init();
       curl_setopt($process,CURLOPT_URL,"http://127.0.0.1:1000/api/todo/");
       
       curl_setopt($process,CURLOPT_RETURNTRANSFER,1);
       $result= curl_exec($process);
       
       if($result==false){
           echo "got nothing";
       }
       else{
           var_dump($result);
       }
       curl_close($process);
       ?>
    </body>
    </html>