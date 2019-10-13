<?php
    require('../config/config.php');
    require('../config/db.php');

    $department = mysqli_real_escape_string($conn, $_GET['id']);

    $query = "SELECT * FROM articles WHERE deptid='$department' ORDER BY startdate DESC";
    $otherquery = "SELECT * FROM department WHERE deptid != '$department'";
    $currentquery = "SELECT * FROM department WHERE deptid = '$department'";

    $result = mysqli_query($conn, $query);
    $otherresult = mysqli_query($conn, $otherquery);
    $currentresult = mysqli_query($conn, $currentquery);

    $circulars = mysqli_fetch_all($result, MYSQLI_ASSOC);
    $otherDepts = mysqli_fetch_all($otherresult, MYSQLI_ASSOC);
    $currentDept = mysqli_fetch_all($currentresult, MYSQLI_ASSOC);
    //$circulars =  mysqli_fetch_assoc($result); //BETTER - FIXED;

    if(isset($_POST['add'])){
        session_start();
        
        $title = mysqli_real_escape_string($conn, $_POST['title']);
        $body = mysqli_real_escape_string($conn, $_POST['body']);
        $loc = mysqli_real_escape_string($conn, $_SESSION['loc']);
        $deptid = mysqli_real_escape_string($conn, $_SESSION['deptid']);
        $enddate = mysqli_real_escape_string($conn, $_POST['enddate']);
        $empid = mysqli_real_escape_string($conn, $_SESSION['empid']);

        $query = "INSERT INTO articles(title, body, loc, deptid, startdate, enddate, empid) VALUES ('$title', '$body', '$loc', '$deptid', CURDATE(),'$enddate','$empid')";

        if(mysqli_query($conn, $query)){
            header('Location: '.'http://localhost/phpsandbox/Website2/circular/circular.php'.'');
        } else {
            echo 'ERROR: '. mysqli_error($conn);
        }
    }

    if(isset($_POST['edit'])){
        session_start();

        $articleid = mysqli_real_escape_string($conn, $_POST['articleid']);
        $title = mysqli_real_escape_string($conn, $_POST['title']);
        $body = mysqli_real_escape_string($conn, $_POST['body']);
        $enddate = mysqli_real_escape_string($conn, $_POST['enddate']);
        
        $query = "UPDATE articles SET 
                    title='$title',
                    body='$body',
                    enddate='$enddate' 
                  WHERE articleid = '$articleid'";
        if(mysqli_query($conn, $query)){
            header('Location: '.'http://localhost/phpsandbox/Website2/circular/circular.php'.'');
        } else {
            echo 'ERROR: '. mysqli_error($conn);
        }
    }

    if(isset($_POST['delete'])){
        session_start();

        $articleid = mysqli_real_escape_string($conn, $_POST['articleid']);

        $query = "DELETE FROM articles WHERE articleid='$articleid'";
        if(mysqli_query($conn, $query)){
            header('Location: '.'http://localhost/phpsandbox/Website2/circular/circular.php'.'');
        } else {
            echo 'ERROR: '. mysqli_error($conn);
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php echo $currentDept[0]['deptname'] ?></title>
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="../circular/style.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="main.js"></script>
</head>

<body>
    <div class="container">
        <br>
        <a href="adminindex.php"><button class="btn btn-danger">Go to Home</button></a>
        <a href="../circular/circular.php"><button class="btn btn-primary">All Departments</button></a>
        <?php foreach($otherDepts as $otherDept): ?>
            <a href="department.php?id=<?php echo $otherDept['deptid'] ?>"><button class="btn btn-primary"><?php echo $otherDept['deptname'] ?></button></a>
        <?php endforeach; ?>
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-6">
                        <h2><b><?php echo $currentDept[0]['deptname'] ?></b> Circulars</h2>
                    </div>
                    <div class="col-sm-6">
                        <a href="#addEmployeeModal" class="btn btn-success" data-toggle="modal"><i class="material-icons">&#xE147;</i> <span>Add New Circular</span></a>
                        <a href="#deleteEmployeeModal" class="btn btn-danger" data-toggle="modal"><i class="material-icons">&#xE15C;</i> <span>Delete</span></a>    
                    </div>
                </div>
            </div>
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Department</th>
                        <th>Valid Upto</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($circulars as $circular): ?>
                        <tr>
                            <td><?php echo $circular['articleid']; ?></td>
                            <td><?php echo $circular['title']; ?></td>
                            <td><?php echo $circular['deptid']; ?></td>
                            <td><?php echo $circular['enddate']; ?></td>
                            <td>
                                <a href="#editEmployeeModal" class="edit" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i></a>
                                <a href="../circular/view.php?id=<?php echo $circular['articleid']; ?>" target="_blank" class="view" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="View">&#xE417;</i></a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    <!-- Add Modal HTML -->
    <div id="addEmployeeModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST" action="<?php $_SERVER['PHP_SELF']; ?>">
                    <div class="modal-header">                      
                        <h4 class="modal-title">Add Circular</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">                    
                        <div class="form-group">
                            <label>Title</label>
                            <input type="text" name="title" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Body</label>
                            <textarea class="form-control" name="body" required></textarea>
                        </div>
                        <div class="form-group">
                            <label>End Date</label>
                            <input type="date" name="enddate" class="form-control" required>
                        </div>                  
                    </div>
                    <div class="modal-footer">
                        <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                        <button type="submit" name="add" class="btn btn-success">Add</button> 
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Edit Modal HTML -->
    <div id="editEmployeeModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST" action="<?php $_SERVER['PHP_SELF']; ?>">
                    <div class="modal-header">                      
                        <h4 class="modal-title">Edit Circular</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>ID</label>
                            <input type="text" class="form-control" name="articleid" required>
                        </div>                    
                        <div class="form-group">
                            <div class="form-group">
                            <label>Title</label>
                            <input type="text" name="title" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Body</label>
                            <textarea class="form-control" name="body" required></textarea>
                        </div>
                        <div class="form-group">
                            <label>End Date</label>
                            <input type="date" name="enddate" class="form-control" required>
                        </div>                 
                    </div>
                    <div class="modal-footer">
                        <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                        <button type="submit" name="edit" class="btn btn-info">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </div>
    <!-- Delete Modal HTML -->
    <div id="deleteEmployeeModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST" action="<?php $_SERVER['PHP_SELF']; ?>">
                    <div class="modal-header">                      
                        <h4 class="modal-title">Delete Circular</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Enter ID of the record</label>
                            <input type="text" class="form-control" name="articleid" required>
                        </div>               
                    </div>
                    <div class="modal-footer">
                        <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                        <button type="submit" name="delete" class="btn btn-danger">Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- View Modal HTML 
    <div id="viewEmployeeModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">                      
                    <h4 class="modal-title">Circular Content</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="articleid">
                    <?php /*
                        $articleId = htmlentities('articleid');
                        $viewQuery = "SELECT * FROM articles WHERE articleid = '$articleId' ORDER BY startdate DESC";
                        $viewResult = mysqli_query($conn, $viewQuery);
                        $viewCirculars = mysqli_fetch_all($viewResult, MYSQLI_ASSOC);
                        print_r($viewCirculars);
                        */
                    ?>
                    <h5>Issued on: <?php //echo $viewCirculars['startdate']; ?></h5>
                    <h1><?php //echo $viewCirculars['title']; ?></h1>
                    <p><?php //echo $viewCircular['body']; ?></p>
                </div>
            </div>
        </div>
    </div> -->
</body>
</html>                                                                 