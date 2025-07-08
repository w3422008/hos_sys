<?php

require_once('../../config.php');
require_once('../../functions.php');

session_start();

$dbh = get_db_connect();

$trainingB_year = get_trainingB_year($dbh);

if(empty($trainingB_year)){
    $trainingB_year = 'データなし';
}

include_once('file_select_view.php');