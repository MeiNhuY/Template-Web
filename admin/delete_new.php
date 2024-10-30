<?php
include('../connectdb7.php');
$sl="delete from theloai where idTL=".$_GET['idTL'];
//if(mysql_query($sl))
if(mysqli_query($connect,$sl))
{
echo "<script language='javascript'>alert('Xoa thanh cong');";
echo "location.href='index_new.php';</script>";
}
?>


