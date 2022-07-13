<?php
    //Connection to the DB
    require_once("../connect.php");
    try {
        //Check if POST parameters were sent; on success - send to the DB
        if(!empty($_POST)) {
            $error = [];
            if(empty($_POST['nickname'])) {
                $error = "Author is missing";
            }
            if(empty($_POST['content'])) {
                $error = "Message is missing";
            }
            //If no errors - send data to the DB
            if(empty($error)) {
                $query = "INSERT INTO comments VALUES(
                          NULL, :nickname, :content, NOW(), 1)";
                $user = $pdo->prepare($query);
                $user->execute([
                    'nickname' => $_POST['nickname'],
                    'content' => $_POST['content']
                ]);
            }
        }
        // Display messages in descending order of publication date
        $query = "SELECT * FROM comments WHERE is_visible = 1 ORDER BY created_at DESC";
        $com = $pdo->prepare($query);
        $com->execute();
        
        while($comments = $com->fetch()) {
            //print_r($comments);
            $comments['nickname'] = htmlspecialchars($comments['nickname']);
            $comments['content'] = nl2br(htmlspecialchars($comments['content']));
            //Display message
            echo "<div>".
            "<span class='author'>{$comments['nickname']}</span>".
            "<span class='date'>{$comments['created_at']}</span>".
            "<span class='content'>{$comments['content']}</span>".
            "</div>";
        }   
    } catch (PDOException $e) {
        echo "Request error: " . $e->getMessage();
    }