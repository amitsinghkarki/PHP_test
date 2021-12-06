<?php
if (isset($_SESSION['login']) && $_SESSION['login'] == 'admin') {

} else {
    header("Location: adminlogin.php");

}
