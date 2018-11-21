<?php
    
    header('Access-Control-Allow-Origin: http://localhost:8080');
    header("Access-Control-Allow-Credentials: true");   

    session_start();

    include_once('../signService/saveTimeService.php');

    $date  = $_REQUEST['date'];
    $month = 0;
    if(!empty($date)) {
        $month = explode('-',$date)[1];
    }
    $startTime = $_REQUEST['startTime'];
    $endTime = $_REQUEST['endTime'];
    $action = $_REQUEST['action'];
    $mon = $_REQUEST['month'];
    $id = $_REQUEST['id'];
    $userId = $_SESSION['userId'];

    $saveTimeService = new saveTimeService($userId,$date,$month,$startTime,$endTime);
    if($action == 1) { //打卡
        $saveTimeService->timePre();
    } else if($action == 2) { //显示记录
        $saveTimeService->showAllTime($mon);
    } else if($action == 3) { //显示月结
        $saveTimeService->showSummary($mon);
    } else if($action == 4) { //显示月结
        $saveTimeService->deleteErro($id);
    }
?>