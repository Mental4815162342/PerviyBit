<?php

    include ('function.php');
    $link = connect_db();

    if(isset($_POST['name']) & isset($_POST['description']) & isset($_POST['perent'])) {
        $name = $_POST['name'];
        $description = $_POST['description'];
        $perent = $_POST['perent'];
        echo 'Name = ' . $name . ' Description = ' . $description . ' Perent = ' . $perent . '<br>';
        $test = createChapterDB($name, $description, $perent, $link);
        echo $test;
        header('Location: /');
    }
    else{
        header('Location: /');
    }

?>