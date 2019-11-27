<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("location:login.php");
    exit;
}

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title>Websocket chat</title>


        <script type="text/javascript">
        var socket;
        var ws = new WebSocket("ws://172.22.1.65:8181");
        socket = ws;

        var init = new Array();
        init[0] = "<?php echo $_SESSION['username'] ?>";
        init[1] = null;
        ws.onopen = function() {
            console.log('Connected');
            socket.send(init);
        };


        ws.onmessage = function(data) {
            var received_msg = data;
            document.getElementById("showMes").value+=data.data+"\n";
        };
        ws.onclose = function() {
            alert("Disconnected");
        };

        function send(){
            var message="<?php echo $_SESSION['username'] ?>"+","+document.getElementById("mes").value;
            socket.send(message);
            document.getElementById("mes").value="";
        }



        </script>

    </head>
    <body  style="text-align:center">
        <a href="./logout.php">Logout</a>

        <h1>Websocket Chat (Beta)</h1>

        <textarea rows="3" cols="30" id="showMes" style="width:300px;height:500px;" readonly>
        </textarea>
        <br/>
        <label>Message</label>
        <input type="text" id="mes"/>
        <button onclick="send();">Send</button>



    </body>
</html>
