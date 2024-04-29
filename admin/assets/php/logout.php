<?php
session_start();
unset($_SESSION['esuroy_admin']);
header('location: ../../index.php');
exit();
