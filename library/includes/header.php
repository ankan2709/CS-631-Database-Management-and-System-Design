<div class="navbar navbar-inverse set-radius-zero" >
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" >

                    <img src="assets/img/logo2.png" />
                </a>

            </div>
<?php if($_SESSION['login'])
{
?> 
            <div class="right-div">
                <a href="logout.php" class="btn btn-danger pull-right">QUIT</a>
            </div>
           <!-- <?php }?> -->
        </div>
    </div>
    <!-- LOGO HEADER END-->
<?php if($_SESSION['login'])
{
?>    
<section class="menu-section">
        <div class="container">
            <div class="row ">
                <div class="col-md-12">
                    <div class="navbar-collapse collapse ">
                        <ul id="menu-top" class="nav navbar-nav navbar-right">
                            <li><a href="dashboard.php" class="menu-top-active">DASHBOARD</a></li>
                           
                          
                               <li>
                                <a href="#" class="dropdown-toggle" id="ddlmenuItem" data-toggle="dropdown"> RESERVE <i class="fa fa-angle-down"></i></a>
                                <ul class="dropdown-menu" role="menu" aria-labelledby="ddlmenuItem">
                                    <li role="presentation"><a role="menuitem" tabindex="-1" href="manage-books.php">Document Reserve</a></li>
                                     <li role="presentation"><a role="menuitem" tabindex="-1" href="reserve-book.php">Manage Reservations</a></li>
                                </ul>
                            </li> 
                             <li><a href="compute-fine.php">DOCUMENT CHECKOUT</a></li>
                             <li>
							   <a href="manage-books.php" class="menu-top-active"> Search Documents </a>
							 <!--
                                <a href="#" class="dropdown-toggle" id="ddlmenuItem" data-toggle="dropdown"> Search Documents <i class="fa fa-angle-down"></i></a>
                                <ul class="dropdown-menu" role="menu" aria-labelledby="ddlmenuItem">
                                   <!-- <li role="presentation"><a role="menuitem" tabindex="-1" href="issue-book.php">Issue New Book</a></li>  
                                     <li role="presentation"><a role="menuitem" tabindex="-1" href="manage-issued-books.php">Manage Issued Books</a></li>  
                                     <li role="presentation"><a role="menuitem" tabindex="-1" href="manage-books.php">Search Documents</a></li>									 
                                </ul> -->
                            </li>                         

                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </section>
	
    <?php } else { ?>
        <section class="menu-section">
        <div class="container">
            <div class="row ">
                <div class="col-md-12">
                    <div class="navbar-collapse collapse ">
                        <ul id="menu-top" class="nav navbar-nav navbar-right">                        
                          
  <li><a href="adminlogin.php">Admin Login</a></li>
                            <!-- <li><a href="signup.php">User Signup</a></li> -->
                             <li><a href="index.php">User Login</a></li>
                          

                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </section> 

   <?php } ?> 