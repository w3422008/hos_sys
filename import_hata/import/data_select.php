<?php

require_once('../config.php');
require_once('../functions.php');

session_start();

$dbh =get_db_connect();

include_once('./data_select_view.php');
