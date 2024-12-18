<?php

    //Start the session
    session_start();
    if(!isset($_SESSION['user']))header('location: ../index.php');
    $_SESSION['table'] = 'personal_info';
    $user = ($_SESSION['user']);
    $PersonalInf = include('../Database/show-personalInfo.php');

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
                        <h1 class="cs2"><i class="fa-solid fa-list" style="color: #ffffff;"></i> PERSONAL INFORMATION</h1>
                        <div class="Add">
                            <a href="../html/add-form-Info.php" class="icon-link">
                                <button class="create">ADD INFO</button>
                            </a>
                        </div>
                    </div>
                    <div class="TableListPI">
                        <div class="PersonalInfo">
                            <table>
                                <thead>
                                    <th><button onclick="sortTable(0)">Id</button></th>
                                    <th><button onclick="sortTable(1)">Role</button></th>
                                    <th><button onclick="sortTable(2)">Full Name</button></th>
                                    <th><button onclick="sortTable(3)">Status</button></th>
                                    <th><button onclick="sortTable(4)">Gender</button></th>
                                    <th><button onclick="sortTable(5)">Course</button></th>
                                    <th><button onclick="sortTable(6)">Year</button></th>
                                    <th><button onclick="sortTable(7)">Deparment</button></th>
                                    <th><button onclick="sortTable(8)">Birthdate</button></th>
                                    <th><button onclick="sortTable(9)">Address</button></th>
                                    <th><button onclick="sortTable(10)">Email</button></th>
                                    <th><button onclick="sortTable(11)">Contact No.</button></th>
                                    <th><button onclick="sortTable(12)">Emergency No</button></th>
                                    <th><button onclick="sortTable(13)">Emergency Contact</button></th>
                                    <th><button onclick="sortTable(14)">Height</button></th>
                                    <th><button onclick="sortTable(15)">Weight</button></th>
                                    <th>Action</th>
                                </thead>
                                <tbody>
                                    <?php
                                        foreach($PersonalInf as $personal){ ?>
                                        <tr>
                                            <td class="Id"><?= $personal['id']?></td>
                                            <td class="Role"><?= $personal['role']?></td>
                                            <td class="FullName"><?= $personal['fullname']?></td>
                                            <td class="Status"><?= $personal['status']?></td>
                                            <td class="Gender"><?= $personal['gender']?></td>
                                            <td class="Course"><?= $personal['course']?></td>
                                            <td class="Year"><?= $personal['yr_level']?></td>
                                            <td class="Department"><?= $personal['department']?></td>
                                            <td class="Birthdate"><?= $personal['birthdate']?></td>
                                            <td class="Address"><?= $personal['address']?></td>
                                            <td class="Email"><?= $personal['email']?></td>
                                            <td class="Contact_no"><?= $personal['contact_number']?></td>
                                            <td class="emergency_number"><?= $personal['emergency_number']?></td>
                                            <td class="emergency_contact"><?= $personal['emergency_contact']?></td>
                                            <td class="Height"><?= $personal['height_cm']?></td>
                                            <td class="Weight"><?= $personal['weight_kg']?></td>
                                            
                                            <td>
                                                <a href="" class="updateBtn" data-userid="<?= $personal['id'] ?>"><i class="fa fa-pencil"></i> Edit</a>
                                                <a href="" class="deleteBtn" data-userid="<?= $personal['id'] ?>" data-fname="<?=$personal['fullname']?>"><i class="fa fa-trash"> </i> Delete</a>
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

    <script src="../js/menu.js"></script>
    <script src="../js/jquery/jquery-3.7.1.js"></script>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap3-dialog/1.35.4/js/bootstrap-dialog.js" integrity="sha512-AZ+KX5NScHcQKWBfRXlCtb+ckjKYLO1i10faHLPXtGacz34rhXU8KM4t77XXG/Oy9961AeLqB/5o0KTJfy2WiA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
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
                        fname = targetElement.dataset.fname;
                    
                        BootstrapDialog.confirm({
                            type: BootstrapDialog.TYPE_DANGER,
                            message: 'Are you sure to delete ' + fname + '?',
                            callback: function (isDelete) {
                                if (isDelete) {
                                    // Perform deletion action only when the user confirms
                                    $.ajax({
                                        method: 'POST',
                                        data: {
                                            user_id: userId,
                                            f_name: fname
                                        },
                                        url: '../Database/deleteInfo.php',
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
                        Role = targetElement.closest('tr').querySelector('td.Role').innerHTML;
                        FullName = targetElement.closest('tr').querySelector('td.FullName').innerHTML;
                        Status = targetElement.closest('tr').querySelector('td.Status').innerHTML;
                        Gender = targetElement.closest('tr').querySelector('td.Gender').innerHTML;
                        Course = targetElement.closest('tr').querySelector('td.Course').innerHTML;
                        Year = targetElement.closest('tr').querySelector('td.Year').innerHTML;
                        Department = targetElement.closest('tr').querySelector('td.Department').innerHTML;
                        Birthdate = targetElement.closest('tr').querySelector('td.Birthdate').innerHTML;
                        Address = targetElement.closest('tr').querySelector('td.Address').innerHTML;
                        Email = targetElement.closest('tr').querySelector('td.Email').innerHTML;
                        Contact_no = targetElement.closest('tr').querySelector('td.Contact_no').innerHTML;
                        Emergency_no = targetElement.closest('tr').querySelector('td.emergency_number').innerHTML;
                        Emergency_contact = targetElement.closest('tr').querySelector('td.emergency_contact').innerHTML;
                        Height = targetElement.closest('tr').querySelector('td.Height').innerHTML;
                        Weight = targetElement.closest('tr').querySelector('td.Weight').innerHTML;

                        BootstrapDialog.confirm({
                            title: 'Update ' + FullName + '?',
                            message: '<form>\
                                <div class="form-group">\
                                    <label for="Role">Role:</label>\
                                    <input type="Role" class="form-control" id="Role" value="'+Role + '">\
                                </div>\
                                <div class="form-group">\
                                    <label for="FullName">Full Name:</label>\
                                    <input type="FullName" class="form-control" id="FullName" value="'+FullName + '">\
                                </div>\
                                <div class="form-group">\
                                    <label for="Status">Status:</label>\
                                    <input type="Status" class="form-control" id="Status" value="'+Status + '">\
                                </div>\
                                <div class="form-group">\
                                    <label for="Gender">Gender:</label>\
                                    <input type="Gender" class="form-control" id="Gender" value="'+Gender + '">\
                                </div>\
                                <div class="form-group">\
                                    <label for="Course">Course:</label>\
                                    <input type="Course" class="form-control" id="Course" value="'+Course + '">\
                                </div>\
                                <div class="form-group">\
                                    <label for="Year">Year:</label>\
                                    <input type="Year" class="form-control" id="Year" value="'+Year + '">\
                                </div>\
                                <div class="form-group">\
                                    <label for="Department">Department:</label>\
                                    <input type="Department" class="form-control" id="Department" value="'+Department + '">\
                                </div>\
                                <div class="form-group">\
                                    <label for="Birthdate">Birthdate:</label>\
                                    <input type="Birthdate" class="form-control" id="Birthdate" value="'+Birthdate + '">\
                                </div>\
                                <div class="form-group">\
                                    <label for="Address">Address:</label>\
                                    <input type="Address" class="form-control" id="Address" value="'+Address + '">\
                                </div>\
                                <div class="form-group">\
                                    <label for="Email">Email:</label>\
                                    <input type="Email" class="form-control" id="Email" value="'+Email + '">\
                                </div>\
                                <div class="form-group">\
                                    <label for="Contact_no">Contact Number:</label>\
                                    <input type="Contact_no" class="form-control" id="Contact_no" value="'+Contact_no + '">\
                                </div>\
                                <div class="form-group">\
                                    <label for="Emergency_no">Emergency Number:</label>\
                                    <input type="Emergency_no" class="form-control" id="Emergency_no" value="'+Emergency_no + '">\
                                </div>\
                                <div class="form-group">\
                                    <label for="Emergency_contact">Emergency Contact:</label>\
                                    <input type="Emergency_contact" class="form-control" id="Emergency_contact" value="'+Emergency_contact + '">\
                                </div>\
                                <div class="form-group">\
                                    <label for="Height">Height:</label>\
                                    <input type="Height" class="form-control" id="Height" value="'+Height + '">\
                                </div>\
                                <div class="form-group">\
                                    <label for="Weight">Weight:</label>\
                                    <input type="Weight" class="form-control" id="Weight" value="'+Weight + '">\
                                </div>\
                                </form>',
                            callback: function(isUpdate){
                                if(isUpdate){
                                    $.ajax({
                                        method: 'POST',
                                        data: {
                                            user_id: userId,
                                            role: document.getElementById('Role').value,
                                            f_name: document.getElementById('FullName').value,
                                            status: document.getElementById('Status').value,
                                            gender: document.getElementById('Gender').value,
                                            course: document.getElementById('Course').value,
                                            year: document.getElementById('Year').value,
                                            department: document.getElementById('Department').value,
                                            birthdate: document.getElementById('Birthdate').value,
                                            address: document.getElementById('Address').value,
                                            email1: document.getElementById('Email').value,
                                            contact_no: document.getElementById('Contact_no').value,
                                            emergency_number: document.getElementById('Emergency_no').value,
                                            emergency_contact: document.getElementById('Emergency_contact').value,
                                            height: document.getElementById('Height').value,
                                            weight: document.getElementById('Weight').value,
                                        },
                                        url: '../Database/updateInfo.php',
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





