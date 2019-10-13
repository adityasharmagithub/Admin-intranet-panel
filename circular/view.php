<?php
    require('../config/config.php');
    require('../config/db.php');
    
    $articleid = mysqli_real_escape_string($conn, $_GET['id']);
    $query = "SELECT * FROM articles WHERE articleid='$articleid'";
    $result = mysqli_query($conn, $query);
    $circulars = mysqli_fetch_all($result, MYSQLI_ASSOC);
    $circular = reset($circulars);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>View Content</title>
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="style.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="main.js"></script>
</head>

<body>
	<br>
    <div class="container"><br><br><br><br><br><br><br>
    	<div class="modal-content">
    		<div class="modal-header">                      
                <h2 class="modal-title"><?php echo $circular['title']; ?></h2>
            </div>
            <div class="modal-body">                    
        		<h3><b>Content:</b><br><?php echo $circular['body']; ?></h3><hr>
        		<p><b>Start Date: </b><?php echo $circular['startdate']; ?></p><hr>
        		<p><b>End Date: </b><?php echo $circular['enddate']; ?></p>
        	</div>
        	<div class="modal-footer">
        		<p><b>Issued by Department Code: </b><?php echo $circular['deptid']; ?></p>
        		<?php if($circular['file'] != ''): ?>
	        		<p><b>Find Attachment: </b></p>
	        		<a href="<?php echo '../uploads/'.$circular['file']; ?>"><button type="submit" class="btn btn-primary">File</button></a>
	        	<?php endif; ?>          
            </div>
        </div>
    </div>
</body>