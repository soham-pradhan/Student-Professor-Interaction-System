<?php
// Include config file
session_start();
require("config.php");

// Define variables and initialize with empty values
$username = $password = $confirm_password = "";
$username_err = $password_err = $confirm_password_err = "";
$f_name = "";
$m_name = "";
$l_name = "";
$dob = "";
$m_number = "";
$email = "";
$gender = "";
$blood_group = "";
$department = "";
$course = "";
$class = "";
$division = "";
$batch = "";
$roll_number = "";
$flat_number = "";
$road = "";
$landmark = "";
$area = "";
$city = "";
$pincode = "";
$state = "";
$t_number = "";



 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate username
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter a username.";
    } else{
        // Prepare a select statement
        $sql = "SELECT id FROM users WHERE (username = ?) AND (f_name=?) AND (m_name=?) AND (l_name=?) AND (dob=?) AND (m_number=?) AND (email=?) AND (gender=?) AND (blood_group=?) AND (department=?) AND (course=?) AND (class=?) AND (division=?) AND (batch=?) AND (roll_number=?) AND (flat_number=?) AND (road=?) AND (landmark=?) AND (area=?) AND (city=?) AND (pincode=?) AND (state=?) AND (t_number=?)";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sssssssssssssssssssssss", $param_username,$param_f_name,$param_m_name,$param_l_name,$param_dob,$param_m_number,$param_email,$param_gender,$param_blood_group,$param_department,$param_course,$param_class,$param_division,$param_batch,$param_roll_number,$param_flat_number,$param_road,$param_landmark,$param_area,$param_city,$param_pincode,$param_state,$param_t_number);
            
            // Set parameters
            $param_username    = trim($_POST["username"]);
            $param_f_name      = trim($_POST["f_name"]);
            $param_m_name      = trim($_POST["m_name"]);
            $param_l_name      = trim($_POST["l_name"]);
            $param_dob         = trim($_POST["dob"]);
            $param_m_number    = trim($_POST["m_number"]);
            $param_email       = trim($_POST["email"]);
            $param_gender      = trim($_POST["gender"]);
            $param_blood_group = trim($_POST["blood_group"]);
            $param_department  = trim($_POST["department"]);
            $param_course      = trim($_POST["course"]);
            $param_class       = trim($_POST["class"]);
            $param_division    = trim($_POST["division"]);
            $param_batch       = trim($_POST["batch"]);
            $param_roll_number = trim($_POST["roll_number"]);
            $param_flat_number = trim($_POST["flat_number"]);
            $param_road        = trim($_POST["road"]);
            $param_landmark    = trim($_POST["landmark"]);
            $param_area        = trim($_POST["area"]);
            $param_city        = trim($_POST["city"]);
            $param_pincode     = trim($_POST["pincode"]);
            $param_state       = trim($_POST["state"]);
            $param_t_number    = trim($_POST["t_number"]);

            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $username_err = "This username is already taken.";
                } else{
                    $username    = trim($_POST["username"]);
                    $f_name      = trim($_POST["f_name"]);
                    $m_name      = trim($_POST["m_name"]);
                    $l_name      = trim($_POST["l_name"]);
                    $dob         = trim($_POST["dob"]);
                    $m_number    = trim($_POST["m_number"]);
                    $email       = trim($_POST["email"]);
                    $gender      = trim($_POST["gender"]);
                    $blood_group = trim($_POST["blood_group"]);
                    $department  = trim($_POST["department"]);
                    $course      = trim($_POST["course"]);
                    $class       = trim($_POST["class"]);
                    $division    = trim($_POST["division"]);
                    $batch       = trim($_POST["batch"]);
                    $roll_number = trim($_POST["roll_number"]);
                    $flat_number = trim($_POST["flat_number"]);
                    $road        = trim($_POST["road"]);
                    $landmark    = trim($_POST["landmark"]);
                    $area        = trim($_POST["area"]);
                    $city        = trim($_POST["city"]);
                    $pincode     = trim($_POST["pincode"]);
                    $state       = trim($_POST["state"]);
                    $t_number    = trim($_POST["t_number"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
         // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Validate password
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter a password.";     
    } elseif(strlen(trim($_POST["password"])) < 6){
        $password_err = "Password must have atleast 6 characters.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm password.";     
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
    }
    
    // Check input errors before inserting in database
    if(empty($username_err) && empty($password_err) && empty($confirm_password_err)){
        
        // Prepare an insert statement
        $sql = "INSERT INTO users (username,password,f_name,m_name,l_name,dob,m_number,email,gender,blood_group,department,course,class,division,batch,roll_number,flat_number,road,landmark,area,city,pincode,state,t_number) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ssssssssssssssssssssssss", $param_username, $param_password,$param_f_name,$param_m_name,$param_l_name,$param_dob,$param_m_number,$param_email,$param_gender,$param_blood_group,$param_department,$param_course,$param_class,$param_division,$param_batch,$param_roll_number,$param_flat_number,$param_road,$param_landmark,$param_area,$param_city,$param_pincode,$param_state,$param_t_number);
            
            // Set parameters
            $param_username    = $username;
            $param_password    = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            $param_f_name      = $f_name;
            $param_m_name      = $m_name;
            $param_l_name      = $l_name;
            $param_dob         = $dob;
            $param_m_number    = $m_number;
            $param_email       = $email;
            $param_gender      = $gender;
            $param_blood_group = $blood_group;
            $param_department  = $department;
            $param_course      = $course;
            $param_class       = $class;
            $param_division    = $division;
            $param_batch       = $batch;
            $param_roll_number = $roll_number;
            $param_flat_number = $flat_number;
            $param_road        = $road;
            $param_landmark    = $landmark;
            $param_area        = $area;
            $param_city        = $city;
            $param_pincode     = $pincode;
            $param_state       = $state;
            $param_t_number    = $t_number;
            
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Redirect to login page
                header("location: login.php");
            } else{
                echo "Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Close connection
    mysqli_close($link);
}

?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign Up</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif; }
        .wrapper{ width: 350px; padding: 20px; }
        table{ width:400%; height: 20px; cell-spacing:"20";text-align:center}
    </style>
