
<?php
session_start();
// Check if the user is logged in, if not then redirect him to login page
require("config.php");
$mysqli = new mysqli("localhost", "root", "", "project");

/* check connection */
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}
$obj="";
$obj = $_SESSION["username"];

$query = "SELECT username,f_name,m_name,l_name,dob,m_number,email,gender,blood_group,flat_number,road,landmark,area,city,state,pincode,t_number,department,course,class,division,batch,roll_number FROM users WHERE username = '$obj'";

if ($stmt = $mysqli->prepare($query)) {

    /* execute statement */
    $stmt->execute();

    /* bind result variables */
    $stmt->bind_result($username,$f_name,$m_name,$l_name,$dob,$m_number,$email,$gender,$blood_group,$flat_number,$road,$landmark,$area,$city,$state,$pincode,$t_number,$department,$course,$class,$division,$batch,$roll_number);
    $stmt->fetch();
    /* close statement */
    $stmt->close();
}

/* close connection */
$mysqli->close();
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}



function fetch_data()  
 {  
      $object="";
      $object= $_SESSION["username"];
      $output = '';  
      $conn = mysqli_connect("localhost", "root", "", "project");  
      $sql = "SELECT username,f_name,m_name,l_name from users WHERE username = '$object'";  
      $result = mysqli_query($conn, $sql);  
      while($row = mysqli_fetch_array($result))  
      {       
      $output .= '<tr>  
                          <td>First Name&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$row["f_name"].'</td>
                  </tr>
                  <tr>        
                          <td>Middle Name&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$row["m_name"].'</td>
                  </tr>
                  <tr>        
                          <td>Last Name&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$row["l_name"].'</td>  
                     </tr>

                          ';  
      }  
      return $output;
 }     
      
if(isset($_POST["generate_pdf"]))  
 {  

      require_once('tcpdf/tcpdf.php'); 
      $obj_pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);  
      $obj_pdf->SetCreator(PDF_CREATOR);  
      $obj_pdf->SetTitle("Student information");  
      $obj_pdf->SetHeaderData('', '', PDF_HEADER_TITLE, PDF_HEADER_STRING);  
      $obj_pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));  
      $obj_pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));  
      $obj_pdf->SetDefaultMonospacedFont('helvetica');  
      $obj_pdf->SetFooterMargin(PDF_MARGIN_FOOTER);  
      $obj_pdf->SetMargins(PDF_MARGIN_LEFT, '10', PDF_MARGIN_RIGHT);  
      $obj_pdf->setPrintHeader(false);  
      $obj_pdf->setPrintFooter(false);  
      $obj_pdf->SetAutoPageBreak(TRUE, 10);  
      $obj_pdf->SetFont('helvetica', '', 11);  
      $obj_pdf->AddPage(); 
      $content = '';  
      $content .= '  
      <h4 align="center">Student information data from MYSQL to PDF </h4><br><br><br />  
      ';  
      $content .= fetch_data();  
      $content .= '</table>';  
      $obj_pdf->writeHTML($content);
      ob_end_clean(); 
      $obj_pdf->Output('file.pdf', 'I');
 }  
     
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1">
    <title>Welcome</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        body {font-family: Helvetica;}

        .purna {

        }

        /* STYLE OF SIDE NAV BAR STARTS HERE */

        .sidenav {
    height: 100%;
    width: 200px;
    position: fixed;
    z-index: 1;
    top: 0;
    left: 0;
    background-color: #111;
    overflow-x: hidden;
    padding-top: 20px;
}

/* Style the sidenav links and the dropdown button */
.sidenav a, .dropdown-btn {
    padding: 6px 8px 6px 16px;
    text-decoration: none;
    font-size: 20px;
    color: #818181;
    display: block;
    border: none;
    background: none;
    width: 100%;
    text-align: left;
    cursor: pointer;
    outline: none;
}

/* On mouse-over */
.sidenav a:hover, .dropdown-btn:hover {
    color: #f1f1f1;
}

/* Main content */
.main {
    margin-left: 200px; /* Same as the width of the sidenav */
    font-size: 20px; /* Increased text to enable scrolling */
    padding: 0px 10px;
}

/* Add an active class to the active dropdown button */
.active {
    background-color: black;
    color: white;
}

/* Dropdown container (hidden by default). Optional: add a lighter background color and some left padding to change the design of the dropdown content */
.dropdown-container {
    display: none;
    background-color: #262626;
    padding-left: 8px;
}

/* Optional: Style the caret down icon */
.fa-caret-down {
    float: right;
    padding-right: 8px;
}

