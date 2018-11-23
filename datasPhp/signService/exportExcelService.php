<?php
    include_once('../signOtherClass/sql.class.php');

    header('Access-Control-Allow-Origin: http://localhost:8080');
	header("Access-Control-Allow-Credentials: true");

    Header("Content-type:application/octet-stream");
    Header("Accept-Ranges:bytes");
    Header("Content-type:application/vnd.ms-excel");  
    Header("Content-Disposition:attachment;filename=2018.11.9.xls");

    $mon = $_REQUEST['month'];

    $startDate = '2018-'.($mon-1).'-26';
    $endDate   = '2018-'.$mon.'-25';

    $select_sql    = 'select * from sign_time'.' where date between '.'\''.$startDate.'\''.' and '.'\''.$endDate.'\''.' order by date asc';
    $user_sql      = new sql_class($select_sql);
    $select_status = $user_sql->doSql($select_sql);
    
    echo "id\tuser_id\tmonth\tdate\tstartTime\tendTime\toverTime\tmeal_money\treason";

    $arr = array();
    $i = 0;
    while($row = $select_status->fetch_assoc()) {
        echo "\n";
        echo $row['id']."\t".$row['user_id']."\t".$row['month']."\t".$row['date']."\t".$row['startTime']."\t".$row['endTime']."\t".$row['overTime']."\t".$row['meal_money']."\t".$row['reason'];
    }

?>