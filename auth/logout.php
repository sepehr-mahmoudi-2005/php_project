<?php
session_start();

require_once '../autoload.php';

session_destroy();

redirect('auth/login.php');