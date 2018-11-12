<?php

    include_once('sql.class.php');

    class login_pro {
        private $name;
        private $password;
        
        public static $table_name = 'sign_user';

        public function __construct( $name, $password) {
            $this->name = $name;
            $this->password = $password;
        }

        public function selectUser() {
            $select_sql = 'select * from '.self::$table_name.' where name = '.'\''.$this->name.'\''.'and'.' password = '.'\''. $this->password.'\'';
            // echo 'select_sql'.$select_sql.'<br />';
            $user_sql = new sql_class($select_sql);
            $login_status = $user_sql->doSql($select_sql);
            $nums = $login_status->num_rows;
            if( $nums ) {
                echo 'Please go in';
            } else {
                echo '用户名或密码错误';
            }
        }
    }
?>