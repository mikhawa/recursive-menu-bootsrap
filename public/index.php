<?php
// front controller


// dependencies
require_once "../config.php";
require_once "../model/connectMysqliModel.php";

// DB connection
$db = connectMysqliModel();

// controller
require_once "../controller/publicController.php";
