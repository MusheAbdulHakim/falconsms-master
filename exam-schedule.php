<?php 
include_once("includes/config.php");
if(isset($_POST['submit'])){
    $name = htmlspecialchars($_POST['exam_name']);
    $subject = htmlspecialchars($_POST['subject']);
    $class = htmlspecialchars($_POST['class']);
    $section = htmlspecialchars($_POST['section']);
    $exam_time = htmlspecialchars($_POST['time']);
    $exam_date = htmlspecialchars($_POST['date']);
    $sql = "INSERT into exams_schedule(Exam,Subject,Class,Section,Time,Date) 
    values(:name,:subject,:class,:section,:time,:date)";
    $query = $dbh->prepare($sql);
    $query->bindParam(':name',$name,PDO::PARAM_STR);
    $query->bindParam(':subject',$subject,PDO::PARAM_STR);
    $query->bindParam(':class',$class,PDO::PARAM_STR);
    $query->bindParam(':section',$section,PDO::PARAM_STR);
    $query->bindParam(':time',$exam_time,PDO::PARAM_STR);
    $query->bindParam(':date',$exam_date,PDO::PARAM_STR);
    $query->execute();
    $lastInserId = $dbh->lastInsertId();
    if($lastInserId>0){
        echo "<script>alert('Exam Schedule has been added');</script>";
        echo "<script>window.location.href='exam-schedule.php';</script>";
    }else{
        echo "<script>alert('Something went wrong');</script>";
    }
}

 ?>
