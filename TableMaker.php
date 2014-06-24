<?php

echo '<h1>' . $pageTitle . '</h1>';

$tableParams = makeArrayFromTable($table);
$sort = isset($_GET['sort']) ? $_GET['sort'] : 'asset_tag';
$dir = isset($_GET['dir']) ? $_GET['dir'] : 'ASC';
$dirFlip = $dir == 'ASC' ? 'DESC' : 'ASC';


foreach($tableParams as $id => $name) {
    if(array_key_exists($id,$total) ) {
    ?>
    <a style="padding-top:50px" id="<?php echo $name ?>"></a>
    <h2><?php echo ucfirst($name) ?></h2>
    <?php
        $link = '<p>Jump to: ';
        foreach($tableParams as $val) {
            $link .= $val != $name ? '<a href="#'.$val.'">' . $val . '</a> | ' : '';
        }
        $link = substr_replace($link, '</p>', -3, 3);
        echo $link;
    ?>
    <table class="table table-bordered">
    <tr>
        <th>&nbsp;</th>
        <th><a href="<?php echo $_SERVER['SCRIPT_NAME'] ?>?sort=asset_tag&dir=<?php echo $dirFlip; ?>">Asset Tag</a></th>
        <th><a href="<?php echo $_SERVER['SCRIPT_NAME'] ?>?sort=description&dir=<?php echo $dirFlip; ?>">Description</a></th>
        <th><a href="<?php echo $_SERVER['SCRIPT_NAME'] ?>?sort=location&dir=<?php echo $dirFlip; ?>">Location</a></th>
        <th><a href="<?php echo $_SERVER['SCRIPT_NAME'] ?>?sort=department&dir=<?php echo $dirFlip; ?>">Department</a></th>
        <th><a href="<?php echo $_SERVER['SCRIPT_NAME'] ?>?sort=license&dir=<?php echo $dirFlip; ?>">License</a></th>
        <th>Sharepoint</th>
    </tr>

    <?php
    
$pcSql = "SELECT c.id as 'ID',
                 c.asset_tag as 'Asset',
                 c.description as 'Description',
                 d.name as 'Department',
                 l.abbreviation as 'Location',
                 lic.name as 'License',
                 con.name as 'Condition'
            FROM Computers c
           INNER JOIN Departments d
              ON c.department = d.id
           INNER JOIN Locations l
              ON c.location = l.id
           INNER JOIN Licenses lic
              ON c.license = lic.id
		   INNER JOIN Conditions con
		      ON con.id = c.condition
           WHERE $column = '$id'
                 $whereClause
        ORDER BY $sort $dir";

$db = db_connect();
    if(!$result = sqlsrv_query($db, $pcSql)){
        die('Query Problems with Computers query');
    }
db_disconnect();

while($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {

    
    ?>
    
    <tr>
        <td><a href="/EditPC.php?pc=<?php echo $row['ID']; ?>">Edit</a></td>
        <td><?php echo $row['Asset']; ?></td>
        <td><?php echo $row['Description']; ?></td>
        <td><?php echo $row['Location']; ?></td>
        <td><?php echo $row['Department']; ?></td>
        <td><?php echo $row['License']; ?></td>
        <td><a href="http://sharepoint/sites/IT/PCs/<?php echo $row['Asset']; ?>.docx">Sharepoint</a></td>
    </tr>
    <?php    
    }
        
    ?>
    </table>
    <h4>Count: <?php echo $total[$id]; ?></h4>
    <p><a href="http://eanwit">Return to Main page</a></p>
    <?php
    }
    }
?>