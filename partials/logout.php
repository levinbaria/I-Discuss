<?php
session_start();
echo "You are about to logged out";
session_destroy();
header("location: /idiscuss");
?>