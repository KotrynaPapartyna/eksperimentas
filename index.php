<?php
include('config.php');?>

<html>
<title>Prepared Statement</title>
<body>
<h3>Fetch, Edit and Delete Data from Database using PHP Preopared Statement</h3>
<table border="1">
<tr>
<td><b>Sn.</b></td>
<td><b>Name</b></td>
<td><b>Contact no.</b></td>
<td><b>Email-id :</b></td>
<td><b>Adress</b></td>
<td><b>Reg Date</b></td>
<td><b>Action</b></td>
</tr>

<?php
    if(isset($_GET['del']))
    {
        $id=intval($_GET['del']);
        $adn="delete from user where id=?";
        $stmt= $mysqli->prepare($adn);
        $stmt->bind_param($id);
        $rs=$stmt->execute();
        if($rs==true)
        {
        echo "<script>alert('User has been successfully Deleted');</script>";
        header('location:index.php');
        }
    }

?>

<?php //code for read data from Database
	$ret = "select * from user";
	$stmt2 = $mysqli->prepare($ret);
	$stmt2->execute();
	 $res=$stmt2->get_result();
	 $cnt=1;
	   while($row=$res->fetch_object())
	  {
?>
<tr>
<td><?php echo $cnt;?></td>
<td><?php echo $row->name;?></td>
<td><?php echo $row->email;?></td>
<td><?php echo $row->contactno;?></td>
<td><?php echo $row->addrss;?></td>
<td><?php echo $row->posting_date;?></td>
<td><a href="edit.php?id=<?php echo $row->id;?>">Edit</a> |<a href="index.php?del=<?php echo $row->id;?>"> Delete</a></td>
</tr>
<?php $cnt=$cnt+1; } ?>
</table>
</body>
</html>