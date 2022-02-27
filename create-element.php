<?php

    include ('function.php');
    $link = connect_db();

    if(isset($_POST['name']) & isset($_POST['description']) & isset($_POST['perent']) & isset($_POST['type'])) {
        $name = $_POST['name'];
        $other = $_POST['description'];
        $id_chapter = $_POST['perent'];
        $type = $_POST['type'];
        echo 'Name = ' . $name . ' Description = ' . $other . ' Perent = ' . $id_chapter . ' Type = ' . $type . '<br>';
        $test = createElementDB($name, $other, $id_chapter, $type, $link);
        echo $test;
        header('Location: /elements.php?id=' . $id_chapter);
    }
    else{
        header('Location: /elements.php?id=' . $id_chapter);
    }

?>