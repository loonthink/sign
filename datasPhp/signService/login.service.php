<?php

    include_once('../signOtherClass/sql.class.php');

    class login_pro {
        private $name;
        private $password;
        
        public static $table_name = 'sign_user';

        public function __construct( $name, $password) {
            $this->name = $name;
            $this->password = $password;
        }

        public function selectUser() {
            // $select_sql = 'select * from '.self::$table_name.' where name = '.'\''.$this->name.'\''.'and'.' password = '.'\''. $this->password.'\'';
            $select_sql = 'select * from '.self::$table_name.' where name = '.'\''.$this->name.'\'';
            $user_sql = new sql_class($select_sql);
            $login_status = $user_sql->doSql($select_sql);
            $nums = $login_status->num_rows;
            if( $nums ) {
                $user = $login_status->fetch_assoc();
                if($this->password == $user['password']) {
                    echo json_encode(['code'=>0, 'msg'=>'welcome to your work']);
                    $sess_user = array('username'=>$this->name,'password'=>$this->password);
                    // session_start();
                    $_SESSION["user"]=$sess_user;
                    $_SESSION["userId"]=$user['id'];
                } else {
                    echo json_encode(['code'=>1, 'msg'=>'password error']);
                }
            } else {
                echo json_encode(['code'=>1, 'msg'=>'username not exist']);
            }
        }

        public function insertUser() {
            
            if($this->checkUsername()) {
                echo json_encode(['code'=>1, 'msg'=>'username exist']);
                return;
            }

            $insert_sql = 'insert into '.self::$table_name.'(name, password) values ('.'\''.$this->name.'\''.','.'\''.$this->password.'\''.')';
            $user_sql = new sql_class($insert_sql);
            $insert_status = $user_sql->doSql($insert_sql);
            if($insert_status) {
                echo json_encode(['code'=>0, 'msg'=>'welcome']);
                // setcookie("username", $this->name, time()+24*3600*30);
                // setcookie("password", $this->password, time()+24*3600*30);
            };
        }

        public function checkUsername() {
            $select_sql = 'select count(*) from '.self::$table_name.' where name = '.'\''.$this->name.'\'';
            $user_sql = new sql_class($select_sql);
            $select_status = $user_sql->doSql($select_sql);
            if($select_status->fetch_row()[0] != 0) {
                return true;
            } else {
                return false;
            }
        }
    }
?>