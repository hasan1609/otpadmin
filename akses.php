<?php
if ($_SESSION['role'] == "") {
    header("location: ../index.php");
}
