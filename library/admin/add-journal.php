<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
    {   
header('location:index.php');
}
else{ 

if(isset($_POST['add']))
{
$count_my_page = ("documentid.txt");
$hits = file($count_my_page);
$hits[0] ++;
$fp = fopen($count_my_page , "w");
fputs($fp , "$hits[0]");
fclose($fp); 
$DocId= $hits[0];
$title=$_POST['title'];
$editorid=$_POST['editorid'];
$volno=$_POST['volno'];
$issueno=$_POST['issueno'];
$scope=$_POST['scope'];
$pdate=$_POST['pdate'];
$pubid=$_POST['pubid'];
$libid=$_POST['bid'];
$guesteditor=$_POST['pid'];
//$copies=$_POST['copies'];

echo "1 ".$doc_id;
$sql="INSERT INTO document(Title,PDate,PublisherId) VALUES(:title,:pdate,:pubid)";
$query = $dbh->prepare($sql);

$query->bindParam(':title',$title,PDO::PARAM_STR);
$query->bindParam(':pdate',$pdate,PDO::PARAM_STR);
$query->bindParam(':pubid',$pubid,PDO::PARAM_STR);
$query->execute();

$doc_id=$dbh->lastInsertId();
echo "2 ".$doc_id;
$sql="INSERT INTO journal_volume(DOCID,VOLUME_NO,EDITOR) VALUES(:DocId,:volno,:editorid)";
$query = $dbh->prepare($sql);
$query->bindParam(':DocId',$doc_id,PDO::PARAM_STR);
$query->bindParam(':volno',$volno,PDO::PARAM_STR);
$query->bindParam(':editorid',$editorid,PDO::PARAM_STR);
$query->execute();

$sql="INSERT INTO journal_issue(DOCID,ISSUE_NO,SCOPE) VALUES(:DocId,:issueno,:scope)";
$query = $dbh->prepare($sql);
$query->bindParam(':DocId',$doc_id,PDO::PARAM_STR);
$query->bindParam(':issueno',$issueno,PDO::PARAM_STR);
$query->bindParam(':scope',$scope,PDO::PARAM_STR);
$query->execute();
echo "3 ".$doc_id;



$lastInsertId = $dbh->lastInsertId();
if($lastInsertId)
{
$_SESSION['msg']="Journal Listed successfully";
header('location:manage-books.php');
}
else 
{

header('location:manage-books.php');
}

}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Online Library Management System | Add JOURNAL</title>
    <!-- BOOTSTRAP CORE STYLE  -->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FONT AWESOME STYLE  -->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
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
                <h4 class="header-line">Add JOURNAL</h4>
                
                            </div>

</div>

<div class="row">
<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3"">
<div class="panel panel-info">
<div class="panel-heading">
Journal
</div>

<div class="panel-body">
<form role="form" method="post">
<div class="form-group">
<label>Journal Name<span style="color:red;">*</span></label>
<input class="form-control" type="text" name="title" autocomplete="off"  required />
</div>


<div class="form-group">
<label>Chief Editor<span style="color:red;">*</span></label>
<input class="form-control" type="text" name="editorid" autocomplete="off"  required />
</select>
</div>

<div class="panel-body">
<form role="form" method="post">
<div class="form-group">
<label>Volume Number<span style="color:red;">*</span></label>
<input class="form-control" type="text" name="volno" autocomplete="off"  required />
</div>



<div class="form-group">
<label>Issue Number<span style="color:red;">*</span></label>
<input class="form-control" type="text" name="issueno" autocomplete="off"  required />
</div>


<div class="form-group">
<label>Scope<span style="color:red;">*</span></label>
<input class="form-control" type="text" name="scope" autocomplete="off" />
</div>

<div class="form-group">
<label>Guest Editor<span style="color:red;">*</span></label>
<input class="form-control" name="guesteditor" required="required">
</div>


<div class="form-group">
<label>Publication Date<span style="color:red;">*</span></label>
<input class="form-control" type="date" name="pdate" autocomplete="off"  required />
</div>

<div class="form-group">
<label> Publisher<span style="color:red;">*</span></label>
<input class="form-control" name="pubid" required="required">
</div>

<div class="form-group">
<label> Library<span style="color:red;">*</span></label>
<input class="form-control" name="bid" required="required">
</div>
<!--
<div class="panel-body">
<form role="form" method="post">
<div class="form-group">
<label>Number of copies<span style="color:red;">*</span></label>
<input class="form-control" type="integer" name="copies" autocomplete="off"  required />
</div>
-->
<button type="submit" name="add" class="btn btn-info">Add </button>

                                    </form>
                            </div>
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
      <!-- CUSTOM SCRIPTS  -->
    <script src="assets/js/custom.js"></script>
</body>
</html>
<?php } ?>
