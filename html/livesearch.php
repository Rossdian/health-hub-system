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
                        <i class="fa-solid fa-bars-staggered" style="color: rgb(66, 6, 6);"></i>
                    </button>
                    <div class="top">                 
                        <input class="search-bar" type="text" id="search" placeholder="Search">
                        <button type="button" class="search" onclick="searchFunction()">Search</button>
                         
                        <button class="log-out" onclick="openModal()">
                        <span><?= $user['firstName'] ?></span> 
                            <i class="fa-solid fa-right-from-bracket" style="color: #ffffff;"></i>
                        </button>       
                    </div>

                </div>
                
                <div class="content">
                    <div class="clinichead">
                        <h1 class="cs2"><i class="fa-solid fa-search" style="color: #ffffff;"></i>  RESULTS</h1>
                        <div class="Add">
                            <a href="../html/home.php" class="icon-link">
                                <button class="create">BACK</button>
                            </a>
                        </div>
                    </div>
                    <div class="searchTable">
                        <table>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Full Name</th>
                                <th>Status</th>
                                <th>Gender</th>
                                <th>Course</th>
                                <th>Year Level</th>
                                <th>Department</th>
                                <th>Birthdate</th>
                                <th>Address</th>
                                <th>Email</th>
                                <th>Contact Number</th>
                                <th>Emergency Number</th>
                                <th>Height (cm)</th>
                                <th>Weight (kg)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Retrieve the search results parameter from the URL
                            $searchResultsParam = $_GET['searchResults'];
                                        
                            // Decode the search results parameter
                            $searchResults = json_decode(urldecode($searchResultsParam), true);
                            foreach ($searchResults as $result) {
                                echo "<tr>";
                                echo "<td>" . $result['id'] . "</td>";
                                echo "<td>" . $result['fullname'] . "</td>";
                                echo "<td>" . $result['status'] . "</td>";
                                echo "<td>" . $result['gender'] . "</td>";
                                echo "<td>" . $result['course'] . "</td>";
                                echo "<td>" . $result['yr_level'] . "</td>";
                                echo "<td>" . $result['department'] . "</td>";
                                echo "<td>" . $result['birthdate'] . "</td>";
                                echo "<td>" . $result['address'] . "</td>";
                                echo "<td>" . $result['email'] . "</td>";
                                echo "<td>" . $result['contact_number'] . "</td>";
                                echo "<td>" . $result['emergency_number'] . "</td>";
                                echo "<td>" . $result['height_cm'] . "</td>";
                                echo "<td>" . $result['weight_kg'] . "</td>";
                                echo "</tr>";
                            }
                            ?>
                        </tbody>
                    </table>
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

    <script>
    function goBack() {
        window.history.back();
        }
    </script>

</body>
    <footer>
        <p>&copy; 2024 Health Hub Clinic. All rights reserved.</p>
    </footer>

</html>
