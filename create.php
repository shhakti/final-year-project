<?php
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$name = $session = $Batch = $Subject1 = $Subject2 = $Subject3 = $Subject4 = "";
// $name_err = $session_err = $Batch_err =  $Marks_err = "";
$name_err = $session_err = $Batch_err = "";


// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Validate name
    $input_name = trim($_POST["name"]);
    if(empty($input_name)){
        $name_err = "Please enter a name.";
    } elseif(!filter_var($input_name, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $name_err = "Please enter a valid name.";
    } else{
        $name = $input_name;
    }
    
    // // Validate session
    // $session = trim($_POST["session"]);
    // if(empty($input_session)){
    //     $session_err = "Please enter a session.";     
    // } else{
    //     $session = $input_session;
    // }

    // Validate session
    $input_session= trim($_POST["session"]);
    if(empty($input_session)){
        $session_err = "Please enter the session.";     
    } elseif(!ctype_digit($input_session)){
        $session_err = "Please enter a positive session value.";
    } else{
        $session = $input_session;
    }
    // Validate Batch
    $input_Batch = trim($_POST["Batch"]);
    if(empty($input_Batch)){
        $Batch_err = "Please enter a Batch.";
    } elseif(!filter_var($input_Batch, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $Batch_err = "Please enter a valid Batch.";
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
    // // Validate Batch
    // $input_Batch= trim($_POST["Batch"]);
    // if(empty($input_Batch)){
    //     $Batch_err = "Please enter the Batch.";     
    // } elseif(!ctype_digit($input_Batch)){
    //     $Batch_err = "Please enter a positive integer value.";
    // } else{
    //     $Batch = $input_Batch;
    // }
    
    // Check input errors before inserting in database
    if(empty($name_err) && empty($session_err) && empty($Batch_err) ){
        // Prepare an insert statement
        $sql = "INSERT INTO students (name, session, Batch, Subject1,Subject2,Subject3,Subject4 ) VALUES (?, ?, ?, ?,?,?,?)";
         
        if($stmt = mysqli_prepare($conn, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sssssss", $param_name, $param_session, $param_Batch,$param_Subject1,$param_Subject2,$param_Subject3,$param_Subject4);
            
            // Set parameters
            $param_name = $name;
            $param_session = $session;
            $param_Batch = $Batch;
            $param_Subject1 = $Subject1;
            $param_Subject2 = $Subject2;
            $param_Subject3 = $Subject3;
            $param_Subject4 = $Subject4;

            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records created successfully. Redirect to landing page
                header("location: index.php");
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
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Record</title>
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
                    <h2 class="mt-5">Create Record</h2>
                    <p>Please fill this form and submit to add employee record to the database.</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control <?php echo (!empty($name_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $name; ?>">
                            <span class="invalid-feedback"><?php echo $name_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Session</label>
                            <input type="text" name="session" class="form-control <?php echo (!empty($session_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $session; ?>">
                            <span class="invalid-feedback"><?php echo $session_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Batch</label>
                            <textarea name="Batch" class="form-control <?php echo (!empty($Batch_err)) ? 'is-invalid' : ''; ?>"><?php echo $Batch; ?></textarea>
                            <span class="invalid-feedback"><?php echo $Batch_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Subject1</label>
                            <input type="text" name="Subject1" class="form-control <?php echo (!empty($Marks_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $Subject1; ?>">
                            <span class="invalid-feedback"><?php echo $Marks_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Subject2</label>
                            <input type="text" name="Subject2" class="form-control <?php echo (!empty($Marks_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $Subject2; ?>">
                            <span class="invalid-feedback"><?php echo $Marks_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Subject3</label>
                            <input type="text" name="Subject3" class="form-control <?php echo (!empty($Marks_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $Subject3; ?>">
                            <span class="invalid-feedback"><?php echo $Marks_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Subject4</label>
                            <input type="text" name="Subject4" class="form-control <?php echo (!empty($Marks_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $Subject4; ?>">
                            <span class="invalid-feedback"><?php echo $Marks_err;?></span>
                        </div>
                        
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="index.php" class="btn btn-secondary ml-2">Cancel</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>