<!doctype html>
<html class="no-js" lang="">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>AKKHOR | Exam Schedule</title>
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
    <!-- Date Picker CSS -->
    <link rel="stylesheet" href="css/datepicker.min.css">
    <!-- Select 2 CSS -->
    <link rel="stylesheet" href="css/select2.min.css">
    <!-- Data Table CSS -->
    <link rel="stylesheet" href="css/jquery.dataTables.min.css">
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
                    <h3>Examination</h3>
                    <ul>
                        <li>
                            <a href="index.html">Home</a>
                        </li>
                        <li>Exam Schedule</li>
                    </ul>
                </div>
                <!-- Breadcubs Area End Here -->
                <!-- Exam Schedule Area Start Here -->
                <div class="row">
                    <div class="col-4-xxxl col-12">
                        <div class="card height-auto">
                            <div class="card-body">
                                <div class="heading-layout1">
                                    <div class="item-title">
                                        <h3>Add New Exam</h3>
                                    </div>
                                    <div class="dropdown">
                                        <a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown"
                                            aria-expanded="false">...</a>

                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item" href="#"><i
                                                    class="fas fa-times text-orange-red"></i>Close</a>
                                            <a class="dropdown-item" href="#"><i
                                                    class="fas fa-cogs text-dark-pastel-green"></i>Edit</a>
                                            <a class="dropdown-item" href="#"><i
                                                    class="fas fa-redo-alt text-orange-peel"></i>Refresh</a>
                                        </div>
                                    </div>
                                </div>
                                <form method="POST" enctype="multipart/form-data" class="new-added-form">
                                    <div class="row">
                                        <div class="col-12-xxxl col-lg-6 col-12 form-group">
                                            <label>Exam Name</label>
                                            <input type="text" required name="exam_name" placeholder="" class="form-control">
                                        </div>
                                        <div class="col-12-xxxl col-lg-6 col-12 form-group">
                                            <label>Subject</label>
                                            <select name="subject" required class="select2">
                                                <option value="">Select Subject</option>
                                            <?php 
                                        $sql2 = "SELECT * from  subjects";
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
                                        <div class="col-12-xxxl col-lg-6 col-12 form-group">
                                            <label>Select Class *</label>
                                            <select name="class" required class="select2">
                                                <option value="0">Please Select</option>
                                                <?php 
                                        $sql2 = "SELECT * from  classes";
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
                                        <div class="col-12-xxxl col-lg-6 col-12 form-group">
                                            <label>Select Section</label>
                                            <select name="section" required class="select2">
                                                <option >Please Select</option>
                                                <option>A</option>
                                                <option>B</option>
                                                <option >C</option>
                                                <option>D</option>
                                                <option>E</option>
                                            </select>
                                        </div>
                                        <div class="col-12-xxxl col-lg-6 col-12 form-group">
                                            <label>Select Time</label>
                                            <input required name="time" type="time" placeholder="" class="form-control">
                                        </div>
                                        <div class="col-12-xxxl col-lg-6 col-12 form-group">
                                            <label>Select Date</label>
                                            <input name="date" type="date" class="form-control" placeholder="dd/mm/yyyy"
                                                >
                                        </div>
                                        <div class="col-12 form-group mg-t-8">
                                            <button type="submit" name="submit" class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark">Save</button>
                                            <button type="reset" class="btn-fill-lg bg-blue-dark btn-hover-yellow">Reset</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-8-xxxl col-12">
                        <div class="card height-auto">
                            <div class="card-body">
                                <div class="heading-layout1">
                                    <div class="item-title">
                                        <h3>All Exam Schedule</h3>
                                    </div>
                                    <div class="dropdown">
                                        <a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown"
                                            aria-expanded="false">...</a>

                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item" href="#"><i
                                                    class="fas fa-times text-orange-red"></i>Close</a>
                                            <a class="dropdown-item" href="#"><i
                                                    class="fas fa-cogs text-dark-pastel-green"></i>Edit</a>
                                            <a class="dropdown-item" href="#"><i
                                                    class="fas fa-redo-alt text-orange-peel"></i>Refresh</a>
                                        </div>
                                    </div>
                                </div>
                              
                                <div class="table-responsive">
                                    <table class="table display data-table text-nowrap">
                                        <thead>
                                            <tr>
                                                <th>
                                                    <div class="form-check">
                                                        <input type="checkbox" class="form-check-input checkAll">
                                                        <label class="form-check-label">Exam Name</label>
                                                    </div>
                                                </th>
                                                <th>Subject</th>
                                                <th>Class</th>
                                                <th>Section</th>
                                                <th>Time</th>
                                                <th>Date</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <?php
                            $sql="SELECT * from exams_schedule";
                            $query = $dbh -> prepare($sql);
                            $query->execute();
                            $results=$query->fetchAll(PDO::FETCH_OBJ);

                            $cnt=1;
                            if($query->rowCount() > 0)
                            {
                            foreach($results as $row)
                            {               ?>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <div class="form-check">
                                                        <input type="checkbox" class="form-check-input">
                                                        <label class="form-check-label"><?php echo htmlentities($row->Exam);?></label>
                                                    </div>
                                                </td>
                                                <td><?php echo htmlentities($row->Subject);?></td>
                                                <td><?php echo htmlentities($row->Class);?></td>
                                                <td><?php echo htmlentities($row->Section);?></td>
                                                <td><?php echo htmlentities($row->Time);?></td>
                                                <td><?php echo htmlentities($row->Date);?></td>
                                                <td>
                                                    <div class="dropdown">
                                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"
                                                            aria-expanded="false">
                                                            <span class="flaticon-more-button-of-three-dots"></span>
                                                        </a>
                                                        <div class="dropdown-menu dropdown-menu-right">
                                                            <a class="dropdown-item" href="#"><i
                                                                    class="fas fa-trash text-orange-red"></i>Delete</a>
                                                            
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <?php $cnt=$cnt+1;}} ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Exam Schedule Area End Here -->
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
    <!-- Scroll Up Js -->
    <script src="js/jquery.scrollUp.min.js"></script>
    <!-- Date Picker Js -->
    <script src="js/datepicker.min.js"></script>
    <!-- Data Table Js -->
    <script src="js/jquery.dataTables.min.js"></script>
    <!-- Custom Js -->
    <script src="js/main.js"></script>

</body>
</html>