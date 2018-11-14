<?php

    $mysql_config=simplexml_load_file("config.xml");
    // var_dump($xml);

    $conn = new mysqli($mysql_config->host,$mysql_config->user,$mysql_config->pass,$mysql_config->database);

    if(!$conn) {
        die('Connect error'.$conn->connect_error);
    }

    var_dump($conn);

    echo "<br >";
    echo "<br >";
    echo "<br >";

    $conn->close();

    // var_dump($conn);

    if(!empty($conn)) {
        echo "nonono";
    } else {
        echo "yesyesyes";
    }

?>