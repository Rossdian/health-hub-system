<?php

    //Start the session
    session_start();
    if(!isset($_SESSION['user']))header('location: ../index.php');
    
    $user = ($_SESSION['user']);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Health Hub Clinic</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../images/HealthHub.png" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="../css/all.min.css">
    <link rel="stylesheet" type="text/css" href="../css/all.css">
    <link rel="stylesheet" type="text/css" href="../css/styles.css">
   
</head>


<body>

    <main class="main-wrap">
    <?php include('../html/navigation.php'); ?>
        <section class="showcase active">
            <div class="overlay">
                <div class="head">
                    <button class="toggler">
                        <i class="fa-solid fa-bars-staggered" style="color: rgb(66, 6, 6);"></i>
                    </button>
                    <div class="top">                 
                    </div>

                </div>
                
                <div class="content">     
                        <p class="About">
                        Welcome to our System Help Guide! We're here to make navigating our platform a breeze. Follow these simple steps to make the most of our features: <br>
                       <p class="Step"><strong>Step 1</strong> - Patients Navigation: <br></p>
                                <div class= "step-con">
                                - Click on "Patients" in the main menu to access patient information. <br>
                                - Select "Add Info" to input patient details. <br>
                                - Click on "Create" to save the information. <br>
                                </div>
                       <p class="Step"><strong>Step 2</strong> - Incident Reporting: <br></p>
                                <div class= "step-con"> 
                                - Navigate to "Incident Report" from the main menu. <br>
                                - Choose "Add Report" to document incidents. <br>
                                - Click on "Create" to submit the report. <br>
                                  </div>
                        <p class="Step"><strong>Step 3</strong> - Medication Prescription: <br></p>
                                <div class= "step-con"> 
                                - Head over to "Med Prescription" in the menu. <br>
                                - Select "Add Prescription" to prescribe medication. <br>
                                - Click on "Create" to finalize the prescription. <br>
                                  </div>
                        </p>            
                </div>
                
            </div>
        </section>

        <div id="logoutModal" class="model">
            <div class="model-content">
              <p>Are you sure you want to leave?</p>
              <button onclick="logout()">Leave</button>
              <button onclick="closeModal()">Stay</button>
            </div>
          </div>
          
        
    </main>

    <?php include('../includes/scripts.php'); ?>

    <style>
    p.About {
        width: 900px;
        color:black;
        font-size:16px;
        margin-left:100px;
        padding-right:400px;
        margin-top: 50px;
        line-height: 1.8;
        text-align: left;

    }
    .step-con{
        margin-top:10px;
        text-align: left;
        color:black;
        font-size:16px;
        margin-left:130px;
        line-height: 1.8;s
    }
    p.Step {
        width: 900px;
        color:black;
        font-size:16px;
        margin-left:100px;
        padding-right:400px;
        margin-top: 30px;
        line-height: 1.8;
        text-align: left;

    }
</style>