<?php

    include ('function.php');
    $link = connect_db();

    if(isset($_GET['id']) & isset($_GET['idChapter'])) {
        $id_element = $_GET['id'];
        $id_chapter = $_GET['idChapter'];
        echo ' ID = ' . $id_element;
        $test = deleteElementDB($id_element, $link);
        echo $test;
        header('Location: /elements.php?id=' . $id_chapter);
    }
    else{
        header('Location: /elements.php?id=' . $id_chapter);
    }

?>