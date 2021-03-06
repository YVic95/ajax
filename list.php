<!DOCTYPE html>
<html>
    <head>
        <title>Users list</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="style.css">
        <script type="text/javascript" src="jquery.min.js"></script>
        <script type="text/javascript">
        $(function(){
            $(".jumbotron > div > a").on("click", function(){
                let url = "user.php?id=" + $(this).data('id');
                //console.log(this);
                //AJAX-request and its result
                $.ajax({
                    url: encodeURI(url)
                }).done(function(data){
                    $('#info').html(data).removeClass("hidden");
                }).fail(function() {
                    console.log( "error" );
                });
            });
        });
        </script>  
    </head>
    <body>
        <div id="container">
            <div id="list">
            <?php 
                //Connection to the DB
                require_once("connect.php");
                $query = "SELECT * FROM users ORDER BY name";
                $usr = $pdo->query($query);

                try {
                    echo "<div class='jumbotron'>";
                    while($user = $usr->fetch()) {
                        echo "<div><a class='link' href='#'"."data-id='".$user['id']."'>".htmlspecialchars($user['name'])."</a></div>";
                    }
                    echo "</div>";
                } catch(PDOException $e) {
                    echo "Request error: " . $e->getMessage();
                }
            ?>
            </div>
            <div id="info" class="hidden"></div>
        </div>
        
    </body>
</html>