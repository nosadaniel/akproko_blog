<?php

define('DOC_ROOT', $_SERVER['DOCUMENT_ROOT']."/akproko/");
define('INCLUDES', DOC_ROOT . "includes/"); // to access includes folder
define('MYSQL_DIR', DOC_ROOT . "/mysql/"); //to access mysql folder
define('MODELS', DOC_ROOT. "mysql/models/"); // to access models folder
require_once MYSQL_DIR.'db.php';

?>