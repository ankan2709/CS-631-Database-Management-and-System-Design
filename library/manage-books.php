<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['login'])==0)
    {   
header('location:index.php');
}
else{ 
if(isset($_GET['res']))
{
$docid=$_GET['res'];

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

$_SESSION['updatemsg']="Document Reserved successfully ";
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
                <h4 class="header-line">Search / Reserve Documents</h4>
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
                           Listing Documents
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>Document ID</th>
                                            <th>Title</th>
                                            <th>Publication Date</th>
                                            <th>Publisher ID</th>
											<th>Publisher Name</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
<?php $sql = "SELECT document.DOCID,document.TITLE,document.PDATE,document.PUBLISHERID,publisher.PUBNAME from document INNER join publisher on document.PUBLISHERID = publisher.PUBLISHERID  ";
//"SELECT documents.DocId,documents.Title,documents.PubDate,documents.PublisherId from documents join publishers on publishers.PubId = documents.PublisherId";
//"SELECT tblbooks.BookName,tblcategory.CategoryName,tblauthors.AuthorName,tblbooks.ISBNNumber,tblbooks.BookPrice,tblbooks.id as bookid from  tblbooks join tblcategory on tblcategory.id=tblbooks.CatId join tblauthors on tblauthors.id=tblbooks.AuthorId";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{               ?>                                      
                                        <tr class="odd gradeX">
                                            <td class="center"><?php echo htmlentities($result->DOCID);?></td>
                                            <td class="center"><?php echo htmlentities($result->TITLE);?></td>
                                            <td class="center"><?php echo htmlentities($result->PDATE);?></td>
                                            <td class="center"><?php echo htmlentities($result->PUBLISHERID);?></td>
											<td class="center"><?php echo htmlentities($result->PUBNAME);?></td>
                                            <td class="center">
                                         <a href="manage-books.php?res=<?php echo htmlentities($result->DOCID);?>" onclick="return confirm('Are you sure you want to reserve?');" >  <button class="btn btn-primary"> Reserve</button> 
                                            </td> 
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
