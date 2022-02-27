<?php

    function connect_db() {
        $link = mysqli_connect('localhost', 'mysql', '', 'testobj'); //хост/пользователь/пароль/имя бд
        if (mysqli_connect_errno()) {
            echo 'Ошибка в подключении к БД (' . mysqli_connect_errno() . '): ' . mysqli_connect_error();
            exit();
        }
        else {
            // echo 'БД подключено';
        }
        return $link;
    }

    function select_db($link,$table,$column) {
        $sql = "SELECT * FROM `$table`;";
        $result = mysqli_query($link,$sql);
        $arr = array();
        while($row = $result -> fetch_assoc()) {
            $arr[$row[$column]] = $row;
        }
        return $arr;
    }

    function getTree($data) {
        $arr = array();
        foreach($data as $id => &$node) {
            if (!$node['parent_id']) {
                $arr[$id] = &$node;
            }
            else {
                $data[$node['parent_id']]['childs_id'][$id] = &$node;
            }
        }
        return $arr;
    }

    function showMenu($data) {
        $str = '';
        foreach($data as $item) {
            $str .= tplMenu($item);
        }
        return $str;
    }

    function tplMenu($data) {
        if ($data['id_chapter'] != 1) {
            $menu = '<li><a class="main-link" href="/elements.php?id=' . $data['id_chapter'] . '">' . $data['name'] . '</a> | <a href="/create-chapter.php?id=' . $data['id_chapter'] .
            '"><i class="fa-solid fa-plus"></i></a> | <a href="/change-chapter.php?id=' . $data['id_chapter'] .
            '"><i class="fa-solid fa-pencil"></i></a> | <a href="delete.php?id=' . $data['id_chapter'] . '"><i class="fa-solid fa-xmark"></i></a>';
            if(isset($data['childs_id'])){
                $menu .= '<ul>' . showMenu($data['childs_id']) . '</ul>';
        }
        $menu .= '</li>';
        }
        else {
            $menu = '<li><a class="main-link" href="/elements.php?id=' . $data['id_chapter'] . '">' . $data['name'] . '</a> | <a href="/create-chapter.php?id=' . $data['id_chapter'] . '"><i class="fa-solid fa-plus"></i></a>';
            if(isset($data['childs_id'])){
                $menu .= '<ul>' . showMenu($data['childs_id']) . '</ul>';
        }
        $menu .= '</li>';
        }
        
        return $menu;
    }

    function getDataFromDB($id, $table, $dbid, $link) {
        $sql = "SELECT * FROM $table WHERE $dbid = $id;";
        $result = mysqli_query($link, $sql);
        $data = mysqli_fetch_assoc($result);
        // echo '<pre>';
        // print_r($sql);
        // echo '</pre>';
        return $data;
    }

    function changeChapterDB($name, $description, $id, $id_perent, $link) {
        $query = "UPDATE chapter SET `name` = '$name', `description` = '$description', `parent_id` = '$id_perent', `date_update` = CURDATE() WHERE id_chapter = $id;";
        echo $query;
        return mysqli_query($link,$query);
    }

    function createChapterDB($name, $description, $id_perent, $link) {
        $query = "INSERT INTO chapter (`name`, `description`, `parent_id`, `date_update`, `date_create`) VALUES ('$name', '$description', $id_perent, CURDATE(), CURDATE());";
        echo $query;
        return mysqli_query($link,$query);
    }

    function deleteChapterDB($id, $link) {
        $query = "DELETE FROM chapter WHERE id_chapter = $id;";
        echo $query;
        return mysqli_query($link,$query);
    }

    function createElementDB($name, $other, $id_chapter, $type, $link) {
        $query = "INSERT INTO element (`name`, `other`, `id_chapter`, `type`, `date_update`, `date_create`) VALUES ('$name', '$other', $id_chapter, $type, CURDATE(), CURDATE());";
        echo $query;
        return mysqli_query($link,$query);
    }

    function deleteElementDB($id, $link) {
        $query = "DELETE FROM element WHERE id_element = $id;";
        echo $query;
        return mysqli_query($link,$query);
    }

    function changeElementDB($name, $other, $id, $id_chapter, $type, $link) {
        $query = "UPDATE element SET `name` = '$name', `other` = '$other', `id_chapter` = $id_chapter, `type` = $type, `date_update` = CURDATE() WHERE id_element = $id;";
        echo $query;
        return mysqli_query($link,$query);
    }

    function beginSortDate01($a, $b) {
        return $a['date_create'] <=> $b['date_create'];
    }

    function beginSortDate10($a, $b) {
        if($a['date_create'] == $b['date_create']) return 0;
        return $a['date_create'] < $b['date_create'] ? 1 : -1;
    }

    function beginSortName01($a, $b) {
        return $a['name'] <=> $b['name'];
    }

    function beginSortName10($a, $b) {
        if($a['name'] == $b['name']) return 0;
        return $a['name'] < $b['name'] ? 1 : -1;
    }

?>