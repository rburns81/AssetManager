<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '\Helpers.php';

// Header stuff
$pageTitle = 'All EANW PCs';
include 'Header.php';

// Define breakdown of tables using computer
// $property = column name from Computer table
// $table = table name, which should be the plural version of the property

$column = '';
$table = $column . 's';

// Define additional where clauses, if necessary
// start with AND

$whereClause = '';

// Define sorting direction

$sort = isset($_GET['sort']) ? $_GET['sort'] : 'asset_tag';
$dir = isset($_GET['dir']) ? $_GET['dir'] : 'ASC';
$dirFlip = $dir == 'ASC' ? 'DESC' : 'ASC';

include 'TableMaker.php';

include 'footer.php';
?>