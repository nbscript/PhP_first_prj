<?php

session_start();
require ('connect.php');
$dbTableName = 'users';
function dbprint($value): void
{
    echo '<pre>';
    print_r($value);
    echo '</pre>';
    exit();

}
// проверка выполнекния запроса к БД
function dbCheckError($query)
{
    $errInfo = $query->errorInfo();

    if ($errInfo[0] !== PDO::ERR_NONE) {
        echo $errInfo[2];
        exit();
    }
    return true;
}
function selectAll(string $table, array $params = []) :?array
{
    global $pdo;
    $sql = "SELECT * FROM $table";
    if (!empty($params)) {
        $i = 0;
        foreach ($params as $key => $value) {
            if (is_string($value)) {
                $value = "'$value'";
            }
            if ($i === 0) {
                $sql = $sql . " WHERE $key=$value";
            } else {
                $sql = $sql. " AND $key=$value";
            }
            $i++;
        }
    }


    $query = $pdo->prepare($sql);
    $query->execute();

    dbCheckError($query);

    return $query->fetchAll();

}

function selectFirst(string $table, array $params = [])
{
    global $pdo;
    $sql = "SELECT * FROM $table";

    if (!empty($params)) {
        $i = 0;
        foreach ($params as $key => $value) {
            if (is_string($value)) {
                $value = "'$value'";
            }
            if ($i === 0) {
                $sql = $sql . " WHERE $key=$value";
            } else {
                $sql = $sql. " AND $key=$value";
            }
            $i++;
        }
    }

    //$sql =$sql." LIMIT 1";

    $query = $pdo->prepare($sql);
    $query->execute();

    dbCheckError($query);

    return $query->fetch();
}

// Write in DB
function insert(string $table, array $data)
{
    global $pdo;

    $i= 0;
    $collumn = '';
    $mask = '';
    $length = (count($data)-1);
    foreach ($data as $key => $value) {
        if($i < $length) {
            $collumn = $collumn . "$key, ";
            $mask = $mask . "'$value', ";
        }
        else {
            $collumn = $collumn . "$key";
            $mask = $mask . "'$value'";
        }
        $i++;
    }
    $sql = "INSERT INTO $table ($collumn)
            VALUES ($mask)";
    //dbprint($sql);
    //exit();

    $query = $pdo->prepare($sql);
    $query->execute($data);
    dbCheckError($query);
    return $pdo->lastInsertId();
}

// update data
function update(string $table, $id, array $data)
{
    global $pdo;

    $i= 0;
    $reqParams = '';
    $mask = '';
    $length = (count($data)-1);
    foreach ($data as $key => $value) {
        if($i < $length) {
            $reqParams = $reqParams . "$key='$value', ";
        }
        else {
            $reqParams = $reqParams . "$key='$value'";
        }
    $i++;
    }
    // UPDATE 'users' SET 'username'='test', 'password'='5555' WHERE 'id'=14
    $sql = "UPDATE $table SET $reqParams WHERE id='$id'";

    $query = $pdo->prepare($sql);
    $query->execute($data);
    dbCheckError($query);
}

// delete data
function delete(string $table, $id): void
{
    global $pdo;

    // DELETE FROM 'users' WHERE 'id'=14
    $sql = "DELETE FROM $table WHERE id='$id'";
    dbprint($sql);

    $query = $pdo->prepare($sql);
    $query->execute();
    dbCheckError($query);
}

// Выборка записей(posts) с автором в админку
function selectAllFromPostsWithUser($table1, $table2): array
{
    global $pdo;
    $sql = "
            SELECT 
            t1.id,
            t1.title,
            t1.img,
            t1.content,
            t1.status,
            t1.id_topic,
            t1.created_date,
            t2.username
            FROM $table1 AS t1 JOIN $table2 AS t2 ON t1.id_user = t2.id";

    $query = $pdo->prepare($sql);
    $query->execute();
    dbCheckError($query);
    return $query->fetchAll();
}
//
//$arrData = [
//    'admin' => '0',
//    'username' => 'Snejana',
//    'email' => 'sneja@mail.net',
//    'password' => '12345'
//];
//
//$updateData = [
//    'username' => 'Anna',
//    'email' => 'anna@mail.net',
//];
//
////insert($dbTableName, $arrData);
//update('users', 6, $updateData);
//delete($dbTableName, 7);