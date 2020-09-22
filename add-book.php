<?php
    include_once("includes/config.php");
    if(isset($_POST['submit'])){
        $name = htmlspecialchars($_POST['book']);
        $subject = htmlspecialchars($_POST['subject']);
        $writer = htmlspecialchars($_POST['writer']);
        $class = htmlspecialchars($_POST['class']);
        $published_on = htmlspecialchars($_POST['publish_date']);
        $sql = "insert into library(Book,Subject,Writer,Class,Publish_Date)
        values(:book,:subject,:writer,:class,:publishedOn)";
        $query = $dbh->prepare($sql);
        $query->bindParam(':book',$name,PDO::PARAM_STR);
        $query->bindParam(':subject',$subject,PDO::PARAM_STR);
        $query->bindParam(':writer',$writer,PDO::PARAM_STR);
        $query->bindParam(':class',$class,PDO::PARAM_STR);
        $query->bindParam(':publishedOn',$published_on,PDO::PARAM_STR);
        $query->execute();
        $lastinserted = $dbh->lastInsertId();
        if($lastinserted>0){
            echo "<script>alert('Book Has Been Added To Library');</script>";
            echo "<script>window.location.href='all-book.php';</script>";
        }else{
            echo "<script>alert('Something Went Wrong.');</script>";
        }

    }
?>
<!doctype html>
<html class="no-js" lang="">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>AKKHOR | Add Book</title>
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
                    <h3>Library</h3>
                    <ul>
                        <li>
                            <a href="index.php">Home</a>
                        </li>
                        <li>Add New Book</li>
                    </ul>
                </div>
                <!-- Breadcubs Area End Here -->
                <!-- Add New Book Area Start Here -->
                <div class="card height-auto">
                    <div class="card-body">
                        <div class="heading-layout1">
                            <div class="item-title">
                                <h3>Add New Book</h3>
                            </div>
                           <div class="dropdown">
                                <a class="dropdown-toggle" href="#" role="button" 
                                data-toggle="dropdown" aria-expanded="false">...</a>                    
                            </div>
                        </div>
                        <form method="POST" class="new-added-form">
                            <div class="row">
                                <div class="col-xl-3 col-lg-6 col-12 form-group">
                                    <label>Book Name </label>
                                    <input required type="text" name="book" placeholder="" class="form-control">
                                </div>
                                <div class="col-xl-3 col-lg-6 col-12 form-group">
                                    <label>Subject </label>
                                    <select name="subject" class="select2">
                                        <option value="">Please Select Subject *</option>
                                        <?php 
                      $sql2 = "SELECT * from subjects";
                      $query2 = $dbh -> prepare($sql2);
                      $query2->execute();
                      $result2=$query2->fetchAll(PDO::FETCH_OBJ);
                      foreach($result2 as $row)
                      {          
                          ?>  
                      <option value="<?php echo htmlentities($row->Name);?>">
                      <?php echo htmlentities($row->Name);?></option>
                       <?php } ?> 
                                    </select>

                                </div>
                                <div class="col-xl-3 col-lg-6 col-12 form-group">
                                    <label>Writter Name </label>
                                    <input required type="text" name="writer" placeholder="" class="form-control">
                                </div>
                                <div class="col-xl-3 col-lg-6 col-12 form-group">
                                    <label>Class </label>
                                    <select name="class" class="select2">
                                        <option value="">Please Select Class *</option>
                                        <?php 
                      $sql2 = "SELECT * from classes";
                      $query2 = $dbh -> prepare($sql2);
                      $query2->execute();
                      $result2=$query2->fetchAll(PDO::FETCH_OBJ);
                      foreach($result2 as $row)
                      {          
                          ?>  
                      <option value="<?php echo htmlentities($row->Name);?>">
                      <?php echo htmlentities($row->Name);?></option>
                       <?php } ?> 
                                    </select>
                                </div>
                               
                                <div class="col-xl-3 col-lg-6 col-12 form-group">
                                    <label>Publishing Date </label>
                                    <input required type="date" name="publish_date"  placeholder="" class="form-control">
                                </div>
                                
                                
                                <div class="col-12 form-group mg-t-8">
                                    <button type="submit" name="submit" class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark">Save</button>
                                    <button type="reset" class="btn-fill-lg bg-blue-dark btn-hover-yellow">Reset</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- Add New Book Area End Here -->
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
    <!-- Select 2 Js -->
    <script src="js/select2.min.js"></script>
    <!-- Date Picker Js -->
    <script src="js/datepicker.min.js"></script>
    <!-- Smoothscroll Js -->
    <script src="js/jquery.smoothscroll.min.php"></script>
    <!-- Scroll Up Js -->
    <script src="js/jquery.scrollUp.min.js"></script>
    <!-- Custom Js -->
    <script src="js/main.js"></script>

</body>
</html>