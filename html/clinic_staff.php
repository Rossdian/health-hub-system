<?php

    //Start the session
    session_start();
    if(!isset($_SESSION['user']))header('location: ../index.php');
    $_SESSION['table'] = 'clinic_staffs';
    $user = ($_SESSION['user']);
    $clinicStaff = include('../Database/show-clinicList.php');

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
                        <h1 class="cs2"><i class="fa-solid fa-list" style="color: #ffffff;"></i> CLINIC STAFF</h1>
                        <div class="Add">
                            <a href="../html/add-form-clinicstaff.php" class="icon-link">
                                <button class="create">ADD STAFF</button>
                            </a>
                        </div>
                    </div>
                    <div class="TableList">
                        <div class="clinicList">
                            <table>
                                <thead>
                                    <th><button onclick="sortTable(0)">Id</button></th>
                                    <th><button onclick="sortTable(1)">Name</button></th>
                                    <th><button onclick="sortTable(2)">Role</button></th>
                                    <th><button onclick="sortTable(3)">Address</button></th>
                                    <th><button onclick="sortTable(4)">Contact No.</button></th>
                                    <th><button onclick="sortTable(5)">Specialization</button></th>
                                    <th>Action</th>
                                </thead>
                                <tbody>
                                    <?php
                                        foreach($clinicStaff as $clinic){ ?>
                                        <tr>
                                            <td class="Id"><?= $clinic['id']?></td>
                                            <td class="FullName"><?= $clinic['fullname']?></td>
                                            <td class="Role"><?= $clinic['role']?></td>
                                            <td class="Address"><?= $clinic['address']?></td>
                                            <td class="Contact_no"><?= $clinic['contact_no']?></td>
                                            <td class="Specialization"><?= $clinic['specialization']?></td>
                                            <td>
                                                <a href="" class="updateBtn" data-userid="<?= $clinic['id'] ?>"><i class="fa fa-pencil"></i> Edit</a>
                                                <a href="" class="deleteBtn" data-userid="<?= $clinic['id'] ?>" data-fname="<?=$clinic['fullname']?>"><i class="fa fa-trash"> </i> Delete</a>
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
                                        url: '../Database/deleteStaff.php',
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
                        Role = targetElement.closest('tr').querySelector('td.Role').innerHTML;
                        Address = targetElement.closest('tr').querySelector('td.Address').innerHTML;
                        Contact_no = targetElement.closest('tr').querySelector('td.Contact_no').innerHTML;
                        Specialization = targetElement.closest('tr').querySelector('td.Specialization').innerHTML;

                        BootstrapDialog.confirm({
                            title: 'Update ' + FullName + '?',
                            message: '<form>\
                                <div class="form-group">\
                                    <label for="FullName">Full Name:</label>\
                                    <input type="FullName" class="form-control" id="FullName" value="'+FullName + '">\
                                </div>\
                                <div class="form-group">\
                                    <label for="Role">Role:</label>\
                                    <input type="Role" class="form-control" id="Role" value="'+Role + '">\
                                </div>\
                                <div class="form-group">\
                                    <label for="Address">Address:</label>\
                                    <input type="Address" class="form-control" id="Address" value="'+Address + '">\
                                </div>\
                                <div class="form-group">\
                                    <label for="Contact_no">Contact Number:</label>\
                                    <input type="Contact_no" class="form-control" id="Contact_no" value="'+Contact_no + '">\
                                </div>\
                                <div class="form-group">\
                                    <label for="Specialization">Specialization:</label>\
                                    <input type="Specialization" class="form-control" id="Specialization" value="'+Specialization + '">\
                                </div>\
                                </form>',
                            callback: function(isUpdate){
                                if(isUpdate){
                                    $.ajax({
                                        method: 'POST',
                                        data: {
                                            user_id: userId,
                                            f_name: document.getElementById('FullName').value,
                                            role: document.getElementById('Role').value,
                                            address: document.getElementById('Address').value,
                                            contact_no: document.getElementById('Contact_no').value,
                                            specialization: document.getElementById('Specialization').value,
                                        },
                                        url: '../Database/updateStaff.php',
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








