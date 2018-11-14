<?php
    session_start();
    $checkCode = "";
    for($i=0;$i<4;$i++) {
        $checkCode.=dechex(rand(1,15));
    }
    $_SESSION['MyCheckCode'] = $checkCode;
    $img=imagecreatetruecolor(110,30);
    $bgcolor=imagecolorallote($img,0,0,0);
    imagefill($img,0,0,$bgcolor);
    $white=imagecolorallote($img,255,255,255);
    $bgcolor=imagecolorallote($img,0,0,0);
    $bgcolor=imagecolorallote($img,0,0,0);  

?>