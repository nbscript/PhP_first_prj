<?php
include SITE_ROOT ."/app/database/db.php";

$errMsg = '';


function sessionBegin (array $existence): void
{
    $_SESSION['id'] = $existence['id'];
    $_SESSION['login'] = $existence['username'];
    $_SESSION['admin'] = $existence['admin'];

    if ($_SESSION['admin']) {
        header('location: ' . BASE_URL . 'admin/posts/index.php');
    } else {
        header('location: ' . BASE_URL);
    }
}

// Registration
if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['button-reg'])) {
    $admin = 0;
    $login = trim($_POST['login']);
    $email = trim($_POST['mail']);
    $passF  = trim($_POST['pass-first']);
    $passS  = trim($_POST['pass-second']);

    if($login === '' || $email === '' || $passF === '' || $passS === '') {
        $errMsg = 'Fill all fields';
    }
    else if (mb_strlen($login, 'UTF-8') < 2 ) {
        $errMsg = 'Login must have more than 2 symbols';
    }
    elseif ($passF !== $passS) {
        $errMsg = 'Passwords arent equal';

    }
    else {
        $existence = selectFirst('users', ['email' => $email]);
        if($existence && ($existence['email'] === $email)) {
            $errMsg = ('User with that email already exists');
        }
        else {
            $pass = password_hash($passS, PASSWORD_DEFAULT);
            $post = [
                'admin' => $admin,
                'username' => $login,
                'email' => $email,
                'password' => $pass
            ];
            $id = insert('users', $post);
            //$errMsg = "User <strong> $login</strong> successfully registered";
            $user = selectFirst('users', ['id'=> $id]);

            sessionBegin($user);

        }
    }

}else {
    $login = '';
    $email = '';
}

// Log in
if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['button-log'])) {
    $email = trim($_POST['mail']);
    $password  = trim($_POST['password']);

    if($email === '' || $password === '' ) {
        $errMsg = 'Fill all fields';

    }
    $existence = selectFirst('users', ['email' => $email]);
    if(  $existence &&
        ($existence['email'] === $email) &&
        password_verify($password,  $existence['password'])) {
        // authorization
        sessionBegin($existence);
    }
    else {
        $errMsg = 'Email or password is incorrect';
    }
    $email = '';
}

