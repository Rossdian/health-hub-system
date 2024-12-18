<?php

    //Start the session
    session_start();
    if(!isset($_SESSION['user']))header('location: ../index.php');
    $_SESSION['table'] = 'incident_report';
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
                            <h1 class="cs1"><i class="fa-solid fa-plus" style="color: #ffffff;"></i> INSERT INCIDENT REPORT</h1>
                            <div class="Add">
                                <a href="../html/incident_reports.php" class="icon-link">
                                    <button class="back">BACK</button>
                                </a>
                            </div>
                        </div>
                        <form action="../database/addreport.php" method="POST" class="addIncidentReport">
                        <div class="IncidentContainer">
                                <label for="personal_id">Name</label>
                                <select class="clinicInput" id="personal_id" name="personal_id" required>
                                    <option value="">Select</option>
                                    <?php
                                    // Fetch names from personal_info table
                                    $sql = "SELECT id, fullname FROM personal_info";
                                    $stmt = $conn->prepare($sql);
                                    $stmt->execute();
                                    $personalInfo = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                    foreach ($personalInfo as $info) {
                                        echo "<option value='" . $info['id'] . "'>" . $info['fullname'] . "</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="IncidentContainer">
                                <label for="staff_id">Assisted by</label>
                                <select class="clinicInput" id="staff_id" name="staff_id" required>
                                    <option value="">Select</option>
                                    <?php
                                    // Fetch names from clinic_staff table
                                    $sql = "SELECT id, fullname FROM clinic_staffs";
                                    $stmt = $conn->prepare($sql);
                                    $stmt->execute();
                                    $clinicStaff = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                    foreach ($clinicStaff as $staff) {
                                        echo "<option value='" . $staff['id'] . "'>" . $staff['fullname'] . "</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            
                            <div class="IncidentContainer">
                                <label for="date">Date</label>
                                <input type="date" class="clinicInput" id="date" name="date" required/>
                            </div>
                            <div class="IncidentContainer">
                                <label for="time">Time</label>
                                <input type="time" class="clinicInput" id="time" name="time" required/>
                            </div>
                            <div class="IncidentContainer">
                                <label for="bp_mmhg">Bp mmhg</label>
                                <input type="text" class="clinicInput" id="bp_mmhg" name="bp_mmhg" required/>
                            </div>
                            <div class="IncidentContainer">
                                <label for="pr_bpm">Pr BPM</label>
                                <input type="text" class="clinicInput" id="pr_bpm" name="pr_bpm" required/>
                            </div>
                            <div class="IncidentContainer">
                                <label for="temp_celcious">Temp Celcius</label>
                                <input type="text" class="clinicInput" id="temp_celcious" name="temp_celcious" required/>
                            </div>
                            <div class="IncidentContainer">
                                <label for="oxygen_saturation">Oxygen Saturation</label>
                                <input type="text" class="clinicInput" id="oxygen_saturation" name="oxygen_saturation" required/>
                            </div>
                            <div class="IncidentContainer">
                                <label for="complaint">Complaint</label>
                                <input type="text" class="clinicInput" id="complaint" name="complaint" required/>
                            </div>
                            <div class="IncidentContainer">
                                <label for="treatment">Treatment</label>
                                <input type="text" class="clinicInput" id="treatment" name="treatment" required/>
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
