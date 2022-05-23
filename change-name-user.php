<?php
session_start(); 
error_reporting(0);
include('link/config.php'); 

if(strlen($_SESSION['alogin'])=="")
    {   
    header("Location: user_login.php"); 
    }
    else{ 
 
if(isset($_POST['submit']))
    {
$uname=$_POST['usname'];
$password=md5($_POST['password']);
$username=$_SESSION["username"];
    $sql ="SELECT password FROM user WHERE user_name=:username and password=:password";
$query= $dbh -> prepare($sql);
$query-> bindParam(':username', $username, PDO::PARAM_STR);
$query-> bindParam(':password', $password, PDO::PARAM_STR);
$query-> execute();
$results = $query -> fetchAll(PDO::FETCH_OBJ);
if($query -> rowCount() > 0)
{
$con="update user set user_name=:uname where user_name=:username";
$chngpwd1 = $dbh->prepare($con);
$chngpwd1-> bindParam(':uname', $uname, PDO::PARAM_STR);
$chngpwd1-> bindParam(':username', $username, PDO::PARAM_STR);
$chngpwd1->execute();
$msg="Your UserName Has succesfully changed";
}
else {
$error="Your Password is wrong or UserName is not available";    
}
} 
?>
<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
    	<meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Disease Prediction System</title>
        <link rel="stylesheet" href="css/bootstrap.min.css" media="screen" >
        <link rel="stylesheet" href="css/font-awesome.min.css" media="screen" >
        <link rel="stylesheet" type="text/css" href="js/DataTables/datatables.min.css"/>
        <link rel="stylesheet" href="css/form-content.css" media="screen" >
        <link rel="stylesheet" href="css/main.css" media="screen" >
        <script src="js/modernizr/modernizr.min.js"></script>
    
        <script type="text/javascript">
function valid()
{
if(document.chngpwd.newpassword.value!= document.chngpwd.confirmpassword.value)
{
alert("New Password and Confirm Password Field do not match  !!");
document.chngpwd.confirmpassword.focus();
return false;
}
return true;
}
</script>
         <style>
        .errorWrap {
    padding: 10px;
    margin: 0 0 20px 0;
    background: #fff;
    border-left: 4px solid #dd3d36;
    -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
    box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
}
.succWrap{
    padding: 10px;
    margin: 0 0 20px 0;
    background: #fff;
    border-left: 4px solid #5cb85c;
    -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
    box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
}
body{
    background-color:white;
}
        </style>
    </head>
    <body class="top-navbar-fixed">
        <div class="main-wrapper">
            <!-- ========== TOP NAVBAR ========== -->

            <?php include('link/user-topber.php');?>   
            <div class="content-wrapper">
                <div class="content-container">
               
 <!-- /.left-sidebar -->

                    <div class="main-page">
                        <div class="container-fluid">
                            <div class="row page-title-div">
                                <div class="col-md-6">
                                    <h2 class="title">Change your Name</h2>
                                </div>
                                
                            </div>
                            <!-- /.row -->
                            <div class="row breadcrumb-div">
                                <div class="col-md-6"> 
                                    <ul class="breadcrumb">
            							<li><a href="user_interface.php"><i class="fa fa-home"></i> Home</a></li>
            						
            							<li class="active">Change Your Name</li>
            						</ul>
                                </div>
                               
                            </div>
                            <!-- /.row -->
                        </div>
                        <!-- /.container-fluid -->

                        <section class="section">
                            <div class="container-fluid">

                             

                              

                                <div class="row">
                                    <div class="col-md-8 col-md-offset-2">
                                        <div class="panel">
                                           
           <?php if($msg){?>
<div class="result-color1" role="alert">
 <strong>Well done!</strong><?php echo htmlentities($msg); ?>
 </div><?php } 
else if($error){?>
    <div class="result-red" role="alert">
                                            <strong>Oh snap!</strong> <?php echo htmlentities($error); ?>
                                        </div>
                                        <?php } ?> 
  
                                            <div class="panel-body">

                                                <form  name="chngpwd" method="post" \ onSubmit="return valid();">
                                                    <div class="form-group has-success">
                                                        <label for="success" class="control-label">Username</label>
                                                		<div class="">
                                    <input type="text" name="usname" class="form-control" required="required" id="success" placeholder="Enter your Name ">
                                                      
                                                		</div>
                                                	</div>
                                                       <div class="form-group has-success">
                                                        <label for="success" class="control-label">Password</label>
                                                        <div class="">
                                                            <input type="password" name="password" required="required" class="form-control" id="success" placeholder="Enter your Password">
                                                        </div>
                                                    </div>
  <div class="form-group has-success">

                                                        <div class="">
                                                           <button type="submit" name="submit" class="result-color1">Change</button>
                                                    </div>


                                                    
                                                </form>

                                              
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.col-md-8 col-md-offset-2 -->
                                </div>
                                <!-- /.row -->

                               
                               

                            </div>
                            <!-- /.container-fluid -->
                        </section>
                        <!-- /.section -->

                    </div>
                    <!-- /.main-page -->

                </div>
                <!-- /.content-container -->
            </div>
            <!-- /.content-wrapper -->

        </div>
        <!-- /.main-wrapper -->

        <!-- ========== COMMON JS FILES ========== -->
        <script src="js/jquery/jquery-2.2.4.min.js"></script>
        <script src="js/jquery-ui/jquery-ui.min.js"></script>
        <script src="js/bootstrap/bootstrap.min.js"></script>
        <script src="js/pace/pace.min.js"></script>
        <script src="js/lobipanel/lobipanel.min.js"></script>
        <script src="js/iscroll/iscroll.js"></script>

        <!-- ========== PAGE JS FILES ========== -->
        <script src="js/prism/prism.js"></script>

        <!-- ========== THEME JS ========== -->
        <script src="js/main.js"></script>



        <!-- ========== ADD custom.js FILE BELOW WITH YOUR CHANGES ========== -->
    </body>
</html>

<?PHP } ?>