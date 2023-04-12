<?php

include SITE_ROOT . "/app/database/db.php";
if (!$_SESSION) {
    header( 'location: ' .BASE_URL . 'log.php');
}
$errMsg = '';
//$id ='';
$title ='';
$content = '';
$topic = '';
$img = '';

$topics = selectAll(DB_TOPICS);
$posts = selectAll(DB_POSTS);
$postAuthors = selectAllFromPostsWithUser(DB_POSTS, 'users');

//dbprint($postAuthors);


// Создание статьи
if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['btn-add-post'])) {

    if (!empty($_FILES['img']['name'])) {
        $imgName = time() . '_' . $_FILES['img']['name'];
        $imgTmpName = $_FILES['img']['tmp_name'];
        $imgDestination = ROOT_PATH . "\assets\images\posts\\" . $imgName;

        $fileType = $_FILES['img']['type'];


        if (strpos($fileType, 'image') === false) {
            die('Not image');
        }
        else {
            $result = move_uploaded_file($imgTmpName, $imgDestination);

            if ($result) {
                $_POST['img'] = $imgName;
            } else {
                $errMsg = "Ошибка загрузки изображения на сервер";
            }
        }
    }
    else {
        $errMsg = "Ошибка получения изображения";
    }

    $title = trim($_POST['title']);
    $content = trim($_POST['content']);
    $img = trim($_POST['img']);
    $topic = ($_POST['topic']);
    $status = isset($_POST['publish']) ? 1 : 0;

    //dbprint($status);

    if($title === '' || $content === '' || !$topic) {
        $errMsg = 'Fill all fields';
    }
    else if (mb_strlen($title, 'UTF-8') < 3 ) {
        $errMsg = 'Заголовок должнен быть более 3-х символов';
    }

    else {
        $post = [
            'id_user' => $_SESSION['id'] ,
            'title' => $title,
            'img' => $img,
            'content' => $content,
            'status' => $status,
            'id_topic' => $topic
        ];
        $id = insert(DB_POSTS, $post);
        //$errMsg = "User <strong> $login</strong> successfully registered";
        $post = selectFirst(DB_POSTS, ['id'=> $id]);

        header('location: ' . BASE_URL . 'admin/posts/index.php');
        }

}
else {
    $title = '';
    $content = '';
    $img ='';
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