/* Some media queries for responsiveness */
@media screen and (max-height: 450px) {
    .sidenav {padding-top: 15px;}
    .sidenav a {font-size: 18px;}
}    

        

        /* STYLE OF SIDE NAVBAR ENDS HERE */

        /* STYLE OF FAT TAB STARTS HERE */
        /* Style the tab */

        .tab {
            overflow: hidden;
            border: 1px solid #ccc;
            background-color: #dddddd;
            margin-left : 198px;
        }

        /* Style the buttons inside the tab */
        .tab button {
            background-color: inherit;
            float: left;
            border: none;
            outline: none;
            cursor: pointer;
            padding: 14px 16px;
            transition: 0.3s;
            font-size: 17px;
        }

        /* Change background color of buttons on hover */
        .tab button:hover {
            background-color: #000000;
            color :white;
        }

        /* Create an active/current tablink class */
        .tab button.active {
            background-color: #000000;
            color :white;
        }

        /* Style the tab content */
        .tabcontent {
            display: none;
            padding: 6px 12px;
            border: 1px solid #ccc;
            border-top: none;
            margin-left :200px;
        }

        /* Style the close button */
        .topright {
            float: right;
            cursor: pointer;
            font-size: 28px;
        }

        .topright:hover {color: red;}
        .info {
            margin-top : 30px;
            margin-left : 50px;
            margin-right : 50px;
        }

        /* STYLE OF FAT TAB ENDS HERE */

        /* STYLE OF TOP NAVBAR STARTS HERE */


        /* STYLE OF TOP NAVBAR ENDS HERE */

        /* STYLE OF SOCIAL MEDIA BUTTONS STARTS HERE */    
            .fa:hover {
                opacity: 0.7;
            }

            .fa-facebook{
                background: #3B5998;
                color: white;
                size : 150 %;

            }

            .fa-instagram {
                background: #125688;
                color: white;
            }

        /* STYLE OF SOCIAL MEDIA BUTTONS ENDS HERE */


    </style>
