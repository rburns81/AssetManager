<?php
$pageTitle = 'EANW Computer Database';
include 'Header.php';
?>
<h1><?php echo $pageTitle; ?></h1>

<h3>Windows 7 Upgrades</h3>
<ul>
    <li><a href="win7upgrades.php">View PCs sorted by Location</a></li>
</ul>

<h3>General Tasks</h3>
<ul>
    <li><a href="AddPC.php">Add PCs</a></li>
    <li><a href="EditPC.php">Edit PCs</a></li>
</ul>

<h3>PC Lists</h3>
<ul> 
    <li><a href="AllPcs.php">List of All EANW Computers</a></li>
    <li><a href="Testing.php">Testing Page</a></li>
</ul>

<?php
include 'footer.php';
?>