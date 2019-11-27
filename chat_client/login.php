<?php
session_start();

if (isset($_POST['submit'])) {
    if ($_POST['username'] == "user" && $_POST['password'] == "pass") {
        $_SESSION['username'] = $_POST["username"];
        header("location:index.php");
        exit;
    } elseif ($_POST['username'] == "user2" && $_POST['password'] == "pass") {
        $_SESSION['username'] = $_POST["username"];
        header("location:index.php");
        exit;
    } else {
        $msg = "<span style='color:red'>Invalid Login Details</span>";
    }
}

 ?>



<form class="" action="login.php" method="post">

<table>
    <?php if (isset($msg)) {?>
    <tr>
        <td colspan="2" align="center"><?php echo $msg;?></td>
    </tr>
    <?php } ?>
    <tr>
        <td>Name</td>
        <td>
            <input type="text" name="username" value="">
        </td>
    </tr>
    <tr>
        <td>password</td>
        <td>
            <input type="password" name="password" value="">
        </td>
    </tr>
    <tr>
        <td colspan="2">
            <input type="submit" name="submit" value="Login">
        </td>
    </tr>

</table>

</form>
