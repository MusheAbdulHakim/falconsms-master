<?php
    include_once("includes/config.php");
    if(isset($_POST['submit'])){
        $firstname= htmlspecialchars($_POST['firstname']);
        $lastname = htmlspecialchars($_POST['lastname']);
        $gender = htmlspecialchars($_POST['gender']);
        $dob = htmlspecialchars($_POST['date_of_birth']);
        $email = htmlspecialchars($_POST['email']);
        $phone = htmlspecialchars($_POST['phone']);
        $address = htmlspecialchars($_POST['address']);
        $propic=$_FILES["propic"]["name"];
        $extension = substr($propic,strlen($propic)-4,strlen($propic));
        $allowed_extensions = array(".jpg",".jpeg",".png",".gif");
        if(!in_array($extension,$allowed_extensions)){
        echo "<script>alert('Profile Pics has Invalid format. Only jpg / jpeg/ png /gif format allowed');</script>";
        }else {
        $propic=md5($propic).time().$extension;
        
        // Insert quaery
        $sql="INSERT INTO  admins(FirstName,LastName,Gender,Date_Of_Birth,Email,Phone,Address,Picture)
              VALUES(:fname,:lname,:gender,:dob,:email,:phone,:address,:pic)";
        $query = $dbh->prepare($sql);
        // Bind parameters
        $query->bindParam(':fname',$firstname,PDO::PARAM_STR);
        $query->bindParam(':lname',$lastname,PDO::PARAM_STR);
        $query->bindParam(':gender',$gender,PDO::PARAM_STR);
        $query->bindParam(':dob',$dob,PDO::PARAM_STR);
        $query->bindParam(':email',$email,PDO::PARAM_STR);
        $query->bindParam(':phone',$phone,PDO::PARAM_STR);
        $query->bindParam(':address',$address,PDO::PARAM_STR);
        $query->bindParam(':pic',$propic,PDO::PARAM_STR);
        $query->execute();
        $lastInsertId = $dbh->lastInsertId();
        if($lastInsertId>0){ 
            move_uploaded_file($_FILES["propic"]["tmp_name"],"admins/".$propic); 
            echo "<script>alert('User Added successfully.');</script>";
        }
        else{
            echo "<script>alert('Something went wrong. Please try again');</script>";
        }
        }
    }
 ?>
<!doctype html>
<html class="no-js" lang="">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>AKKHOR | Account Setting</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="img/favicon.png">
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
                                            <input type="text" name="firstname" placeholder="vendetta" class="form-control">
                                        </div>
                                        <div class="col-xl-3 col-lg-6 col-12 form-group">
                                            <label>Last Name </label>
                                            <input type="text" name="lastname" placeholder="alkaline" class="form-control">
                                        </div>
                                        <div class="col-xl-3 col-lg-6 col-12 form-group">
                                            <label>Gender </label>
                                            <select name="gender" class="select2">
                                                <option>Please Select Gender </option>
                                                <option>Male</option>
                                                <option>Female</option>
                                                <option>Others</option>
                                            </select>
                                        </div>
                                        
                                        <div class="col-xl-3 col-lg-6 col-12 form-group">
                                            <label>Date Of Birth </label>
                                            <input type="text" name="date_of_birth" placeholder="dd/mm/yyyy" class="form-control air-datepicker"
                                                data-position='bottom right'>
                                            <i class="far fa-calendar-alt" ></i>
                                        </div>
                                       
                                         
                                        <div class="col-xl-3 col-lg-6 col-12 form-group">
                                            <label>E-Mail</label>
                                            <input type="email" name="email" placeholder="example@example.com" class="form-control">
                                        </div>
                                                               
                                        <div class="col-xl-3 col-lg-6 col-12 form-group">
                                            <label>Phone</label>
                                            <input type="text" name="phone" placeholder="233556503228" class="form-control">
                                        </div>
                                        <div class="col-xl-3 col-lg-6 col-12 form-group">
                                            <label>Profile Picture</label>
                                            <input type="file" name="propic" class="form-control-file"> 
                                        </div>
                                        <div class="col-xl-3 col-lg-6 col-12 form-group">
                                            <label>Address </label>
                                            <textarea class="textarea form-control" name="address" id="form-address"></textarea>
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
                                
                                <div class="user-details-box">
                                    <div class="item-img">
                                        <img src="img/figure/user.jpg" alt="user picture">
                                    </div>
                                    <div class="item-content">
                                        <div class="info-table table-responsive">
                                            <table class="table text-nowrap">
                                                <tbody>
                                                    <tr>
                                                        <td>Name:</td>
                                                        <td class="font-medium text-dark-medium">Steven Johnson</td>
                                                    </tr>
                                                    
                                                    <tr>
                                                        <td>Gender:</td>
                                                        <td class="font-medium text-dark-medium">Male</td>
                                                    </tr>
                                                    
                                                    <tr>
                                                        <td>Date Of Birth:</td>
                                                        <td class="font-medium text-dark-medium">07.08.2016</td>
                                                    </tr>
                                                    
                                                    <tr>
                                                        <td>Joining Date:</td>
                                                        <td class="font-medium text-dark-medium">07.08.2016</td>
                                                    </tr>
                                                    <tr>
                                                        <td>E-mail:</td>
                                                        <td class="font-medium text-dark-medium">stevenjohnson@gmail.com</td>
                                                    </tr>
                                                   
                                                   
                                                    
                                                    <tr>
                                                        <td>Address:</td>
                                                        <td class="font-medium text-dark-medium">House #10, Road #6, Australia</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Phone:</td>
                                                        <td class="font-medium text-dark-medium">+ 88 98568888418</td>
                                                    </tr>
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