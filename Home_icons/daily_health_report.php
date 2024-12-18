<?php

    //Start the session
    session_start();
    if(!isset($_SESSION['user']))header('location: ../index.php');
    $_SESSION['table'] = 'incident_report';
    $user = ($_SESSION['user']);
    $incidentRep = include('../Database/show-month.php');

    include('../includes/header.php');

?>

    <main class="main-wrap">
    <?php include('../html/navigation.php'); ?>
        <section class="showcase active">
            <div class="overlay">
                <div class="head">
                    <button class="toggler">
                        <i class="fa-solid fa-bars-staggered" style="color: #ffffff;"></i>
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
                        <h1 class="cs2"><i class="fa-solid fa-list" style="color: #ffffff;"></i> MONTHLY REPORT</h1>
                        <div class="Add">
                            <a href="../html/home.php" class="icon-link">
                                <button class="create">BACK</button>
                            </a>
                        </div>
                    </div>
                    <div class="TableList">
                        <div class="MONTLY">
                            <table>
                                <thead>
                                    <th>Month</th>
                                    <th>Number of patients</th>
                                </thead>
                                <tbody>
                                    <?php
                                        foreach($incidentRep as $rep){ ?>
                                        <tr class="IncidentTr">
                                            <td><?= $rep['month']?></td>
                                            <td><?= $rep['Number_of_Patients']?></td>
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

                    if(classList.contains('deleteBtn')){
                        e.preventDefault();
                        userId = targetElement.dataset.userid;
                        fname = targetElement.dataset.fname;

                        BootstrapDialog.confirm({
                                                type: BootstrapDialog.TYPE_DANGER,
                                                message: 'Are you sure to delete ' + fname + '?',
                                                callback: function(isDelete){
                                                    $.ajax({
                                                        method: 'POST',
                                                        data: {
                                                            user_id: userId,
                                                            f_name: fname
                                                        },
                                                        url: '../Database/deleteStaff.php',
                                                        dataType : 'json',
                                                        success : function(data){
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
                                                    });
                                                }
                                            })
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
    </script>

</body>
    <footer>
        <p>&copy; 2024 Health Hub Clinic. All rights reserved.</p>
    </footer>

</html>

