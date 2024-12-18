<?php

    //Start the session
    session_start();
    if(!isset($_SESSION['user']))header('location: ../index.php');
    $_SESSION['table'] = 'clinic_staffs';
    $user = ($_SESSION['user']);

    include('../includes/header.php');

?>

    <main class="main-wrap">
    <?php include('../html/navigation.php'); ?>
        <section class="showcase active">
            <div class="overlay">
                <div class="head">
                    <button class="toggler">
                        <i class="fa-solid fa-bars-staggered" style="color: rgb(66, 6, 6);"></i>
                    </button>
                    <div class="top">                 
                        <input class="search-bar" type="text" id="search" placeholder="Search">
                        <button type="button" class="search" onclick="searchFunction()">Search</button>
                         
                        <span><?= $user['firstName'] ?></span> 
                        <button class="log-out" onclick="openModal()">
                            <i class="fa-solid fa-right-from-bracket" style="color: #ffffff;"></i>
                        </button>       
                    </div>

                </div>
                
                <div class="content">
                    <div class="formcontainer">
                        <div class="clinichead">
                            <h1 class="cs1"><i class="fa-solid fa-plus" style="color: #ffffff;"></i> INSERT CLINIC STAFF</h1>
                            <div class="Add">
                                <a href="../html/clinic_staff.php" class="icon-link">
                                    <button class="back">BACK</button>
                                </a>
                            </div>
                        </div>
                        <form action="../database/add.php" method="POST" class="addclinicstaff">
                            <div class="ClinicStaffContainer">
                                <label for="full_name">Full Name</label>
                                <input type="text" class="clinicInput" id="full_name" name="full_name" required/>
                            </div>
                            <div class="ClinicStaffContainer">
                                <label for="role">Role</label>
                                <input type="text" class="clinicInput" id="role" name="role" required/>
                            </div>
                            <div class="ClinicStaffContainer">
                                <label for="address">Address</label>
                                <input type="text" class="clinicInput" id="address" name="address" required/>
                            </div>
                            <div class="ClinicStaffContainer">
                                <label for="number">Contact Number</label>
                                <input type="text" class="clinicInput" id="number" name="number" required/>
                            </div>
                            <div class="ClinicStaffContainer">
                                <label for="specialization">Specialization</label>
                                <input type="text" class="clinicInput" id="specialization" name="specialization" required/>
                            </div>
                            <button type="submit" class="appBtn"><i class="fa-solid fa-plus"></i> CREATE </button>
                        </form> 
                        <?php 
                        if(isset($_SESSION['response'])){
                            $response_message = $_SESSION['response']['message'];
                            $is_success = $_SESSION['response']['success'];
                        ?>
                            <div class="responseMessage">
                                <p class="responseMessage <?=$is_success ? 'responseMessage_success' : 'responseMesssage_error' ?>">
                                <?= $response_message?>
                                </p>
                            </div>
                        <?php unset($_SESSION['response']); } ?>
                    </div>  
                                
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


</body>
    <footer>
        <p>&copy; 2024 Health Hub Clinic. All rights reserved.</p>
    </footer>

</html>
