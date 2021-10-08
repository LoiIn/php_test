<?php
    session_start();
    $message="";
    if(count($_POST)>0) {
         // Include file config.php
         require_once "config.php";
                    
         // Cố gắng thực thi truy vấn
        $rs = $mysqli->query("SELECT * FROM employees WHERE name='" . $_POST["user_name"] . "' and password = '". $_POST["password"]."'");
        if($rs->num_rows > 0) {
            $row = $rs->fetch_assoc();
            $_SESSION["id"] = $row['id'];
            $_SESSION["name"] = $row['name'];
            $rs->close();
        } else {
         $message = "Invalid Username or Password!";
        }
    }
    if(isset($_SESSION["id"])) {
    header("Location:index.php");
    }
?>
<html>
<head>
<title>User Login</title>
</head>
<body>
<form name="frmUser" method="post" action="" align="center">
<div class="message"><?php if($message!="") { echo $message; } ?></div>
<h3 align="center">Enter Login Details</h3>
 Username:<br>
 <input type="text" name="user_name">
 <br>
 Password:<br>
<input type="password" name="password">
<br><br>
<input type="submit" name="submit" value="Submit">
<input type="reset">
</form>
</body>
</html>