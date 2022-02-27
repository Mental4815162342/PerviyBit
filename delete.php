<?php

    include ('function.php');
    $link = connect_db();

    if(isset($_GET['id'])) {
        $id_chapter = $_GET['id'];
        echo ' ID = ' . $id_chapter;
        $test = deleteChapterDB($id_chapter, $link);
        echo $test;
        header('Location: /');
    }
    else{
        header('Location: /');
    }

?>