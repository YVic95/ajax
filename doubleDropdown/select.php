<?php
    //Connection to the DB
    require_once "../connect.php";

    $query = "SELECT * FROM catalogs 
                WHERE parent_id = :id AND is_activa = 1
                ORDER BY position";
    $cat = $pdo->prepare($query);
    $cat->execute(['id' => $_GET['id']]);
    echo "<option value='0'>Choose subcategory</option>";
    while($catalog = $cat->fetch()){
        echo "<option value='{$catalog['id']}'>{$catalog['name']}</option>";
    }