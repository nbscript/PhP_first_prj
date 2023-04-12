<?php
include "../../path.php";
session_start();

include "../../app/controllers/users.php";
//include "../../app/controllers/topics.php";
?>
<!doctype html>
<html lang="en">
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
                <a href="create.php" class="col-2 btn-success">Создать</a>
                <span class="col-1"></span>
                <a href="index.php" class="col-2 btn-warning">Управлять</a>
            </div>
            <div class="row title-table">
                <h2>Добавление Пользователя</h2>
            </div>

            <div class="row add-post">
                <form action="create.php" method="post">
                    <div class="col">
                        <label for="formGroupExampleInput" class="form-label">Ваш логин</label>
                        <input type="text" name="login" value="<?=$login?>" class="form-control" id="formGroupExampleInput" placeholder="введите ваш логин...">
                    </div>
                    <div class="col">
                        <label for="exampleInputEmail1" class="form-label">Email</label>
                        <input type="email" name="mail" value="<?=$email?>"  class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="введите ваш email...">
                    </div>
                    <div class="col">
                        <label for="exampleInputPassword1" class="form-label">Пароль</label>
                        <input type="password" name="pass-first" class="form-control" id="exampleInputPassword1" placeholder="введите ваш пароль...">
                    </div>
                    <div class="col">
                        <label for="exampleInputPassword2" class="form-label">Повторите пароль</label>
                        <input type="password" name="pass-second" class="form-control" id="exampleInputPassword2" placeholder="повторите ваш пароль...">
                    </div>
                    <select class="form-select" aria-label="Select category">
                        <option selected>User</option>
                        <option value="1">Admin</option>
                    </select>
                    <div class="col">
                        <button class="btn btn-primary" type="submit">Создать</button>
                    </div>
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

<!-- Option 1: Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>

<!-- Option 2: Separate Popper and Bootstrap JS -->
<!--
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js" integrity="sha384-KsvD1yqQ1/1+IA7gi3P0tyJcT3vR+NdBTt13hSJ2lnve8agRGXTTyNaBYmCR/Nwi" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.min.js" integrity="sha384-nsg8ua9HAw1y0W1btsyWgBklPnCUAFLuTMS2G72MMONqmOymq585AcH49TLBQObG" crossorigin="anonymous"></script>
-->
</body>
</html>
