<?php
    include ('function.php');
?>
<!DOCTYPE html>
<html lang="ru">
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
        <div class="container">
            <div class="row">
                <div class="col-4">
                    <a href="/index.php">Главная</a>
                </div>
                <div class="col-8">
                    <p>Тестовое задание</p>
                </div>
            </div>
        </div>
    </header>
    <main>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <?php
                        $link = connect_db();
                        $id = $_GET['id'];
                        if(!is_numeric($id)) exit();
                        $data = getDataFromDB($id, 'chapter', 'id_chapter', $link);
                        $perents = select_db($link,'chapter','id_chapter');
                        $types = select_db($link,'type','id_type');
                        echo '<pre>';
                        // print_r($data);
                        // print_r($perents);
                        echo '</pre>';
                    ?>
                    <form action="/create-element.php" method="post">
                        <div class="mb-3">
                            <label for="inputName" class="form-label">Название элемента</label>
                            <input class="form-control" id="inputName" name="name" value="" placeholder="Напишите тут название раздела" required>
                        </div>
                        <div class="mb-3">
                            <label for="inputDesct" class="form-label">Описание</label>
                            <textarea class="form-control" id="inputDesct" name="description" value="" placeholder="Напишите тут описание" rows="3" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="inputType" class="form-label">Тип</label>
                            <select class="form-select" name="type" aria-label="Default select">
                                <?php
                                    foreach($types as $type) {
                                        echo '<option value="' . $type['id_type'] . '">' . $type['name'] . '</option>';
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="inputPerent" class="form-label">Родительский раздел</label>
                            <select class="form-select" name="perent" aria-label="Default select">
                                <?php
                                    foreach($perents as $perent) {
                                        if($data['id_chapter'] != $data['parent_id'])
                                        {
                                            if($data['id_chapter'] == $perent['id_chapter']) {
                                                echo '<option selected value="' . $perent['id_chapter'] . '">' . $perent['name'] . '</option>';
                                            }
                                            else {
                                                echo '<option value="' . $perent['id_chapter'] . '">' . $perent['name'] . '</option>';
                                            }
                                        }
                                    }
                                ?>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Добавить</button>
                    </form>
                </div>
            </div>
        </div>
    </main>
    <footer>

    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="/assets/js/main.js"></script>
</body>
</html>