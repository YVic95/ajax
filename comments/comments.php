<!DOCTYPE html>
<html lang="en">
    <head>
        <title>AJAX-request using POST method</title>
        <meta charset="utf-8">
        <script type="text/javascript" src="../jquery.min.js"></script>
        <script type="text/javascript">
        //Assign onclick event after document download
        $(document).ready(function() {
            $("#submit-id").on("click", function() {
                if($.trim($("#nickname").val()) === "") {
                    alert('Please fill Author field!');
                    return false;
                }
                if($.trim($("#content").val()) === "") {
                    alert('Please fill Message field!');
                    return false;
                }
                $("#submit-id").prop("disabled", true);
                //AJAX-request
                $.ajax({
                    url: "addComment.php",
                    method: 'post',
                    data: {nickname: $("#nickname").val(),
                           content: $("#content").val()}
                }).done(function(data){
                    //Success request respond
                    $("#info").html(data);
                    $("#submit-id").prop("disabled", false);
                });
            });
        });
        </script>
    </head>
    <body>
        <div id="info">
            <?php require_once "addComment.php"?>
        </div>
        <div id='form'>
            <p>
                <span class='title'>Author:</span>
                <span class='field'>
                    <input id='nickname' type='text'>
                </span>
            </p>
            <p>
                <span class='title'>Message:</span>
                <span class='field'>
                    <textarea rows='5' id='content' type='text'></textarea>
                </span>
            </p>
            <p>
                <span class='title'>&nbsp;</span>
                <span class='field'>
                    <input id='submit-id' type='submit' value="Send!">
                </span>
            </p>
        </div>
    </body>
</html>