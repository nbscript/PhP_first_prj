<?php

include SITE_ROOT . "/app/database/db.php";
$errMsg = '';
//$id ='';
$name ='';
$description = '';

$topics = selectAll(DB_TOPICS);


// Registration
if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['btn-topic-create'])) {

    $name = trim($_POST['name']);
    $description = trim($_POST['description']);


    if($name === '' || $description === '') {
        $errMsg = 'Fill all fields';
    }
    else if (mb_strlen($name, 'UTF-8') < 2 ) {
        $errMsg = 'Категория должна быть более 2-х символов';
    }

    else {
        $existence = selectFirst(DB_TOPICS, ['name' => $name]);
        if($existence && ($existence['name'] === $name)) {
            $errMsg = ('Категория уже существует');
        }
        else {
            $topic = [
                'name' => $name,
                'description' => $description,
            ];
            $id = insert(DB_TOPICS, $topic);
            //$errMsg = "User <strong> $login</strong> successfully registered";
            $topic = selectFirst(DB_TOPICS, ['id'=> $id]);

            header('location: ' . BASE_URL . 'admin/topics/index.php');
        }
    }

}
else {
    $name = '';
    $description = '';
}

// Изменение Категории
if($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $id = $_GET['id'];
    $topic = selectFirst( DB_TOPICS, ['id' => $id]);
    dbprint($topic);
    $id = $topic['id'];
    $name = $topic['name'];
    $description = $topic['description'];
}

// Registration
if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['btn-topic-edit'])) {

    $name = trim($_POST['name']);
    $description = trim($_POST['description']);


    if ($name === '' || $description === '') {
        $errMsg = 'Fill all fields';
    } else if (mb_strlen($name, 'UTF-8') < 2) {
        $errMsg = 'Категория должна быть более 2-х символов';
    }
//    else {
//        $existence = selectFirst(DB_TOPICS, ['name' => $name]);
//        if($existence && ($existence['name'] === $name)
//                        && ($existence['description'] === $description)) {
//            $errMsg = ('Категория уже существует');
//        }
        else {
            $topic = [
                'name' => $name,
                'description' => $description,
            ];
            $id = $_POST['id'];
            update(DB_TOPICS, $id, $topic);
            //$errMsg = "User <strong> $login</strong> successfully registered";
            //$topic = selectFirst(DB_NAME, ['id'=> $id]);

            header('location: ' . BASE_URL . 'admin/topics/index.php');
        }
  //  }
}

// Удаление Категории
if($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['del_id'])) {
    $id = $_GET['del_id'];

    delete( DB_TOPICS, $id);

    header('location: ' . BASE_URL . 'admin/topics/index.php');

}