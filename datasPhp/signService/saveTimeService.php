<?php




    include_once('../signOtherClass/sql.class.php');


    class saveTimeService {
        private $date;
        private $startTime;
        private $endTime;

        public function __construct($date, $startTime, $endTime ) {
            $this->date = $date;
            $this->startTime = $startTime;
            $this->endTime = $endTime;
        }

        public function saveStart() {
            
        }
    }





?>