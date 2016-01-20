<?php

session_start();

$_SESSION["count"]++;

session_destroy();

print_r($_SESSION);

