<?php 
if(!session_id()) session_start();

require_once "core/App.php";
require_once "core/Config.php";
require_once "core/Controller.php";
require_once "core/Database.php";
require_once "core/Flasher.php";
require_once "core/Request.php";
require_once "core/Middleware.php";
require_once "helpers/functions.php";