<?php

    include ('function.php');
    $link = connect_db();

    if(isset($_POST['name']) & isset($_POST['description']) & isset($_POST['id_chapter']) & isset($_POST['perent'])) {
        $name = $_POST['name'];
        $description = $_POST['description'];
        $id_chapter = $_POST['id_chapter'];
        $perent = $_POST['perent'];
        echo 'Name = ' . $name . ' Description = ' . $description . ' ID = ' . $id_chapter . ' Perent = ' . $perent . '<br>';
        $test = changeChapterDB($name, $description, $id_chapter, $perent, $link);
        echo $test;
        header('Location: /');
    }
    else{
        header('Location: /');
    }

?>