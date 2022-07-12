<?php
    require_once("connect.php");
    try {
        //User data request
        $query = "SELECT * FROM users WHERE id = :id";
        $usr = $pdo->prepare($query);
        $usr->execute(['id' => $_GET['id']]);
        $user = $usr->fetch();
        //Processing data before output
        $user['name'] = htmlspecialchars($user['name']);
        $user['email'] = htmlspecialchars($user['email']);
        $user['first_name'] = htmlspecialchars($user['first_name']);
        $user['last_name'] = htmlspecialchars($user['last_name']);
        //Responce structure
        echo "<p><span class='key'>Nickname: </span><span class='data'>{$user['name']}</span></p>";
        echo "<p><span class='key'>Email: </span><span class='data'>{$user['email']}</span></p>";
        echo "<p><span class='key'>Name: </span><span class='data'>{$user['first_name']}</span></p>";
        echo "<p><span class='key'>Last name: </span><span class='data'>{$user['last_name']}</span></p>";
    } catch(PDOException $e) {
        echo "Request error: " . $e->getMessage();
    }