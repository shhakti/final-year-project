<?php
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$name = $session = $Batch = $Subject1 = $Subject2 = $Subject3 = $Subject4 = "";
$name_err = $session_err=$Batch_err = $Marks_err = "";
 
// Processing form data when form is submitted
if(isset($_POST["id"]) && !empty($_POST["id"])){
    // Get hidden input value
    $id = $_POST["id"];
    
    // Validate name
    $input_name = trim($_POST["name"]);
    if(empty($input_name)){
        $name_err = "Please enter a name.";
    } elseif(!filter_var($input_name, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $name_err = "Please enter a valid name.";
    } else{
        $name = $input_name;
    }
    
    // Validate address address
    $input_session = trim($_POST["session"]);
    if(empty($input_session)){
        $sesion_err = "Please enter an address.";     
    } else{
        $session = $input_session;
    }
    
    // Validate salary
    $input_Batch = trim($_POST["Batch"]);
    if(empty($input_Batch)){
        $Batch_err = "Please enter the salary amount.";     
    } else{
        $Batch = $input_Batch;
    }
    // Validate Marks
    $input_Marks= trim($_POST["Subject1"]);
    if(empty($input_Marks)){
        $session_err = "Please enter the Marks.";     
    } elseif(!ctype_digit($input_Marks)){
        $Marks_err = "Please enter a positive Marks value.";
    } else{
        $Subject1 = $input_Marks;
    }
    // Validate Marks
    $input_Marks= trim($_POST["Subject2"]);
    if(empty($input_Marks)){
        $session_err = "Please enter the Marks.";     
    } elseif(!ctype_digit($input_Marks)){
        $Marks_err = "Please enter a positive Marks value.";
    } else{
        $Subject2 = $input_Marks;
    }
    // Validate Marks
    $input_Marks= trim($_POST["Subject3"]);
    if(empty($input_Marks)){
        $session_err = "Please enter the Marks.";     
    } elseif(!ctype_digit($input_Marks)){
        $Marks_err = "Please enter a positive Marks value.";
    } else{
        $Subject3 = $input_Marks;
    }
    // Validate Marks
    $input_Marks= trim($_POST["Subject4"]);
    if(empty($input_Marks)){
        $session_err = "Please enter the Marks.";     
    } elseif(!ctype_digit($input_Marks)){
        $Marks_err = "Please enter a positive Marks value.";
    } else{
        $Subject4 = $input_Marks;
    }
    
    // Check input errors before inserting in database
    if(empty($name_err) && empty($session_err) && empty($Batch_err) && empty($Marks_err)){
        // Prepare an update statement
        $sql = "UPDATE students SET name=?, session=?, Batch=?, Subject1=?,Subject2=?,Subject3=?,Subject4=? WHERE id=?";
         
        if($stmt = mysqli_prepare($conn, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ssssssss", $param_name, $param_session, $param_Batch,$param_Subject1,$param_Subject2,$param_Subject3,$param_Subject4, $param_id);
            
            // Set parameters
            $param_name = $name;
            $param_session = $session;
            $param_Batch = $Batch;
            $param_Subject1 = $Subject1;
            $param_Subject2 = $Subject2;
            $param_Subject3 = $Subject3;
            $param_Subject4 = $Subject4;
            $param_id = $id;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records updated successfully. Redirect to landing page
                header("location: index1.php");
                exit();
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Close connection
    mysqli_close($conn);
} else{
    // Check existence of id parameter before processing further
    if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
        // Get URL parameter
        $id =  trim($_GET["id"]);
        
        // Prepare a select statement
        $sql = "SELECT * FROM students WHERE id = ?";
        if($stmt = mysqli_prepare($conn, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "i", $param_id);
            
            // Set parameters
            $param_id = $id;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                $result = mysqli_stmt_get_result($stmt);
    
                if(mysqli_num_rows($result) == 1){
                    /* Fetch result row as an associative array. Since the result set
                    contains only one row, we don't need to use while loop */
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                    
                    // Retrieve individual field value
                    $name = $row["name"];
                    $session = $row["session"];
                    $Batch = $row["Batch"];
                    $Subject1 = $row["Subject1"];
                    $Subject2 = $row["Subject2"];
                    $Subject3 = $row["Subject3"];
                    $Subject4 = $row["Subject4"];
                } else{
                    // URL doesn't contain valid id. Redirect to error page
                    header("location: error.php");
                    exit();
                }
                
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
        
        // Close statement
        mysqli_stmt_close($stmt);
        
        // Close connection
        mysqli_close($conn);
    }  else{
        // URL doesn't contain id parameter. Redirect to error page
        header("location: error.php");
        exit();
    }
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Record</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .wrapper{
            width: 600px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="mt-5">Update Record</h2>
                    <p>Please edit the input values and submit to update the employee record.</p>
                    <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control <?php echo (!empty($name_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $name; ?>">
                            <span class="invalid-feedback"><?php echo $name_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Session</label>
                            <textarea name="session" class="form-control <?php echo (!empty($session_err)) ? 'is-invalid' : ''; ?>"><?php echo $session; ?></textarea>
                            <span class="invalid-feedback"><?php echo $session_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Batch</label>
                            <input type="text" name="Batch" class="form-control <?php echo (!empty($Batch_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $Batch; ?>">
                            <span class="invalid-feedback"><?php echo $Batch_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Marks</label>
                            <input type="text" name="Subject1" class="form-control <?php echo (!empty($Marks_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $Subject1; ?>">
                            <span class="invalid-feedback"><?php echo $Marks_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Marks</label>
                            <input type="text" name="Subject2" class="form-control <?php echo (!empty($Marks_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $Subject2; ?>">
                            <span class="invalid-feedback"><?php echo $Marks_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Marks</label>
                            <input type="text" name="Subject3" class="form-control <?php echo (!empty($Marks_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $Subject3; ?>">
                            <span class="invalid-feedback"><?php echo $Marks_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Marks</label>
                            <input type="text" name="Subject4" class="form-control <?php echo (!empty($Marks_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $Subject4; ?>">
                            <span class="invalid-feedback"><?php echo $Marks_err;?></span>
                        </div>
                        <input type="hidden" name="id" value="<?php echo $id; ?>"/>
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="index.php" class="btn btn-secondary ml-2">Cancel</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>