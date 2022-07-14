<!DOCTYPE html>
<html>
    <head>
        <title>Double dropdown</title>
        <meta charset="utf-8">
        <script type="text/javascript" src="../jquery.min.js"></script>
        <script type="text/javascript">
            $(function() {
                //Assign an event on change
                $("#first").on("change", function(){
                    //AJAX-request
                    $.ajax({
                        url: "select.php?id=" + $("#first").val()
                    }).done(function(data){
                        $("#second").html(data);
                        $("#second").prop("disabled" , false);
                    });
                });
            });
        </script>
    </head>
    <body>
        <?php 
            //Connection to the DB
            require_once "../connect.php";
            //Primary categories` dropdown
            $query = "SELECT * FROM catalogs 
                    WHERE parent_id=0 AND is_activa=1 
                    ORDER BY position";
            echo "<select id='first'>";
            echo "<option value='0'>Choose category</option>";
            $category = $pdo->query($query);
            $category->execute();
            while($catalog = $category->fetch()) {
                echo "<option value='{$catalog['id']}'>{$catalog['name']}</option>";
            }
            echo "</select>";
        ?>
        <select id="second" disabled="disabled">
            <option value="0">Choose subcategory</option>
        </select>
    </body>
</html>