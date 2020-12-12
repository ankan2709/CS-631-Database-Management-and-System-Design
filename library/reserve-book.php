<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['login'])==0)
    {   
header('location:index.php');
}
else{ 
if(isset($_GET['del']))
{

$docid=$_GET['del'];

// $count_my_page = ("reserveid.txt");
// $hits = file($count_my_page);
// $hits[0] ++;
// $fp = fopen($count_my_page , "w");
// fputs($fp , "$hits[0]");
// fclose($fp); 
// $id= $hits[0]; 
$sql="INSERT INTO reservation(DTIME) VALUES(sysdate())";
$query = $dbh->prepare($sql);
$query -> execute();
$res_id=$dbh->lastInsertId();

$sql="SELECT COPYNO,BID FROM COPY WHERE DOCID=:docid";
$query = $dbh->prepare($sql);
$query -> bindParam(':docid',$docid, PDO::PARAM_STR);
$query -> execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$copy = 0;
$bid = 0;
foreach($results as $result)
{
    $copy = $result->COPYNO;
    $bid = $result->BID;
}
echo $res_id;
$sql="INSERT INTO reserves(RESERVATION_NO,RID,DOCID,COPYNO,BID) VALUES(:id,:rid,:docid,:copyd,:bid)";

$query = $dbh->prepare($sql);
$query -> bindParam(':id',$res_id, PDO::PARAM_STR);
$query -> bindParam(':docid',$docid, PDO::PARAM_STR);
$query -> bindParam(':rid',$_SESSION['login'], PDO::PARAM_STR);
$query -> bindParam(':copyd',$copy, PDO::PARAM_STR);
$query -> bindParam(':bid',$bid, PDO::PARAM_STR);
$query -> execute();

$_SESSION['updatemsg']="Document Reserved scuccessfully ";
header('location:reserve-book.php');
}
    ?>


<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Online Library Management System | Manage Books</title>
    <!-- BOOTSTRAP CORE STYLE  -->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FONT AWESOME STYLE  -->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <!-- DATATABLE STYLE  -->
    <link href="assets/js/dataTables/dataTables.bootstrap.css" rel="stylesheet" />
    <!-- CUSTOM STYLE  -->
    <link href="assets/css/style.css" rel="stylesheet" />
    <!-- GOOGLE FONT -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />

</head>
<body>
      <!------MENU SECTION START-->
<?php include('includes/header.php');?>
<!-- MENU SECTION END-->
    <div class="content-wrapper">
         <div class="container">
        <div class="row pad-botm">
            <div class="col-md-12">
                <h4 class="header-line">RESERVATION LIST</h4>
    </div>
     <div class="row">
    <?php if($_SESSION['error']!="")
    {?>
<div class="col-md-6">
<div class="alert alert-danger" >
 <strong>Error :</strong> 
 <?php echo htmlentities($_SESSION['error']);?>
<?php echo htmlentities($_SESSION['error']="");?>
</div>
</div>
<?php } ?>
<?php if($_SESSION['msg']!="")
{?>
<div class="col-md-6">
<div class="alert alert-success" >
 <strong>Success :</strong> 
 <?php echo htmlentities($_SESSION['msg']);?>
<?php echo htmlentities($_SESSION['msg']="");?>
</div>
</div>
<?php } ?>
<?php if($_SESSION['updatemsg']!="")
{?>
<div class="col-md-6">
<div class="alert alert-success" >
 <strong>Success :</strong> 
 <?php echo htmlentities($_SESSION['updatemsg']);?>
<?php echo htmlentities($_SESSION['updatemsg']="");?>
</div>
</div>
<?php } ?>


   <?php if($_SESSION['delmsg']!="")
    {?>
<div class="col-md-6">
<div class="alert alert-success" >
 <strong>Success :</strong> 
 <?php echo htmlentities($_SESSION['delmsg']);?>
<?php echo htmlentities($_SESSION['delmsg']="");?>
</div>
</div>
<?php } ?>

</div>


        </div>
            <div class="row">
                <div class="col-md-12">
                    <!-- Advanced Tables -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                           Listing Reservations
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>Reserve ID</th>
                                            <th>Reserve Date</th>
                                            <th>Reader ID</th>
                                            <th>Document ID</th>
											<th>Copy No</th>
                                            <th>Lib ID</th>
                                        </tr>
                                    </thead>
                                    <tbody>
<?php 
$sid=$_SESSION['login'];
$sql = "SELECT N.RES_NO,N.DTIME,R.RID,R.DOCID,R.COPYNO,R.BID from RESERVES R, RESERVATION N WHERE R.RESERVATION_NO=N.RES_NO AND R.RID =:sid";
//"SELECT documents.DocId,documents.Title,documents.PubDate,documents.PublisherId from documents join publishers on publishers.PubId = documents.PublisherId";
//"SELECT tblbooks.BookName,tblcategory.CategoryName,tblauthors.AuthorName,tblbooks.ISBNNumber,tblbooks.BookPrice,tblbooks.id as bookid from  tblbooks join tblcategory on tblcategory.id=tblbooks.CatId join tblauthors on tblauthors.id=tblbooks.AuthorId";
$query = $dbh -> prepare($sql);
$query -> bindParam(':sid',$_SESSION['login'], PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{               ?>                                      
                                        <tr class="odd gradeX">
                                            <td class="center"><?php echo htmlentities($result->RES_NO);?></td>
                                            <td class="center"><?php echo htmlentities($result->DTIME);?></td>
                                            <td class="center"><?php echo htmlentities($result->RID);?></td>
                                            <td class="center"><?php echo htmlentities($result->DOCID);?></td>
											<td class="center"><?php echo htmlentities($result->COPYNO);?></td>
											<td class="center"><?php echo htmlentities($result->BID);?></td>
                                        </tr>
 <?php $cnt=$cnt+1;}} ?>                                      
                                    </tbody>
                                </table>
                            </div>
                            
                        </div>
                    </div>
                    <!--End Advanced Tables -->
                </div>
            </div>


            
    </div>
    </div>

     <!-- CONTENT-WRAPPER SECTION END-->
  <?php include('includes/footer.php');?>
      <!-- FOOTER SECTION END-->
    <!-- JAVASCRIPT FILES PLACED AT THE BOTTOM TO REDUCE THE LOADING TIME  -->
    <!-- CORE JQUERY  -->
    <script src="assets/js/jquery-1.10.2.js"></script>
    <!-- BOOTSTRAP SCRIPTS  -->
    <script src="assets/js/bootstrap.js"></script>
    <!-- DATATABLE SCRIPTS  -->
    <script src="assets/js/dataTables/jquery.dataTables.js"></script>
    <script src="assets/js/dataTables/dataTables.bootstrap.js"></script>
      <!-- CUSTOM SCRIPTS  -->
    <script src="assets/js/custom.js"></script>
</body>
</html>
<?php } ?>
