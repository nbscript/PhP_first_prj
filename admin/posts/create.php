<?php
include "../../path.php";
include SITE_ROOT. "/app/controllers/posts.php";

?>
<!doctype html>
<html lang="ru">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css"
          integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

    <!-- Custom Styling -->
    <link rel="stylesheet" href="../../assets/css/admin.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <title>My blog</title>
</head>
<body>

<?php
include ('../../app/include/header-admin.php');
?>

<div class="container">
    <div class="row">
        <?php include "../../app/include/sidebar-admin.php" ?>

        <div class="posts col-9">
            <div class="button row">
                <a href="create.php" class="col-2 btn-success">Add Post</a>
                <span class="col-1"></span>
                <a href="index.php" class="col-2 btn-warning">Manage Post</a>
            </div>
            <div class="row title-table">
                <h2>Добавление Записи</h2>
            </div>

            <div class="row add-post">
                <form action="create.php" method="post" enctype="multipart/form-data">
                    <div class="col mb-4">
                        <input name="title" type="text" enct class="form-control" placeholder="Title"
                               aria-label="Название статьи">
                    </div>
                    <div class="col">
                        <label for="editor" class="form-label">Содержимое Записи</label>
                        <textarea name="content" class="form-control" id="editor" rows="6"></textarea>
                    </div>
                    <div class="input-group col mt-4 mb-4">
                        <input name="img" type="file" class="form-control" id="inputGroupFile02">
                        <label class="input-group-text" for="inputGroupFile02">Upload</label>
                    </div>
                    <select name="topic" class="form-select mb-4" aria-label="Select category">
                        <option disabled selected>Open this select menu</option>
                        <?php foreach ($topics as $key => $topic): ?>
                        <option value="<?=$topic['id'];?>"><?=$topic['name'];?></option>
                        <?php endforeach; ?>
                    </select>
                    <div class="form-check">
                        <input name="publish" type="checkbox" class="form-check-input" value="1"  id="flexCheckChecked">
                        <label class="form-check-label" for="flexCheckChecked">Publish</label>
                    </div>
                    <div class="col col-6">
                        <button name="btn-add-post" class="btn btn-primary" type="submit">Сохранить статью</button>
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>


<!-- footer -->
<?php
include ('../../app/include/footer.php');
?>
<!-- // footer -->


<!-- Optional JavaScript; choose one of the two! -->
<script src="https://cdn.ckeditor.com/ckeditor5/36.0.1/classic/ckeditor.js"></script>
<!-- Option 1: Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>

<!-- Option 2: Separate Popper and Bootstrap JS -->
<!--
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js" integrity="sha384-KsvD1yqQ1/1+IA7gi3P0tyJcT3vR+NdBTt13hSJ2lnve8agRGXTTyNaBYmCR/Nwi" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.min.js" integrity="sha384-nsg8ua9HAw1y0W1btsyWgBklPnCUAFLuTMS2G72MMONqmOymq585AcH49TLBQObG" crossorigin="anonymous"></script>
-->
<script src="../../assets/js/scripts.js"></script>
</body>
</html>