</head>
<body>
    <div class="wrapper">
        <h2>Sign Up</h2>
        <p>Please fill this form to create an account.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <br><legend>Account Details</legend>
            <table>
            <tr>
            <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                <td><label>Username</label></td>
                <td><input type="text" name="username" class="form-control" value="<?php echo $username; ?>"></td>
                <span class="help-block"><?php echo $username_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <td><label>Password</label>
                <td><input type="password" name="password" class="form-control" value="<?php echo $password; ?>"></td>
                <span class="help-block"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                <td><label>Confirm Password</label></td>
                <td><input type="password" name="confirm_password" class="form-control" value="<?php echo $confirm_password; ?>"></td>
                <span class="help-block"><?php echo $confirm_password_err; ?></span>
            </div>
            </tr>
            </table>
            <br><br><legend>Personal Details</legend>
            <table>
            <tr>
            <div class="form-group">
                <td><label>First Name</label></td>
                <td><input type="text" name="f_name" class="form-control" value="<?php echo $f_name; ?>"></td>
            </div>
            <div class="form-group">
                <td><label>Middle Name</label></td>
                <td><input type="text" name="m_name" class="form-control" value="<?php echo $m_name; ?>"></td>
            </div>
            <div class="form-group">
                <td><label>Last Name</label></td>
                <td><input type="text" name="l_name" class="form-control" value="<?php echo $l_name; ?>"></td>
            </div>
            </tr>
            <tr>
            <div class="form-group">
                <td><label>Date of Birth</label></td>
                <td><input type="date" name="dob" class="form-control" value="<?php echo $dob; ?>"></td>
            </div>
            <div class="form-group">
                <td><label>Mobile Number</label></td>
                <td><input type="text" name="m_number" class="form-control" value="<?php echo $m_number; ?>"></td>
            </div>
            <div class="form-group">
                <td><label>Email</label></td>
                <td><input type="text" name="email" class="form-control" value="<?php echo $email; ?>"></td>
            </div>
            </tr>
            <tr>
            <div class="form-group">
                <td><label>Gender</label></td>
                <td><input type="text" name="gender" class="form-control" value="<?php echo $gender; ?>"><!--<div class="radio"><label><input type="radio" name="gender" checked value="Male">Male</label></div></td>
                <td><div class="radio"><label><input type="radio" name="gender" value="Female">Female</label></div></td>
                <td><div class="radio disabled"><label><input type="radio" name="gender" value="Other">Other</label></div>--></td>
            </div>
            <div class="form-group">
                <td><label>Blood Group</label></td>
                <td><input type="text" name="blood_group" class="form-control" value="<?php echo $blood_group; ?>"><!--<select class="form-control" name="blood_group"><option value="A+" >A+</option><option value="A-" >A-</option><option value="B+" >B+</option><option value="B-" >B-</option><option value="AB+" >AB+</option><option value="AB-" >AB-</option><option value="O+" >O+</option><option value="O-">O-</option></select>--></td>
            </div>
            </tr>
            </table>
            <br><br><legend>Academic Details</legend>
            <table>
            <tr>
            <div class="form-group">
                <td><label>Department</label></td>
                <td><input type="text" name="department" class="form-control" value="<?php echo $department; ?>"></td>
            </div>
            <div class="form-group">
                <td><label>Course</label></td>
                <td><input type="text" name="course" class="form-control" value="<?php echo $course; ?>"></td>
            </div>
            <div class="form-group">
                <td><label>Class</label></td>
                <td><input type="text" name="class" class="form-control" value="<?php echo $class; ?>"><!--<select class="form-control" id="sel1"><option>FE</option><option>SE</option><option>TE</option><option>BE</option></select>--></td>
            </div>
            </tr>
            <tr>
            <div class="form-group">
                <td><label>Division</label></td>
                <td><input type="text" name="division" class="form-control" value="<?php echo $division; ?>"><!--<select class="form-control" id="sel1"><option>A</option><option>B</option><option>C</option></select>--></td>
            </div>
            <div class="form-group">
                <td><label>Batch</label></td>
                <td><input type="text" name="batch" class="form-control" value="<?php echo $batch; ?>"><!--<select class="form-control" id="sel1"><option>1</option><option>2</option><option>3</option><option>4</option></select>--></td>
            </div>
            <div class="form-group">
                <td><label>Roll Number</label></td>
                <td><input type="text" name="roll_number" class="form-control" value="<?php echo $roll_number; ?>"></td>
            </div>
            </tr>
            </table>
            <br><br><legend>Address Details</legend>
            <table>
            <tr>
            <div class="form-group">
                <td><label>Flat & Building</label></td>
                <td><input type="text" name="flat_number" class="form-control" value="<?php echo $flat_number; ?>"></td>
            </div>
            <div class="form-group">
                <td><label>Road</label></td>
                <td><input type="text" name="road" class="form-control" value="<?php echo $road; ?>"></td>
            </div>
            <div class="form-group">
                <td><label>Landmark</label></td>
                <td><input type="text" name="landmark" class="form-control" value="<?php echo $landmark; ?>"></td>
            </div>
            </tr>
            <tr>
            <div class="form-group">
                <td><label>Area</label></td>
                <td><input type="text" name="area" class="form-control" value="<?php echo $area; ?>"></td>
            </div>
            <div class="form-group">
                <td><label>City</label></td>
                <td><input type="text" name="city" class="form-control" value="<?php echo $city; ?>"></td>
            </div>
            <div class="form-group">
                <td><label>Pincode</label></td>
                <td><input type="text" name="pincode" class="form-control" value="<?php echo $pincode; ?>"></td>
            </div>
            </tr>
            <tr>
            <div class="form-group">
                <td><label>Telephone</label></td>
                <td><input type="text" name="t_number" class="form-control" value="<?php echo $t_number; ?>"></td>
            </div>
            <div class="form-group">
                <td><label>State</label></td>
                <td><input type="text" name="state" class="form-control" value="<?php //echo $state; ?>"><!--<select class="form-control" id="sel1"><option>Andaman Nicobar Islands</option><option>Andhra Pradesh</option><option>Arunachal Pradesh</option><option>Assam</option><option>Bihar</option><option>Chandigarh</option><option>Chhattisgarh</option><option>Dadra & Nagar Haveli</option><option>Daman & Diu</option><option>Goa</option><option>Gujarat</option><option>Haryana</option><option>Himachal Pradesh</option><option>Jammu & Kashmir</option><option>Jharkhand</option><option>Karnataka</option><option>Kerala</option><option>Lakshadweep</option><option>Madhya Pradesh</option><option>Maharashtra</option><option>Manipur</option><option>Meghalaya</option><option>Mizoram</option><option>Nagaland</option><option>Odisha</option><option>Puducherry</option><option>Punjab</option><option>Rajasthan</option><option>Sikkim</option><option>Tamil Nadu</option><option>Telangana</option><option>The Government Of NCT of Delhi</option><option>Tripura</option><option>Utarakhand</option><option>Uttar Pradesh</option><option>West Bengal</option></select>--></td>
            </div>
            </tr>
            </table>
            <br><br><div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
                <input type="reset" class="btn btn-default" value="Reset">
            </div>
            <p>Already have an account? <a href="login.php">Login here</a>.</p>
        </form>
    </div>
</body>
</html>