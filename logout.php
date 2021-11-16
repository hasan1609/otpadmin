<?php

session_start();
unset($_SESSION['username_admin']);
unset($_SESSION['role']);

header("Location: index.php");
