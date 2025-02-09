<?php
session_start();
session_destroy();
header("Location: first.html");
exit();
?>