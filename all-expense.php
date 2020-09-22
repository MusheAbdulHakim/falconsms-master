<?php
    include_once("includes/config.php");
    
 ?>
<!doctype html>
<html class="no-js" lang="">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>AKKHOR | All Expense</title>
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
                    <h3>Accounts</h3>
                    <ul>
                        <li>
                            <a href="index.html">Home</a>
                        </li>
                        <li>All Expense</li>
                    </ul>
                </div>
                <!-- Breadcubs Area End Here -->
                <!-- Expanse Table Area Start Here -->
                <div class="card height-auto">
                    <div class="card-body">
                        <div class="heading-layout1">
                            <div class="item-title">
                                <h3>All Expenses</h3>
                            </div>
                           <div class="dropdown">
                                <a class="dropdown-toggle" href="#" role="button" 
                                data-toggle="dropdown" aria-expanded="false">...</a>
        
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" href="#"><i class="fas fa-times text-orange-red"></i>Close</a>
                                    <a class="dropdown-item" href="#"><i class="fas fa-cogs text-dark-pastel-green"></i>Edit</a>
                                    <a class="dropdown-item" href="#"><i class="fas fa-redo-alt text-orange-peel"></i>Refresh</a>
                                </div>
                            </div>
                        </div>
                        
                        <div class="table-responsive">
                            <table class="table data-table text-nowrap">
                                <thead>
                                    <tr>
                                        <th> 
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input checkAll">
                                                <label class="form-check-label">ID</label>
                                            </div>
                                        </th>
                                        <th>Name</th>
                                        <th>Expense Type</th>
                                        <th>Amount</th>
                                        <th>Status</th>
                                        <th>Phone</th>
                                        <th>E-mail</th>
                                        <th>Date</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <?php
                                $sql="SELECT * from expenses";
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
                                                <label class="form-check-label"><?php echo $cnt; ?></label>
                                            </div>
                                        </td>
                                        <td><?php echo htmlentities($row->Name);?></td>
                                        <td><?php echo htmlentities($row->Expense_Type);?></td>
                                        <td><?php echo "GH¢ ".htmlentities($row->Price);?></td>
                                        <!-- <td class="badge badge-pill badge-success d-block mg-t-8">Paid</td> -->
                                       
                                        <?php if($row->Status == 1)
                                                    {?>
                                        <td class="badge badge-pill badge-success d-block mg-t-8 text-white"><a class="text-white" href="all-expense.php?confirm=<?php echo htmlentities($row->id);?>" onclick="return confirm('Do you really want to Un-Confirm the Payment')">Paid</a></td> 
                                        <?php } else {?>
                                            <td class="badge badge-pill badge-danger d-block mg-t-8"><a class="text-white" href="all-expense.php?unconfirm=<?php echo htmlentities($row->id);?>" onclick="return confirm('Do you really want to Confirm the Payment')">Due</a></td>
                                        <?php } ?>
                                       
                                        <td><?php echo htmlentities($row->Phone);?></td>
                                        <td><?php echo htmlentities($row->Email);?></td>
                                        <td><?php echo htmlentities($row->Date);?></td>
                                         <td>
                                            <div class="dropdown">
                                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                                    <span class="flaticon-more-button-of-three-dots"></span>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a class="dropdown-item" onclick="return confirm('Do you really want to Delete ?');" href="all-class.php?delid=<?php echo htmlentities($row->id);?>"><i class="fas fa-trash text-danger"></i>Delete</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                                <?php $cnt+=1;}} ?>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- Expanse Table Area End Here -->
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
    <!-- Data Table Js -->
    <script src="js/jquery.dataTables.min.js"></script>
    <!-- Scroll Up Js -->
    <script src="js/jquery.scrollUp.min.js"></script>
    <!-- Custom Js -->
    <script src="js/main.js"></script>

</body>
</html>