<?php
    class sql_class {
        private $conn;
        private $sql;

        public function __construct($sql) {

            $mysql_config=simplexml_load_file("../config.xml");

            $this->conn = new mysqli($mysql_config->host,$mysql_config->user,$mysql_config->pass,$mysql_config->database);

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

        public function close_sql() {
            if( !empty($this->conn) ) {

            }
        }

    }
?>