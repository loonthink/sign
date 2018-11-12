<?php
    class sql_class {
        private $conn;
        private $sql;

        public function __construct($sql) {
            $this->conn = new mysqli("localhost","root","","sign");

            if(!$this->conn) {
                die('Connect error'.$this->conn->connect_error);
            }

            // echo "Link database success";

            $this->sql = $sql;
        }

        public function doSql() {
            $result = $this->conn->query($this->sql);
            if($this->conn->errno) {
                die('operation error'.$this->conn->error);
            }
            return $result;
        }

    }
?>