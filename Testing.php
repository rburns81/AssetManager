<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '\HTML.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '\Helpers.php';

echo $header;

echo '<h2>Nothing here right now.  Move along.</h2>';
echo '<p><a href="index.php">Return to Main Page</a></p>';

if($_SERVER['REQUEST_METHOD'] == 'GET') {
    echo '<form action="' . $_SERVER['SCRIPT_NAME'] . '" method="POST">';
    echo '<fieldset><legend>String Manipulation</legend>';
    echo '<p><input type="text" name="string" /></p>';
    echo '<p><input type="submit" value="Submit" /></p>';
    echo '</fieldset></form>';
} elseif($_SERVER['REQUEST_METHOD'] == 'POST') {
    $string = $_POST['string'];
    echo '<p><strong>String before adding underscores:</strong></p>';
    echo '<p>' . $string . '</p>';
    echo '<p><strong>String after adding underscores:</strong></p>';
    echo '<p>' . str_replace(' ','_',$string) . '</p>';
    echo '<p><a href="testing.php">Return to start</a></p>';
}

echo $footer;
?>