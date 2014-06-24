<?php

// Start GET

require_once $_SERVER['DOCUMENT_ROOT'] . '\Functions.php';
$pageTitle = "Edit PC";

session_start();
include 'header.php';

if($_SERVER['REQUEST_METHOD'] === 'GET') {
$_SESSION['ref'] = $_SERVER['HTTP_REFERER'];

if(isset($_GET['pc'])) {
    $pc = $_GET['pc'];
} else {
    die('<h1>Sorry, but this page is only accessible 
        by clicking the "Edit" link on one of the PC lists</h1>');
}

$sql =  "SELECT  id,
                 asset_tag as 'Asset',
                 description,
                 has_win7 as 'Win7',
                 department,
                 location,
                 license,
                 condition
            FROM Computers
           WHERE id = $pc";
           
$db = db_connect();
    if(!$result = sqlsrv_query($db,$sql)) {
        die("There was an error running the query");
    }
db_disconnect();
while($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
        $id =           $row['id'];
        $asset =        $row['Asset'];
        $description =  $row['description'];
        $location =     $row['location'];
        $department =   $row['department'];
        $license =      $row['license'];
        $condition =    $row['condition'];
        $win7 =         $row['Win7'];
    }

include 'PcForm.php';

include 'footer.php';


// End GET

} elseif($_SERVER['REQUEST_METHOD'] === 'POST') {

    $ref = $_SESSION['ref'];
    session_destroy();
    
    // Validate input
    InputValidate($_POST['asset'],'Asset Tag');
    InputValidate($_POST['desc'],'Description');
    InputValidate($_POST['loc'],'Location');
    InputValidate($_POST['dept'],'Department');
    InputValidate($_POST['lic'],'Windows License');
    InputValidate($_POST['con'], 'Condition');
    InputValidate($_POST['haswin7'],'Windows 7 Installed');
        
    // Prep data for DB entry
    
    $asset = strtoupper($_POST['asset']);
    $desc = htmlspecialchars($_POST['desc'], ENT_QUOTES);
    $loc =  $_POST['loc'];
    $dept = $_POST['dept'];
    $lic =  $_POST['lic'];
    $con = $_POST['con'];
    $win7 = $_POST['haswin7'];
    $id = $_POST['id'];
        
    $sql = "UPDATE Computers
               SET asset_tag = '$asset',
                   description = '$desc',
                   location = $loc,
                   department = $dept,
                   license = $lic,
                   condition = $con,
                   has_win7 = $win7
             WHERE id = $id";

    $db = db_connect();
    
    if(sqlsrv_query($db,$sql)){
        db_disconnect();
        ?>
        <script>
            alert("Computer <?php echo $asset; ?> has been updated in the database")
            window.location = "<?php echo $ref; ?>"
        </script>
        <?php
    } else {
        db_disconnect();
        include 'header.php';
        echo '<h2>Your query could not be processed by the database</h2>';
        echo '<pre>';
        echo $sql . '<br />';
        die(print_r(sqlsrv_errors(),true));
        include 'footer.php';
    }

include 'footer.php';

}
?>