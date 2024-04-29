<?php
session_start();
unset($_SESSION['esuroy_captain']);
header('location: ../../index.php');
exit();
