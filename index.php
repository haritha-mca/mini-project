<?php

if(isset($_POST['submit']))
{
    $name=$_POST['fullname'];
    $email=$_POST['emailid'];
    $mobileno=$_POST['mobileno'];
    $dscrption=$_POST['description'];
    $query=mysqli_query($con,"insert into tblcontactus(fullname,email,contactno,message) value('$name','$email','$mobileno','$dscrption')");
    echo "<script>alert('Your information successfully submitted');</script>";
    echo "<script>window.location.href ='index.php'</script>";
} 
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title> Medalert Access System </title>
</head>

<body>

    <!-- Header -->
    <header id="menu-jk">
        <div class="header-nav" style="padding: 10px; background-color: #f8f9fa; border-bottom: 1px solid #ddd;">
            <div style="max-width: 1200px; margin: auto;">
                <div style="display: flex; justify-content: space-between; align-items: center;">
                    <div style="font-weight: bold; font-size: 42px;">Medalert Access System</div>
                    <nav style="flex-grow: 1; text-align: center;">
                        <ul style="list-style: none; padding: 0; margin: 0; display: inline-block;">
                            <li style="display: inline-block; margin: 0 15px;"><a href="#">Home</a></li>
                            <li style="display: inline-block; margin: 0 15px;"><a href="#logins">Logins</a></li>  
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </header>
    
    <!-- Slider -->
    <div class="slider-detail" style="max-width: 1200px; margin: 20px auto;">
        <div style="position: relative; width: 100%; height: 300px; background-color: #ccc;">
            <img src="assets/images/slider/slider_3.jpg" alt="Third slide" style="width: 100%; height: 100%; object-fit: cover;">
            <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.5);"></div>
            <div style="position: absolute; bottom: 20px; left: 20px; color: #fff;">
                <h5>Medalert Access System</h5>
            </div>
        </div>
    </div>
    
    <!-- Logins -->
    <section id="logins" style="max-width: 1200px; margin: auto; padding: 20px 0;">
        <h2>Logins</h2>
        <div style="display: flex; justify-content: space-between;">
            <div style="width: 30%; text-align: center;">
                <img src="assets/images/patient.jpg" alt="" style="width: 100%; height: auto;">
                <h6>Patient Login</h6>
                <a href="hms/user-login.php" target="_blank">
                    <button style="padding: 8px 16px; background-color: green; color: #fff; border: none; border-radius: 4px;">Click Here</button>
                </a>
            </div>
            <div style="width: 30%; text-align: center;">
                <img src="assets/images/doctor.jpg" alt="" style="width: 100%; height: auto;">
                <h6>Doctors Login</h6>
                <a href="mas/doctor_login" target="_blank">
                    <button style="padding: 8px 16px; background-color: green; color: #fff; border: none; border-radius: 4px;">Click Here</button>
                </a>
            </div>
            <div style="width: 30%; text-align: center;">
                <img src="assets/images/admin.jpg" alt="" style="width: 100%; height: auto;">
                <h6>Admin Login</h6>
                <a href="hms/admin" target="_blank">
                    <button style="padding: 8px 16px; background-color: green; color: #fff; border: none; border-radius: 4px;">Click Here</button>
                </a>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer style="padding: 20px; background-color: #f8f9fa; text-align: center;">
        <p>Medalert Access System</p>
    </footer>

</body>
</html>
