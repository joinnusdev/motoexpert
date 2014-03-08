<?php
session_start();

if(strtolower($_REQUEST['security_code']) == $_SESSION['security_code']) echo 'true';
 else 'false';
?>