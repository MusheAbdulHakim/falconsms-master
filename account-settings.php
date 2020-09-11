<?php
    session_start();
    error_reporting(0);
    include_once("includes/config.php");
    if(isset($_POST['submit'])){
       $firstname = htmlspecialchars($_POST['firstname']);
       $lastname = htmlspecialchars($_POST['lastname']);
       $gender = htmlspecialchars($_POST['gender']);
       $birth = htmlspecialchars($_POST['date_of_birth']);
       $email = htmlspecialchars($_POST['email']);
       $telephone = htmlspecialchars($_POST['phone']);
       $address = htmlspecialchars($_POST['address']);
       $password = password_hash(htmlspecialchars($_POST['password']),PASSWORD_DEFAULT);
       $propic=$_FILES["propic"]["name"];
       $extension = substr($propic,strlen($propic)-4,strlen($propic));
       $allowed_extensions = array(".jpg","jpeg",".png",".gif");
       if(!in_array($extension,$allowed_extensions)){
            echo "<script>alert('Profile Pics has Invalid format. Only jpg / jpeg/ png /gif format allowed');</script>";
        }
        else{
            $propic=md5($propic).time().$extension;
            $sql="INSERT into admin(FirstName,LastName,Gender,Date_Of_Birth,Email,Phone,Address,Password,Picture)
            values(:fname,:lname,:gender,:dob,:email,:phone,:address,:password,:pic)";
            $query=$dbh->prepare($sql);
            $query->bindParam(':fname',$firstname,PDO::PARAM_STR);
            $query->bindParam(':lname',$lastname,PDO::PARAM_STR);
            $query->bindParam(':gender',$gender,PDO::PARAM_STR);
            $query->bindParam(':dob',$birth,PDO::PARAM_STR);
            $query->bindParam(':email',$email,PDO::PARAM_STR);
            $query->bindParam(':phone',$telephone,PDO::PARAM_STR);
            $query->bindParam(':address',$address,PDO::PARAM_STR);
            $query->bindParam(':password',$password,PDO::PARAM_STR);
            $query->bindParam(':pic',$propic,PDO::PARAM_STR);
            $query->execute();
            $LastInsertId=$dbh->lastInsertId();
            if ($LastInsertId>0) {
                move_uploaded_file($_FILES["propic"]["tmp_name"],"admins/".$propic);
                echo '<script>alert("Person Detail has been added.")</script>';
                echo "<script>window.location.href ='account-settings.php'</script>";
            }else{
                echo '<script>alert("Something Went Wrong. Please try again")</script>';
            }
    }  }
?>
<!DOCTYPE html>
<html class="no-js" lang="">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>AKKHOR | Account Setting</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Favicon -->
    <?php include_once("includes/favicon.php")?>
    <!-- Normalize CSS -->
    <link rel="stylesheet" href="css/normalize.css">
    <!-- Main CSS -->
    <link rel="stylesheet" href="css/main.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- Fontawesome CSS -->
    <link rel="stylesheet" href="css/all.min.css">
    <!-- Flaticon CSS -->
    <link rel="stylesheet" href="fonts/flaticon.css">
    <!-- Animate CSS -->
    <link rel="stylesheet" href="css/animate.min.css">
    <!-- Select 2 CSS -->
    <link rel="stylesheet" href="css/select2.min.css">
    <!-- Date Picker CSS -->
    <link rel="stylesheet" href="css/datepicker.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="style.css">
    <!-- Modernize js -->
    <script src="js/modernizr-3.6.0.min.js"></script>
</head>

