<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '\Functions.php';
$pageTitle = "Add PC";
session_start();

include 'header.php';

// GET branch

if($_SERVER['REQUEST_METHOD'] === 'GET') {

$_SESSION['ref'] = $_SERVER['HTTP_REFERER'];
$asset = 'EANW-';
$win7 = 1;

include 'PcForm.php';

include 'footer.php';

// End GET

} elseif($_SERVER['REQUEST_METHOD'] === 'POST') {

include 'header.php';

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
    
        
    $sql = "INSERT INTO computers
                (asset_tag, description, location, department, license, condition, has_win7)
                VALUES ('$asset', '$desc', $loc, $dept, $lic, $con, $win7)";
        
    $db = db_connect();
    
    if(sqlsrv_query($db,$sql)){
        db_disconnect();
        ?>
        <script>
            alert("Computer <?php echo $asset; ?> successfully added to the database")
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