</head>
<body>

    <div class="purna">
        <div class="page-header">
            <h2 style="text-align : right;margin-right: 50px;">Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>.</h2>
            <p style="margin-left : 1000px;">
            <a href="reset-password.php" class="btn btn-warning">Reset Your Password</a>
            <a href="logout.php" class="btn btn-danger">Sign Out of Your Account</a>
            </p>
        </div>
        <!--CODE OF SIDE NAVBAR STARTS HERE-->
        <div class="sidenav">
            <a href="#">About</a>
            <a href="#">Timetable</a>
            <a href="#">To do list</a>
            <form method="post">
            <input type="submit" name="generate_pdf" target="_blank" class="btn btn-success" value="Generate PDF" />
            </form>
            <button class="dropdown-btn">Activity 
                <i class="fa fa-caret-down"></i>
            </button>
            <div class="dropdown-container">
                <a href="http://csi.vit.edu.in/" target="_blank">CSI</a>
                <a href="https://ieee.vit.edu.in/" target="_blank">IEEE</a>
                <a href="http://cesavitmumbai.blogspot.com/p/about-us.html" target="_blank">CESA</a>
                <a href="http://vit.edu.in/acm/" target="_blank">ACM</a>
                <a href="http://vit.edu.in/student-council/" target="_blank">Student Council</a>
            </div>
            <br><br><br><br><br><br>
            <a href="#" class="fa fa-facebook"></a>
            <a href="#" class="fa fa-twitter"></a>
        </div>

        <!--CODE OF SIDE NAVBAR ENDS HERE-->

        <!-- CODE OF FAT TAB STARTS HERE-->

        <div class="info">
            <div class="tab">
                <button class="tablinks" onclick="openCity(event, 'personal_details')" id="defaultOpen">Personal Details</button>
                <button class="tablinks" onclick="openCity(event, 'address_details')">Address Details</button>
                <button class="tablinks" onclick="openCity(event, 'academic_details')">Academic Details</button>
                <button class="tablinks" onclick="openCity(event, 'achievements')">Achievements</button>

            </div>

            <div id="personal_details" class="tabcontent">
                <span onclick="this.parentElement.style.display='none'" class="topright">&times</span>
                <!--
                <table cellspacing="5">
                    <tr>

                        <td><h3 style="margin-left : 50px;">First Name</h3></td>
                        <td><?php //echo $f_name; ?></td>
                        <td><h3 style="margin-left :100px;">Middle Name</h3></td>
                        <td><?php //echo $m_name; ?></td>
                        <td><h3 style="margin-left :100px;">Last Name</h3></td>
                        <td><?php //echo $l_name; ?></td>
                    </tr>
                    <tr>
                        <td><h3 style="margin-left : 50px;">Date Of Birth</h3></td>
                        <td><?php //echo $dob; ?></td>
                        <td><h3 style="margin-left :100px;">Mobile Number</h3></td>
                        <td><?php //echo $m_number; ?></td>
                        <td><h3 style="margin-left :100px;">Email</h3></td>
                        <td><?php //echo $email; ?></td>
                    </tr>
                    <tr>
                        <td><h3 style="margin-left : 50px;">Gender</h3></td>
                        <td><?php //echo $gender; ?></td>
                        <td><h3 style="margin-left :100px;">Blood Group</h3></td>
                        <td><?php //echo $blood_group; ?></td>
                    </tr>
                </table>
                -->
            <h2><span class="glyphicon glyphicon-user"></span> Personal Details</h2>
            <p style="border-bottom-style: solid; border-color: black"></p>
            <table style="width:40%">
                <tr>
                    <td><h4>First Name</h4></td>
                    <td><h4><?php echo $f_name; ?></h4></td>
                </tr>
                <tr>
                    <td><h4>Middle Name</h4></td>
                    <td><h4><?php echo $m_name; ?><h4></td>
                </tr>
                <tr>
                    <td><h4>Last Name</h4></td>
                    <td><h4><?php echo $l_name; ?><h4></td>
                </tr>
                <tr>
                    <td><h4>Date Of Birth</h4></td>
                    <td><h4><?php echo $dob; ?><h4></td>
                </tr>
                <tr>
                    <td><h4>Mobile Number</h4></td>
                    <td><h4><?php echo $m_number; ?><h4></td>
                </tr>
                <tr>
                    <td><h4>Email</h4></td>
                    <td><h4><?php echo $email; ?><h4></td>
                </tr>
                <tr>
                    <td><h4>Gender</h4></td>
                    <td><h4><?php echo $gender; ?><h4></td>
                </tr>
                <tr>
                    <td><h4>Blood Group</h4></td>
                    <td><h4><?php echo $blood_group; ?><h4></td>
                </tr>
            </table>
            </div>
            <div id="address_details" class="tabcontent">
            <h2><span class="glyphicon glyphicon-home"></span> Address Details</h2>
            <p style="border-bottom-style: solid; border-color: black"></p>
            <table style="width:40%">
                <tr>
                    <td><h4>Flat No. & Building</h4></td>
                    <td><h4><?php echo $flat_number; ?></h4></td>
                </tr>
                <tr>
                    <td><h4>Road</h4></td>
                    <td><h4><?php echo $road; ?><h4></td>
                </tr>
                <tr>
                    <td><h4>Landmark</h4></td>
                    <td><h4><?php echo $landmark; ?><h4></td>
                </tr>
                <tr>
                    <td><h4>Area</h4></td>
                    <td><h4><?php echo $area; ?><h4></td>
                </tr>
                <tr>
                    <td><h4>City</h4></td>
                    <td><h4><?php echo $city; ?><h4></td>
                </tr>
                <tr>
                    <td><h4>State</h4></td>
                    <td><h4><?php echo $state; ?><h4></td>
                </tr>
                <tr>
                    <td><h4>Pincode</h4></td>
                    <td><h4><?php echo $pincode; ?><h4></td>
                </tr>
                <tr>
                    <td><h4>Telephone</h4></td>
                    <td><h4><?php echo $t_number; ?><h4></td>
                </tr>
            </table>
            </div>

            <div id="academic_details" class="tabcontent">
            <span onclick="this.parentElement.style.display='none'" class="topright">&times</span>
            <h2><span class="glyphicon glyphicon-book"></span> Academic Details</h2>
            <p style="border-bottom-style: solid; border-color: black"></p>
            <table style="width:40%">
                <tr>
                    <td><h4>Department</h4></td>
                    <td><h4><?php echo $department; ?></h4></td>
                </tr>
                <tr>
                    <td><h4>Course</h4></td>
                    <td><h4><?php echo $course; ?><h4></td>
                </tr>
                <tr>
                    <td><h4>Class</h4></td>
                    <td><h4><?php echo $class; ?><h4></td>
                </tr>
                <tr>
                    <td><h4>Division</h4></td>
                    <td><h4><?php echo $division; ?><h4></td>
                </tr>
                <tr>
                    <td><h4>Batch</h4></td>
                    <td><h4><?php echo $batch; ?><h4></td>
                </tr>
                <tr>
                    <td><h4>Roll Number</h4></td>
                    <td><h4><?php echo $roll_number; ?><h4></td>
                </tr>
            </table>
            </div>

            <div id="achievements" class="tabcontent">
            <span onclick="this.parentElement.style.display='none'" class="topright">&times</span>
            <h2><span class="glyphicon glyphicon-education"></span> Achievements</h2>
            <p style="border-bottom-style: solid; border-color: black"></p>
            </div>
    </div>
</div>
 <!-- CODE OF FAT TAB ENDS HERE-->

 <script>

function openNav() {
  document.getElementById("myNav").style.width = "50%";
}

function closeNav() {
  document.getElementById("myNav").style.width = "0%";
}
/* JS for fat tab starts here*/

function openCity(evt, cityName) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    document.getElementById(cityName).style.display = "block";
    evt.currentTarget.className += " active";
}

/* JS for fat tab ends here*/


/* JS for sidenav starts here*/

// Get the element with id="defaultOpen" and click on it
document.getElementById("defaultOpen").click();

var dropdown = document.getElementsByClassName("dropdown-btn");
var i;

for (i = 0; i < dropdown.length; i++) {
  dropdown[i].addEventListener("click", function() {
    this.classList.toggle("active");
    var dropdownContent = this.nextElementSibling;
    if (dropdownContent.style.display === "block") {
      dropdownContent.style.display = "none";
    } else {
      dropdownContent.style.display = "block";
    }
  });
}

/* JS for sidenav ends here*/

</script>

</body>
</html>