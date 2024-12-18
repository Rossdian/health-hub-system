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
<style>
    p.About {
        width: 900px;
        color:black;
        font-size:20px;
        margin-left:120px;
        padding-right:400px;
        margin-top: 150px;
        line-height: 1.8;
    }
</style>

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
                           <p class="About"> Welcome to Health Hub! Our database system is designed 
                            to efficiently manage and store essential information for both staff and 
                            patients at our clinic. From recording patient files to maintaining staff
                            records, our system ensures seamless organization and accessibility of vital 
                            healthcare data. With Health Hub, streamline your clinic's operations and focus
                            on delivering exceptional care your patients.
                            
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

