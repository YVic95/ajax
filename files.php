<?php
    if(!empty($_FILES)) {
        echo "<pre>";
        print_r($_FILES);
        echo "</pre>";
        exit();
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <title>
            Form to upload files
        </title>
        <meta charset="utf-8">
        <script type="text/javascript" src="jquery.min.js"></script>
        <script type="text/javascript">
            $(function() {
                $(document).on("click", "input[type='button'][value!='+']", remove_field);
                $(document).on("click", "input[type='button'][value!='-']", add_field);
            });
            function add_field() {
                $("p:last").clone().insertAfter("p:last");
            }
            function remove_field() {
                console.log($(this));
                $("p:last").remove();
            }
        </script>
    </head>
    <body>
        <form enctype="multipart/form-data" method="POST">
        <p>
            <input type="file" name="filename[]">
            <input type="button" value="+">
            <input type="button" value="-">
        </p>
        <div>
            <input type="submit" value="Upload!">
        </div>
        </form>
    </body>
</html>