<body>
    <!-- Preloader Start Here -->
    <div id="preloader"></div>
    <!-- Preloader End Here -->
    <div id="wrapper" class="wrapper bg-ash">
         <!-- Header Menu Area Start Here -->
        <?php include_once("includes/header.php"); ?>
        <!-- Header Menu Area End Here -->
        <!-- Page Area Start Here -->
        <div class="dashboard-page-one">
            <!-- Sidebar Area Start Here -->
            <?php include_once("includes/sidebar.php"); ?>
            <!-- Sidebar Area End Here -->
            <div class="dashboard-content-one">
                <!-- Breadcubs Area Start Here -->
                <div class="breadcrumbs-area">
                    <h3>Account Setting</h3>
                    <ul>
                        <li>
                            <a href="index.html">Home</a>
                        </li>
                        <li>Setting</li>
                    </ul>
                </div>
                <!-- Breadcubs Area End Here -->
                <!-- Account Settings Area Start Here -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="heading-layout1">
                                    <div class="item-title">
                                        <h3>Add New User</h3>
                                    </div>
                                   
                                </div>
                                <form method="POST" enctype="multipart/form-data" class="new-added-form">
                                    <div class="row">
                                        <div class="col-xl-3 col-lg-6 col-12 form-group">
                                            <label>First Name </label>
                                            <input type="text" required name="firstname" placeholder="vendetta" class="form-control">
                                        </div>
                                        <div class="col-xl-3 col-lg-6 col-12 form-group">
                                            <label>Last Name </label>
                                            <input type="text" required name="lastname" placeholder="alkaline" class="form-control">
                                        </div>
                                        <div class="col-xl-3 col-lg-6 col-12 form-group">
                                            <label>Gender </label>
                                            <select required name="gender" class="select2">
                                                <option>Please Select Gender </option>
                                                <option>Male</option>
                                                <option>Female</option>
                                                <option>Other</option>
                                            </select>
                                        </div>
                                        
                                        <div class="col-xl-3 col-lg-6 col-12 form-group">
                                            <label>Date Of Birth </label>
                                            <input type="date" required name="date_of_birth" placeholder="dd/mm/yyyy" class="form-control"
                                                >                                       
                                        </div>
                                        <div class="col-xl-3 col-lg-6 col-12 form-group">
                                            <label>E-Mail</label>
                                            <input type="email" required name="email" placeholder="example@example.com" class="form-control">
                                        </div>
                                                               
                                        <div class="col-xl-3 col-lg-6 col-12 form-group">
                                            <label>Phone</label>
                                            <input type="text" required name="phone" placeholder="233556503228" class="form-control">
                                        </div>
                                        <!-- <div class="col-xl-3 col-lg-6 col-12 form-group">
                                            <label>Address </label>
                                            <textarea class="textarea form-control" name="address" id="form-address"></textarea>
                                        </div> -->
                                        <div class="col-xl-3 col-lg-6 col-12 form-group">
                                            <label for="password">Password</label>
                                            <input type="password" required id="password" name="password" class="form-control" >
                                        </div>
                                        
                                        <div class="col-xl-3 col-lg-6 col-12 form-group">
                                            <label>Profile Picture</label>
                                            <input type="file" required name="propic" class="form-control-file"> 
                                        </div>
                                        <div class="col-lg-6 col-12 form-group">
                                            <label>Address </label> 
                                            <textarea class="textarea form-control" required name="address" id="form-address" cols="10"
                                                rows="4"></textarea>
                                        </div> 
                                         
                                        <div class="col-12 form-group mg-t-8">
                                            <button name="submit" type="submit" class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark">Add</button>
                                            <button type="reset" class="btn-fill-lg bg-blue-dark btn-hover-yellow">Reset</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                   <!--user profile details -->
                    <div class="col-12-xxxl col-xl-12">
                        <div class="card account-settings-box">
                            <div class="card-body">
                            <?php
$sql="SELECT * from admin";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);

$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $row)
{               ?>
                                <div id="profile" class="user-details-box">
                                    <div class="item-img">
                                        <img src="admins/<?php echo htmlentities($row->Picture); ?>" alt="user picture">
                                    </div>
                                    <div class="item-content">
                                        <div class="info-table table-responsive">
                                            <table class="table text-nowrap">
                                                <tbody>
                                                    <tr>
                                                        <td>Name:</td>
                                                        <td class="font-medium text-dark-medium"><?php echo htmlentities($row->FirstName." ".$row->LastName);?></td>
                                                    </tr>
                                                    
                                                    <tr>
                                                        <td>Gender:</td>
                                                        <td class="font-medium text-dark-medium"><?php echo htmlentities($row->Gender);?></td>
                                                    </tr>
                                                    
                                                    <tr>
                                                        <td>Date Of Birth:</td>
                                                        <td class="font-medium text-dark-medium"><?php echo htmlentities($row->Date_Of_Birth);?></td>
                                                    </tr>
                                                    
                                                    <tr>
                                                        <td> Date Added:</td>
                                                        <td class="font-medium text-dark-medium"><?php echo htmlentities($row->Date);?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>E-mail:</td>
                                                        <td class="font-medium text-dark-medium"><?php echo htmlentities($row->Email);?></td>
                                                    </tr>
                                                                                                      
                                                    <tr>
                                                        <td>Address:</td>
                                                        <td class="font-medium text-dark-medium"><?php echo htmlentities($row->Address);?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Phone:</td>
                                                        <td class="font-medium text-dark-medium"><?php echo htmlentities($row->Phone);?></td>
                                                    </tr>
                                                    <?php $cnt=$cnt+1;}} ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Account Settings Area End Here -->
                <?php include_once("includes/footer.php"); ?>
            </div>
        </div>
        <!-- Page Area End Here -->
    </div>
    <!-- jquery-->
    <script src="js/jquery-3.3.1.min.js"></script>
    <!-- Plugins js -->
    <script src="js/plugins.js"></script>
    <!-- Popper js -->
    <script src="js/popper.min.js"></script>
    <!-- Bootstrap js -->
    <script src="js/bootstrap.min.js"></script>
    <!-- Scroll Up Js -->
    <script src="js/jquery.scrollUp.min.js"></script>
    <!-- Select 2 Js -->
    <script src="js/select2.min.js"></script>
    <!-- Date Picker Js -->
    <script src="js/datepicker.min.js"></script>
    <!-- Custom Js -->
    <script src="js/main.js"></script>

</body>
</html>