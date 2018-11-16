<?php



    include_once('../signService');

    $date = $_REQUEST['date'];
    $startTime = $_REQUEST['startTime'];
    $endTime = $_REQUEST['endTime'];

    $saveTimeService = new $saveTimeService($date,$startTime,$endTime);

    $saveTimeService->saveStart();
?>