<?php

    include ('function.php');
    $link = connect_db();

    if(isset($_POST['name']) & isset($_POST['other']) & isset($_POST['id_element']) & isset($_POST['perent']) & isset($_POST['type'])) {
        $name = $_POST['name'];
        $other = $_POST['other'];
        $id = $_POST['id_element'];
        $perent = $_POST['perent'];
        $type = $_POST['type'];
        echo 'Name = ' . $name . ' Other = ' . $other . ' ID = ' . $id . ' Perent = ' . $perent . ' Type = ' . $type . '<br>';
        $test = changeElementDB($name, $other, $id, $perent, $type, $link);
        echo $test;
        header('Location: /elements.php?id=' . $perent);
    }
    else{
        header('Location: /elements.php?id=' . $perent);
    }

?>