<?php

    //Start the session
    session_start();
    if(!isset($_SESSION['user']))header('location: ../index.php');
    $_SESSION['table'] = 'incident_report';
    $user = ($_SESSION['user']);
    $incidentRep = include('../Database/show-reportList.php');
    $Info = include('../Database/show-personalInfo.php');
    $Staff = include('../Database/show-clinicList.php');


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
                    <div class="clinichead">
                        <h1 class="cs2"><i class="fa-solid fa-list" style="color: #ffffff;"></i> INCIDENT REPORT</h1>
                        <div class="Add">
                            <a href="../html/add-form-report.php" class="icon-link">
                                <button class="create">ADD REPORT</button>
                            </a>
                        </div>
                    </div>
                    <div class="TableList">
                        <div class="IncidentReport">
                            <table>
                            <thead>
                                <th><button onclick="sortTable(0)">Id</button></th>
                                <th><button onclick="sortTable(1)">Name</button></th>
                                <th><button onclick="sortTable(2)">Assisted by</button></th>
                                <th><button onclick="sortTable(3)">Date</button></th>
                                <th><button onclick="sortTable(4)">Time</button></th>
                                <th><button onclick="sortTable(5)">Bp mmhg</button></th>
                                <th><button onclick="sortTable(6)">Pr BPM</button></th>
                                <th><button onclick="sortTable(7)">Temp Celsius</button></th>
                                <th><button onclick="sortTable(8)">Oxygen Saturation</button></th>
                                <th><button onclick="sortTable(9)">Complaint</button></th>
                                <th><button onclick="sortTable(10)">Treatment</button></th>
                                <th>Action</th>
                            </thead>
                                <tbody>
                                    <?php
                                        foreach($incidentRep as $rep){ ?>
                                        <tr class="IncidentTr">
                                            <td class="Id"><?= $rep['id']?></td>
                                            <td class="Personal_id"><?= $rep['personal_fullname']?></td>
                                            <td class="Staff_id"><?= $rep['clinic_staff_fullname']?></td>
                                            <td class="DateReport"><?= $rep['date']?></td>
                                            <td class="TimeReport"><?= $rep['time']?></td>
                                            <td class="Bp_mmhg"><?= $rep['bp_mmhg']?></td>
                                            <td class="Pr_bpm"><?= $rep['pr_bpm']?></td>
                                            <td class="Temp_celcius"><?= $rep['temp_celcious']?></td>
                                            <td class="Oxygen_saturation"><?= $rep['oxygen_saturation']?></td>
                                            <td class="Complaint"><?= $rep['complaint']?></td>
                                            <td class="Treatment"><?= $rep['treatment']?></td>
                                            <td>
                                                <a href="" class="updateBtn" data-userid="<?= $rep['id'] ?>"><i class="fa fa-pencil"></i> Edit</a>
                                                <a href="" class="deleteBtn" data-userid="<?= $rep['id'] ?>" ><i class="fa fa-trash"> </i> Delete</a>
                                            </td>
                                        </tr>
                                    <?php }?>                                    
                                </tbody>
                            </table>
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
    
    <script>
        function script(){

            this.initialize = function(){
                this.registerEvents();
            },
            this.registerEvents = function(){
                document.addEventListener('click', function(e){
                    targetElement = e.target;
                    classList = targetElement.classList;

                    if (classList.contains('deleteBtn')) {
                        e.preventDefault();
                        userId = targetElement.dataset.userid;
                    
                        BootstrapDialog.confirm({
                            type: BootstrapDialog.TYPE_DANGER,
                            message: 'Are you sure to delete this report?',
                            callback: function (isDelete) {
                                if (isDelete) {
                                    // Perform deletion action only when the user confirms
                                    $.ajax({
                                        method: 'POST',
                                        data: {
                                            user_id: userId,
                                        },
                                        url: '../Database/deleteReport.php',
                                        dataType: 'json',
                                        success: function (data) {
                                            if (data.success) {
                                                BootstrapDialog.alert({
                                                    type: BootstrapDialog.TYPE_SUCCESS,
                                                    message: data.message,
                                                    callback: function () {
                                                        location.reload();
                                                    }
                                                });
                                            } else {
                                                BootstrapDialog.alert({
                                                    type: BootstrapDialog.TYPE_DANGER,
                                                    message: data.message,
                                                });
                                            }
                                        }
                                    });
                                }
                            }
                        });
                    }

                    if(classList.contains('updateBtn')){
                        e.preventDefault();

                        userId = targetElement.dataset.userid;
                        
                        Id = targetElement.closest('tr').querySelector('td.Id').innerHTML;
                        Personal_id = targetElement.closest('tr').querySelector('td.Personal_id').innerHTML;
                        Staff_id = targetElement.closest('tr').querySelector('td.Staff_id').innerHTML;
                        DateReport = targetElement.closest('tr').querySelector('td.DateReport').innerHTML;
                        TimeReport = targetElement.closest('tr').querySelector('td.TimeReport').innerHTML;
                        Bp_mmhg = targetElement.closest('tr').querySelector('td.Bp_mmhg').innerHTML;
                        Pr_bpm = targetElement.closest('tr').querySelector('td.Pr_bpm').innerHTML;
                        Temp_celcius = targetElement.closest('tr').querySelector('td.Temp_celcius').innerHTML;
                        Oxygen_saturation = targetElement.closest('tr').querySelector('td.Oxygen_saturation').innerHTML;
                        Complaint = targetElement.closest('tr').querySelector('td.Complaint').innerHTML;
                        Treatment = targetElement.closest('tr').querySelector('td.Treatment').innerHTML;

                        BootstrapDialog.confirm({
                            title: 'Update ' + Personal_id + '?',
                            message: '<form>\
                                <div class="form-group">\
                                    <label for="Personal_id">Full Name:</label>\
                                    <select id="Personal_id" class="form-control">\
                                        <?php foreach($Info as $info): ?>\
                                            <option value="<?= $info['id'] ?>"><?= $info['fullname'] ?></option>\
                                        <?php endforeach; ?>\
                                    </select>\
                                    <input type="hidden" id="info_id" name="info_id">\
                                </div>\
                                <div class="form-group">\
                                    <label for="Staff_id">Assisted by:</label>\
                                    <select id="Staff_id" class="form-control">\
                                        <?php foreach($Staff as $staff): ?>\
                                            <option value="<?= $staff['id'] ?>"><?= $staff['fullname'] ?></option>\
                                        <?php endforeach; ?>\
                                    </select>\
                                    <input type="hidden" id="staff_id" name="staff_id">\
                                </div>\
                                <div class="form-group">\
                                    <label for="DateReport">Date:</label>\
                                    <input type="DateReport" class="form-control" id="DateReport" value="'+DateReport + '">\
                                </div>\
                                <div class="form-group">\
                                    <label for="Time">Time:</label>\
                                    <input type="TimeReport" class="form-control" id="TimeReport" value="'+TimeReport + '">\
                                </div>\
                                <div class="form-group">\
                                    <label for="Bp_mmhg">Bp_mmhg:</label>\
                                    <input type="Bp_mmhg" class="form-control" id="Bp_mmhg" value="'+Bp_mmhg + '">\
                                </div>\
                                </div>\
                                <div class="form-group">\
                                    <label for="Pr_bpm">Pr bpm:</label>\
                                    <input type="Pr_bpm" class="form-control" id="Pr_bpm" value="'+Pr_bpm + '">\
                                </div>\
                                </div>\
                                <div class="form-group">\
                                    <label for="Temp_celcius">Temp celcius:</label>\
                                    <input type="Temp_celcius" class="form-control" id="Temp_celcius" value="'+Temp_celcius + '">\
                                </div>\
                                </div>\
                                <div class="form-group">\
                                    <label for="Oxygen_saturation">Oxygen saturation:</label>\
                                    <input type="Oxygen_saturation" class="form-control" id="Oxygen_saturation" value="'+Oxygen_saturation + '">\
                                </div>\
                                </div>\
                                <div class="form-group">\
                                    <label for="Complaint">Complaint:</label>\
                                    <input type="Complaint" class="form-control" id="Complaint" value="'+Complaint + '">\
                                </div>\
                                </div>\
                                <div class="form-group">\
                                    <label for="Treatment">Treatment:</label>\
                                    <input type="Treatment" class="form-control" id="Treatment" value="'+Treatment + '">\
                                </div>\
                                </form>',
                            callback: function(isUpdate){
                                if(isUpdate){
                                    $.ajax({
                                        method: 'POST',
                                        data: {
                                            user_id: userId,
                                            personal_id: document.getElementById('Personal_id').value,
                                            staff_id: document.getElementById('Staff_id').value,
                                            dateReport: document.getElementById('DateReport').value,
                                            timeReport: document.getElementById('TimeReport').value,
                                            bp_mmhg: document.getElementById('Bp_mmhg').value,
                                            pr_bpm: document.getElementById('Pr_bpm').value,
                                            temp_celcious: document.getElementById('Temp_celcius').value,
                                            oxygen_saturation: document.getElementById('Oxygen_saturation').value,
                                            complaint: document.getElementById('Complaint').value,
                                            treatment: document.getElementById('Treatment').value,
                                        },
                                        url: '../Database/updateReport.php',
                                        dataType : 'json',
                                        success: function(data){
                                            if(data.success){
                                                BootstrapDialog.alert({
                                                type: BootstrapDialog.TYPE_SUCCESS,
                                                message: data.message,
                                                callback: function(){
                                                    location.reload();
                                                }
                                            });
                                            } else 
                                                BootstrapDialog.alert({
                                                    type: BootstrapDialog.TYPE_DANGER,
                                                    message: data.message,
                                                });
                                        }
                                    })
                                }
                            }    
                        });
                    }
                });
            }
        }
        var script = new script;
        script.initialize();
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('Staff_id').addEventListener('change', function() {
                var selectedMedicineId = this.value;
                document.getElementById('staff_id').value = selectedMedicineId;
            });
        });
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('Personal_id').addEventListener('change', function() {
                var selectedMedicineId = this.value;
                document.getElementById('info_id').value = selectedMedicineId;
            });
        });

//Sorting
function sortTable(columnIndex) {
    const table = document.querySelector("table");
    const tbody = table.querySelector("tbody");
    const rows = Array.from(tbody.querySelectorAll("tr"));

    // Toggle the sorting order (ascending/descending)
    const isAscending = table.dataset.sortOrder !== "asc";
    table.dataset.sortOrder = isAscending ? "asc" : "desc";

    // Sort rows
    rows.sort((a, b) => {
        const aText = a.cells[columnIndex].textContent.trim();
        const bText = b.cells[columnIndex].textContent.trim();

        if (!isNaN(aText) && !isNaN(bText)) {
            // Numerical comparison
            return isAscending ? aText - bText : bText - aText;
        } else {
            // Textual comparison
            return isAscending ? aText.localeCompare(bText) : bText.localeCompare(aText);
        }
    });

    // Append sorted rows to the tbody
    rows.forEach(row => tbody.appendChild(row));
}

    </script>
<style>
    thead button {
    background: none;
    border: none;
    color: inherit;
    font: inherit;
    cursor: pointer;
    outline: none; /* Removes the outline */
    padding: 0;
}

thead button:hover {
    text-decoration: underline; /* Optional: Adds an underline on hover for better UX */
}

</style>

