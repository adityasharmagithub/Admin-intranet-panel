<?php
    require('../config/config.php');
    require('../config/db.php');

    $query = "SELECT * FROM department";

    $result = mysqli_query($conn, $query);

    $departments = mysqli_fetch_all($result, MYSQLI_ASSOC);

    if(isset($_POST['add'])){
        session_start();
        
        $deptid = mysqli_real_escape_string($conn, $_POST['deptid']);
        $deptname = mysqli_real_escape_string($conn, $_POST['deptname']);
       
        $query = "INSERT INTO department(deptid, deptname) VALUES ('$deptid', '$deptname')";

        if(mysqli_query($conn, $query)){
            header('Location: '.'http://localhost/phpsandbox/Website2/admin/manageDept.php'.'');
        } else {
            echo 'ERROR: '. mysqli_error($conn);
        }
    }

    if(isset($_POST['delete'])){
        session_start();

        $deptid = mysqli_real_escape_string($conn, $_POST['deptid']);

        $query = "DELETE FROM department WHERE deptid='$deptid'";
        if(mysqli_query($conn, $query)){
            header('Location: '.'http://localhost/phpsandbox/Website2/admin/manageDept.php'.'');
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
<title>Departments</title>
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

        <a href="adminindex.php"><button class="btn btn-danger">Cancel</button></a>

        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-6">
                        <h2>Manage <b>Departments</b></h2>
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
                        <th>Name</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($departments as $department): ?>
                        <tr>
                            <td><?php echo $department['deptid']; ?></td>
                            <td><?php echo $department['deptname']; ?></td>
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
                        <h4 class="modal-title">Add Department</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">                    
                        <div class="form-group">
                            <label>ID</label>
                            <input type="text" name="deptid" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Department Name</label>
                            <input type="text" name="deptname" class="form-control" required>
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
    
    <!-- Delete Modal HTML -->
    <div id="deleteEmployeeModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST" action="<?php $_SERVER['PHP_SELF']; ?>">
                    <div class="modal-header">                      
                        <h4 class="modal-title">Delete Department</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Enter ID of the department</label>
                            <input type="text" class="form-control" name="deptid" required>
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
</body>                                                                 