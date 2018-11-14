<?php

    header('Access-Control-Allow-Origin: http://localhost:8080');
    header("Access-Control-Allow-Credentials: true");
    
    session_start();

    // echo $_SESSION["user"];

    if(empty( $_SESSION["user"] ) ) {
        echo json_encode(['code'=>1, 'msg'=>'please go to login']);
    } else {
        echo json_encode(['code'=>0, 'msg'=>$_SESSION["user"]]);
    }
?>