<?php
    function ifElse($status,$successMsg,$errorMsg) {
        if($status) {
            echo json_encode(['code'=>$status, 'msg'=>$successMsg]);
        } else {
            echo json_encode(['code'=>$status, 'msg'=>$errorMsg]);
        }
    }
?>