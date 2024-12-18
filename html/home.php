<?php
    //Start the session
    session_start();
    if(!isset($_SESSION['user']))header('location: ../index.php');
    
    $user = ($_SESSION['user']);

    include('../includes/header.php');
?>


    <main class="main-wrap">
    <?php include('../html/navigation.php'); ?>
        <section class="showcase active">
            <div class="overlay">
                <div class="head">
                    <button class="toggler">
                        <i class="fa-solid fa-bars-staggered" style="color:rgb(66, 6, 6);"></i>
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
                    <div class="title">
                        <div class="content-text">                   
                            <h3>HEALTH HUB</h3>
                            <p class="file" >Clinic Files</p>
                        </div>
                        <div class="icons">
                            <div class="icons">
                                <div class="icon-wrapper">
                                    <a href="../Home_icons/assisted_patients.php" class="icon-link">
                                        <button class="icon-button"><img src="../images/icon1a.jpeg" class="icon" alt="Icon 1"></button>
                                    </a>
                                    <div class="icon-names-container">
                                        <div class="icon-name">Assisted Patients</div>
                                    </div>
                                </div>
                                
                                <div class="icon-wrapper">
                                    <a href="../Home_icons/daily_health_report.php" class="icon-link">
                                        <button class="icon-button"><img src="../images/icon2a.jpeg" class="icon" alt="Icon 2"></button>
                                    </a>
                                    <div class="icon-names-container">
                                        <div class="icon-name">Monthly Report</div>
                                    </div>
                                </div>
                                
                                <div class="icon-wrapper">
                                    <a href="../Home_icons/medicine_released.php" class="icon-link">
                                        <button class="icon-button"><img src="../images/icon3a.webp" class="icon" alt="Icon 3"></button>
                                    </a>
                                    <div class="icon-names-container">
                                        <div class="icon-name">Medicine Inventory</div>
                                    </div>
                                </div>
                                
                                <
                            </div>
                            
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
