<?php
session_start();
// if(!isset($_SESSION['email'])){

//     header("Location: ../index.php");
//     }
$expertName =  $_SESSION['name'];
  $db = new mysqli('localhost','root','','agric');
     


?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Community | Dashboard </title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="../vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../vendor/animsition/css/animsition.min.css">
	<link rel="stylesheet" type="text/css" href="../css/style.css">
    <link rel="stylesheet" type="text/css" href="../vendor/Jquery-ui/jquery-ui.min.css">
<!--===============================================================================================-->
</head>
    <body>
    <div class="wrapper">
        <!-- Sidebar  -->
     <?php  include_once ('page-headers.php'); ?>
            <hr>
            <div class="card">
            <p class="card-header sammac-media">Query </p>    
            <div class="card-body">
              <div id="tabs-4">
              	<!-- /////////// -->

                <?php 
                if(isset($_GET['id'])){

                    $id = $_GET['id'];
        $get = mysqli_query($db, "SELECT * FROM `queries` WHERE `id` = '$id' ;");


       $get_comments = mysqli_query($db, "SELECT * FROM `comments` WHERE `qid` = '$id' ;");

       $count_comments = mysqli_num_rows($get_comments);
                 if(mysqli_num_rows($get) == 0){  ?>
                  <div class="alert alert-warning  animated shake" > No Query Found</div>

                <?php }
                else{ 
                 
             
                     while($row=mysqli_fetch_array($get))
                        {
                          
                          ?>
                          <table class="table table-bordered">
                          <tr>
                           
                            <td><b>Posted By:</b><?php echo $row['name'];?></td> 
                            <td><b>Subject</b> <?php echo $row['title'];?></td>  
                            </tr>
                            <tr>

                            <td colspan="2"><b>Description:</b> <?php echo $row['description'];?></td>
                           </tr> 
                             
                          </table> <hr>
                          <h5>Comments by Experts</h5> <br>
                          <?php if($count_comments == 0 ){ 
                            echo 'No Comments Found';

                          } else{?>

                           <table class="table table-bordered">
                            <?php 
                            while($comments = mysqli_fetch_assoc($get_comments)){
                            ?>
                            <tr>
                           
                            <td><b><?php echo $comments['expert'];?></b></td> 
                            <td> <?php echo $comments['details'];?></td>  
                            </tr>
                            <?php } ?>
                            
                             
                          </table>
                          <?php }
                       
                            
                      } } ?> 
                      <form method="post" action="query.php?id=<?php echo $id; ?>" >
                      <table class="table">
                          <tr>
                              <td><input type="hidden" name="qid" value="<?php echo $id; ?>">
                                <input type="hidden" name="expert" value="<?php echo $expertName ?>">
                                <textarea name="details" class="form-control"></textarea>
                              </td>
                              <td> <br><input type="submit" name="comment" value="Comment Now" class="btn btn-info"></td>
                          </tr>
                      </table>
                      </form>
                      <?php
                      if(isset($_POST['comment'])){
                        $qid = trim($_POST['qid']);
                        $name = trim($_POST['expert']);
                        $details = trim($_POST['details']);

                        $insert = mysqli_query($db, "INSERT INTO `comments` ( `qid`, `expert`, `details`) VALUES ('$qid', '$name', '$details');");
                        if(!$insert){ ?>
                            <script type="text/javascript">
                                alert("Unknown Error Occured! Try Again later");
                            </script>

                        <?php }

                      }
                       ?>



                  <?php }?>
                  
                  <hr>





               </div> <!-- // tabs -->
            </div>
            </div> 

             <div class="line"></div>
                <footer>
           
            </footer>
           <div class="line"></div> 
        
        </div>
    </div>
  
       
	
<!--===============================================================================================-->
	<script src="../vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="../vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="../vendor/bootstrap/js/popper.js"></script>
	<script src="../vendor/bootstrap/js/bootstrap.min.js"></script>
	<script src="../js/main.js"></script>
    <script src="../vendor/Jquery-ui/jquery-ui.min.js"></script>
   
</body>
</html>