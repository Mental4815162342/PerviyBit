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
                        $data = getDataFromDB($id, 'element', 'id_element', $link);
                        $perents = select_db($link,'chapter','id_chapter');
                        $types = select_db($link,'type','id_type');
                        // echo '<pre>';
                        // print_r($data);
                        // print_r($perents);
                        // echo '</pre>';
                    ?>
                    <form action="/change-element.php" method="post">
                        <div class="mb-3">
                            <label for="inputid_element" class="form-label">ID</label>
                            <input class="form-control" id="inputid_element" name="id_element" value="<?=$data['id_element']?>">
                        </div>
                        <div class="mb-3">
                            <label for="inputName" class="form-label">Название элемента</label>
                            <input class="form-control" id="inputName" name="name" value="<?=$data['name']?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="inputDesct" class="form-label">Описание</label>
                            <textarea class="form-control" id="inputDesct" name="other" rows="3" required><?=$data['other']?></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="inputDateCreate" class="form-label">Дата создания</label>
                            <input class="form-control" id="inputDateCreate" name="DateCreate" value="<?=$data['date_create']?>" disabled>
                        </div>
                        <div class="mb-3">
                            <label for="inputDateUpdate" class="form-label">Дата изменения</label>
                            <input class="form-control" id="inputDateUpdate" name="DateUpdate" value="<?=$data['date_update']?>" disabled>
                        </div>
                        <div class="mb-3">
                            <label for="inputTypes" class="form-label">Тип</label>
                            <select class="form-select" name="type" aria-label="Default select">
                                <?php
                                    foreach($types as $type) {
                                        echo '<option value="' . $type['id_type'] . '">' . $type['name'] . '</option>';
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="inputPerents" class="form-label">Родительский раздел</label>
                            <select class="form-select" name="perent" aria-label="Default select">
                                <?php
                                    foreach($perents as $perent) {
                                        if($data['id_chapter'] == $perent['id_chapter']) {
                                            echo '<option selected value="' . $perent['id_chapter'] . '">' . $perent['name'] . '</option>';
                                        }
                                        else {
                                            echo '<option value="' . $perent['id_chapter'] . '">' . $perent['name'] . '</option>';
                                        }
                                    }
                                ?>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Изменить</button>
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