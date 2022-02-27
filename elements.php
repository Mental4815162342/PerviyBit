<?php
    include ('function.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="assets/css/style.css" rel="stylesheet">
</head>
<body>
    <header>
        <?php
            $link = connect_db();
        ?>
        <div class="container">
            <div class="row">
                <div class="col-4">
                    <a href="/index.php">Главная</a>
                </div>
                <div class="col-8">
                    <?php
                        if(isset($_GET['id'])) {
                            $id_chapter = $_GET['id'];
                            $data = getDataFromDB($id_chapter, 'chapter', 'id_chapter', $link);
                            echo '<p>' . $data['name'] . '</p>';
                        }
                    ?>
                </div>
            </div>
        </div>
    </header>
    <main>
        <div class="container">
            <br>
            <div class="row">
                <div>
                    <?php
                        echo '<a href="create-elem.php?id=' . $id_chapter . '"><button type="button" class="btn btn-primary">Добавить</button></a>';
                    ?>
                    <div class="btn-group" role="group">
                        <button id="btnGroupDrop1" type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                            Сортировать
                        </button>
                        <?php
                        echo '<ul class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                            <li><a class="dropdown-item" href="/elements.php?id=' . $id_chapter . '&date=1">По дате (сначала новые)</a></li>
                            <li><a class="dropdown-item" href="/elements.php?id=' . $id_chapter . '&date=0">По дате (сначала старые)</a></li>
                            <li><a class="dropdown-item" href="/elements.php?id=' . $id_chapter . '&alphabet=1">По наименованию (А-я)</a></li>
                            <li><a class="dropdown-item" href="/elements.php?id=' . $id_chapter . '&alphabet=0">По наименованию (я-А)</a></li>
                        </ul>'
                        ?>
                    </div>
                </div>
            </div>
            <br>
            <div class="row list-elem">
                <?php
                    $elements = select_db($link,'element','id_element');
                    if ($_GET['alphabet'] == 1) {
                        usort($elements, 'beginSortName01');
                    }
                    elseif ($_GET['alphabet'] == 0)
                    {
                        usort($elements, 'beginSortName10');
                    }
                    elseif ($_GET['date'] == 1)
                    {
                        usort($elements, 'beginSortDate01');
                    }
                    elseif ($_GET['date'] == 0)
                    {
                        usort($elements, 'beginSortDate10');
                    }
                    else
                    {
                        usort($elements, 'beginSortDate01');
                    }
                    foreach($elements as $element) {
                        if ($element['id_chapter'] == $id_chapter) {
                            echo '<div class="col-4 elem">
                                <div>
                                <div class="title-elem"><div class="name-elem">' .
                                    $element['name'] .
                                '</div> <div><a href="/change-elem.php?id=' . $element['id_element'] . '"><i class="fa-solid fa-pencil"></i></a> | <a href="/delete-element.php?id=' . $element['id_element'] . '&idChapter=' . $id_chapter . '"><i class="fa-solid fa-xmark"></i></a></div></div>
                                <hr>
                                <div class="body-elem">' .
                                    $element['other'] .
                                '</div>
                                </div>
                                <div class="date-elem"> <i>Создано: ' .
                                    $element['date_create'] . ' Обновлено: ' . $element['date_update'] .
                                '</i></div>
                            </div>';
                        }
                    }
                ?>
            </div>
        </div>
    </main>
    <footer>
        
    </footer>
    <script src="https://kit.fontawesome.com/41cfbcd346.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="/assets/js/main.js"></script>
</body>
</html>