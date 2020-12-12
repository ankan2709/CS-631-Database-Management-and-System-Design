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
        $id=$_GET['del'];
        $sql = "delete from tblbooks  WHERE id=:id";
        $query = $dbh->prepare($sql);
        $query -> bindParam(':id',$id, PDO::PARAM_STR);
        $query -> execute();
        $_SESSION['delmsg']="Category deleted scuccessfully ";
        header('location:manage-books.php');
    }
    if(isset($_GET['return']))
    {
        $sql = "update borrowing set RDTIME=sysdate() where borrowing.BOR_NO=".$_GET['return'];
        $query = $dbh->prepare($sql);
        $query -> execute();
       
    }

    ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Online Library Management System | Manage Issued Books</title>
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
                <h4 class="header-line">Document Checkout</h4>
    </div>
    

            <div class="row">
                <div class="col-md-12">
                    <!-- Advanced Tables -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                          Issued Books 
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>Borrow ID</th>
                                            
                                            <th>Doc ID</th>
                                            <th>Copy No </th>
											<th>Lib ID </th>
                                            <th>Borrowed Date</th>
                                            <th>Return Date</th>
                                            <th>Fine (USD)</th>
                                        </tr>
                                    </thead>
                                    <tbody>
<?php 
$sid=$_SESSION['login'];
$sql = "SELECT * FROM BORROWS B, BORROWING G WHERE B.BOR_NO=G.BOR_NO AND RID=:sid";
//$sql="SELECT tblbooks.BookName,tblbooks.ISBNNumber,tblissuedbookdetails.IssuesDate,tblissuedbookdetails.ReturnDate,tblissuedbookdetails.id as rid,tblissuedbookdetails.fine from  tblissuedbookdetails join tblstudents on tblstudents.StudentId=tblissuedbookdetails.StudentId join tblbooks on tblbooks.id=tblissuedbookdetails.BookId where tblstudents.StudentId=:sid order by tblissuedbookdetails.id desc";
$query = $dbh -> prepare($sql);
$query-> bindParam(':sid', $sid, PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;



if($query->rowCount() > 0)
{
foreach($results as $result)
{

              ?>                                      
                                        <tr class="odd gradeX">
                                            <td class="center"><?php echo htmlentities($result->BOR_NO);?></td>
                                         
                                            <td class="center"><?php echo htmlentities($result->DOCID);?></td>
                                            <td class="center"><?php echo htmlentities($result->COPYNO);?></td>
											<td class="center"><?php echo htmlentities($result->BID);?></td>
                                            <td class="center"><?php echo htmlentities($result->BDTIME);?></td>
                                           
                                            <td class="center"><?php if($result->RDTIME=="")
                                            {?>
                                            <span style="color:red">
                                             <?php
                                                $now = time(); 
                                                $borrow_time = strtotime($result->BDTIME);
                                                $datediff = $now - $borrow_time;
                                                $fine=0.2*round($datediff / (60 * 60 * 24));
                                                echo "<a href=compute-fine.php?return=".$result->BOR_NO.">Return Document</a>";   ?>
                                            </span>
                                            <?php } else {
                                            echo htmlentities($result->RDTIME); $fine = 0;
                                        }
                                            ?></td>
                                              <td class="center"><?php echo htmlentities($fine);?></td>
                                         
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
