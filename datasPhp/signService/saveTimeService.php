<?php

    include_once('../signOtherClass/sql.class.php');
    include_once('../common/ifElse.php');

    class saveTimeService {
        private $date;
        private $startTime;
        private $endTime;
        private $timeType;
        private $user_id;
        private $month;

        public static $table_name = 'sign_time';

        public function __construct( $user_id, $date, $month, $startTime, $endTime) {
            $this->date = $date;
            $this->startTime = $startTime;
            $this->endTime = $endTime;
            $this->user_id = $user_id;
            $this->month = $month;
        }

        public function timePre() {
            $select_sql = 'select id,startTime,endTime from '.self::$table_name.' where `date`='.'\''.$this->date.'\'';
            $user_sql = new sql_class($select_sql);
            $select_status = $user_sql->doSql($select_sql);

            $time = $select_status->fetch_assoc();

            if( $select_status->num_rows == 0 ) {
                $this->saveStart();
            } else {
                $this->saveEnd($time);
            };

        }

        public function saveStart() {
            $insert_sql = 'insert into '.self::$table_name.' (user_id, date, month, startTime, endTime) values ('.'\''.$this->user_id.'\''.','.'\''.$this->date.'\''.','.'\''.$this->month.'\''.','.'\''.$this->startTime.'\''.','.'\''.$this->endTime.'\''.')';
            $user_sql = new sql_class($insert_sql);
            $insert_status = $user_sql->doSql($insert_sql);

            ifElse($insert_status, 'save success', 'save error');
        }

        public function saveEnd( $time ) {
            if(empty($this->startTime)) {
                $this->startTime = $time['startTime'];
            } else if(empty($this->endTime)) {
                $this->endTime = $time['endTime'];
            };            
            
            $overTime = $this->calculateDura($this->endTime,$this->startTime);
            $meal_money = $this->cal_money($this->endTime);

            $update_sql = 'update '.self::$table_name.' set '.'startTime='.'\''.$this->startTime.'\''.','.'endTime='.'\''.$this->endTime.'\''.','.'overTime='.$overTime.','.'meal_money='.$meal_money.' where id='.$time['id'];
            $user_sql = new sql_class($update_sql);
            $update_status = $user_sql->doSql($update_sql);

            ifElse($update_status, 'update success', 'update error');

        }

        public function calculateDura($endTime,$startTime) {
            $mon = explode(':',$endTime)[0];
            if($mon > '16' || $mon == '15') {
                $startTime = '18:00:00';
            } 

            $overtime=floor((strtotime('2018-08-08'.$endTime)-strtotime('2018-08-08 '.$startTime))%86400/3600);

            if($overtime < 0) {
                $overtime = 0;
            };

            return $overtime;

        }

        public function cal_money($endTime) {
            $meal_money = 18;
            if(explode(':',$endTime)[0] > '18' && explode(':',$endTime)[0] != '16') {
                $meal_money = 2*18;
            }

            return $meal_money;
        }

        public function showAllTime($mon) {
            $select_sql = 'select * from '.self::$table_name.' where month='.$mon.' order by date asc';

            $user_sql = new sql_class($select_sql);
            $select_status = $user_sql->doSql($select_sql);
            $arr = array();
            $i = 0;
            while($row = $select_status->fetch_assoc()) {
                $arr[$i++] = $row;
            }

            echo json_encode(['code'=>1, 'msg'=>'pull success', "data" => $arr]);
        }

        public function showSummary($mon) {
            $select_sql = 'select sum(overTime) as overTime, sum(meal_money) as meal_money from '.self::$table_name.' where month='.$mon.' order by date asc';
            $user_sql = new sql_class($select_sql);
            $select_status = $user_sql->doSql($select_sql);
            $arr = array();
            $i = 0;
            while($row = $select_status->fetch_assoc()) {
                $arr[$i++] = $row;
            }

            echo json_encode(['code'=>1, 'msg'=>'summary success', "data" => $arr]);
        }

    }





?>