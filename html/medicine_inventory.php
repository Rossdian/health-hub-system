<?php

    //Start the session
    session_start();
    if(!isset($_SESSION['user']))header('location: ../index.php');
    $_SESSION['table'] = 'medicine_prescription';
    $user = ($_SESSION['user']);
    $MedicinePres = include('../Database/show-Medicine.php');
    $Medicines = include('../Database/show-med.php');
    $Report = include('../Database/show-reportList.php');
    $Options = include('../Database/show-form.php');


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
                        <h1 class="cs2"><i class="fa-solid fa-list" style="color: #ffffff;"></i> MEDICINE PRESCRIPTION</h1>
                        <div class="Add">
                            <a href="../html/add-form-pres.php" class="icon-link">
                                <button class="create">ADD PRESCRIPTION</button>
                            </a>
                        </div>
                    </div>
                    <div class="TableList">
                        <div class="MedicineP">
                            <table>
                                <thead>
                                    <th><button onclick="sortTable(0)">Id</button></th>
                                    <th><button onclick="sortTable(1)">Name</button></th>
                                    <th><button onclick="sortTable(2)">Medicine</button></th>
                                    <th><button onclick="sortTable(3)">Dosage</button></th>
                                    <th><button onclick="sortTable(4)">Frequency</button></th>
                                    <th><button onclick="sortTable(5)">Start Date</button></th>
                                    <th><button onclick="sortTable(6)">End Date</button></th>
                                    <th><button onclick="sortTable(7)">Description</button></th>
                                    <th><button onclick="sortTable(8)">Manufacturer</button></th>
                                    <th><button onclick="sortTable(9)">Expiry</button></th>
                                    <th>Action</th>
                                </thead>
                                <tbody>
                                    <?php
                                        foreach($MedicinePres as $medicine){ ?>
                                        <tr>
                                            <td class="Id"><?= $medicine['id']?></td>
                                            <td class="FullName"><?= $medicine['personal_fullname']?></td>
                                            <td class="Medicine_name"><?= $medicine['medicine_name']?></td>
                                            <td class="Dosage"><?= $medicine['dosage']?></td>
                                            <td class="Frequency"><?= $medicine['frequency']?></td>
                                            <td class="Start_date"><?= $medicine['start_date']?></td>
                                            <td class="End_date"><?= $medicine['end_date']?></td>
                                            <td class="Description"><?= $medicine['description']?></td>
                                            <td class="Manufacturer"><?= $medicine['manufacturer']?></td>
                                            <td class="Expiry_date"><?= $medicine['expiry_date']?></td>
                                            <td>
                                                <a href="" class="updateBtn" data-userid="<?= $medicine['id'] ?>"><i class="fa fa-pencil"></i> Edit</a>
                                                <a href="" class="deleteBtn" data-userid="<?= $medicine['id'] ?>"><i class="fa fa-trash"> </i> Delete</a>
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
                            message: 'Are you sure to delete this?',
                            callback: function (isDelete) {
                                if (isDelete) {
                                    // Perform deletion action only when the user confirms
                                    $.ajax({
                                        method: 'POST',
                                        data: {
                                            user_id: userId,
                                        },
                                        url: '../Database/deletepres.php',
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
                        FullName = targetElement.closest('tr').querySelector('td.FullName').innerHTML;
                        Medicine_name = targetElement.closest('tr').querySelector('td.Medicine_name').innerHTML;
                        Dosage = targetElement.closest('tr').querySelector('td.Dosage').innerHTML;
                        Frequency = targetElement.closest('tr').querySelector('td.Frequency').innerHTML;
                        Start_date = targetElement.closest('tr').querySelector('td.Start_date').innerHTML;
                        End_date = targetElement.closest('tr').querySelector('td.End_date').innerHTML;

                        BootstrapDialog.confirm({
                            title: 'Are you sure to update?',
                            message: '<form>\
                                <div class="form-group">\
                                    <label for="FullName">Patient Id:</label>\
                                    <select id="FullName" class="form-control">\
                                        <?php foreach($Options as $option): ?>\
                                            <option value="<?= $option['report_id'] ?>"><?= $option['fullname'] ?></option>\
                                        <?php endforeach; ?>\
                                    </select>\
                                    <input type="hidden" id="fullname" name="fullname">\
                                </div>\
                                <div class="form-group">\
                                    <label for="Medicine_name">Medicine name:</label>\
                                    <select id="Medicine_name" class="form-control">\
                                        <?php foreach($Medicines as $medicine): ?>\
                                            <option value="<?= $medicine['id'] ?>"><?= $medicine['name'] ?></option>\
                                        <?php endforeach; ?>\
                                    </select>\
                                </div>\
                                <input type="hidden" id="medicine_id" name="medicine_id">\
                                <div class="form-group">\
                                    <label for="Dosage">Dosage:</label>\
                                    <input type="Dosage" class="form-control" id="Dosage" value="'+Dosage + '">\
                                </div>\
                                <div class="form-group">\
                                    <label for="Frequency">Frequency:</label>\
                                    <input type="Frequency" class="form-control" id="Frequency" value="'+Frequency + '">\
                                </div>\
                                <div class="form-group">\
                                    <label for="Start_date">Start date:</label>\
                                    <input type="Start_date" class="form-control" id="Start_date" value="'+Start_date + '">\
                                </div>\
                                <div class="form-group">\
                                    <label for="End_date">End date:</label>\
                                    <input type="End_date" class="form-control" id="End_date" value="'+End_date + '">\
                                </div>\
                                </form>',
                            callback: function(isUpdate){
                                if(isUpdate){
                                    $.ajax({
                                        method: 'POST',
                                        data: {
                                            user_id: userId,
                                            f_name: document.getElementById('FullName').value,
                                            medicine_name: document.getElementById('Medicine_name').value,
                                            dosage: document.getElementById('Dosage').value,
                                            frequency: document.getElementById('Frequency').value,
                                            start_date: document.getElementById('Start_date').value,
                                            end_date: document.getElementById('End_date').value,
                                        },
                                        url: '../Database/updatePres.php',
                                        dataType : 'json',
                                        success: function(data){
                                            if(data.success){
                                                console.log('ss');
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
            document.getElementById('Medicine_name').addEventListener('change', function() {
                var selectedMedicineId = this.value;
                document.getElementById('medicine_id').value = selectedMedicineId;
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


