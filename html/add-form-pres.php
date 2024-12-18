<?php

    //Start the session
    session_start();
    if(!isset($_SESSION['user']))header('location: ../index.php');
    $_SESSION['table'] = 'medicine_prescription';
    $user = ($_SESSION['user']);

    include('../Database/connection.php');
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
                            <h1 class="cs1"><i class="fa-solid fa-plus" style="color: #ffffff;"></i> INSERT PRESCRIPTION</h1>
                            <div class="Add">
                                <a href="../html/medicine_inventory.php" class="icon-link">
                                    <button class="back">BACK</button>
                                </a>
                            </div>
                        </div>
                        <form action="../database/addpres.php" method="POST" class="addIncidentReport">
                        <div class="IncidentContainer">
                                <label for="name">Name</label>
                                <select class="clinicInput" id="name" name="name" required>
                                    <option value="">Select</option>
                                    <?php
                                    // Fetch names and incident report IDs from incident_report table
                                    $sql = "SELECT ir.id AS report_id, pi.fullname 
                                            FROM incident_report ir 
                                            INNER JOIN personal_info pi ON ir.personal_id = pi.id";
                                    $stmt = $conn->prepare($sql);
                                    $stmt->execute();
                                    $options = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                    
                                    // Display options in the dropdown menu
                                    foreach ($options as $option) {
                                        echo "<option value='" . $option['report_id'] . "'>" . $option['fullname'] . "</option>";
                                    }
                                    ?>
                                </select>

                                
                            </div>
                            <div class="IncidentContainer">
                                <label for="medicine">Medicine</label>
                                <select class="clinicInput" id="medicine" name="medicine" required>
                                    <option value="">Select</option>
                                    <?php
                                    // Fetch names from medicines table
                                    $sql = "SELECT id, name FROM medicines";
                                    $stmt = $conn->prepare($sql);
                                    $stmt->execute();
                                    $MedicineInfo = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                    foreach ($MedicineInfo as $med) {
                                        echo "<option value='" . $med['id'] . "'>" . $med['name'] . "</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            
                            <div class="IncidentContainer">
                                <label for="dosage">Dosage</label>
                                <input type="text" class="clinicInput" id="dosage" name="dosage" required/>
                            </div>
                            <div class="IncidentContainer">
                                <label for="frequency">Frequency</label>
                                <input type="text" class="clinicInput" id="frequency" name="frequency" required/>
                            </div>
                            <div class="IncidentContainer">
                                <label for="start_date">Start Date</label>
                                <input type="date" class="clinicInput" id="start_date" name="start_date" required/>
                            </div>
                            <div class="IncidentContainer">
                                <label for="end_date">End Date</label>
                                <input type="date" class="clinicInput" id="end_date" name="end_date" required/>
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
