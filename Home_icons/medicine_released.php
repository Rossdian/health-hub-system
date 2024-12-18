<?php

    //Start the session
    session_start();
    if(!isset($_SESSION['user']))header('location: ../index.php');
    $_SESSION['table'] = 'medicines';
    $user = ($_SESSION['user']);
    $Medicines = include('../Database/show-med.php');

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
                        <h1 class="cs2"><i class="fa-solid fa-list" style="color: #ffffff;"></i> MEDICINE INVENTORY</h1>
                        <div class="Add">
                            <a href="../html/add-form-med.php" class="icon-link">
                                <button class="create">ADD MEDICINE</button>
                            </a>
                        </div>
                    </div>
                    <div class="TableList">
                        <div class="medicine">
                            <table>
                                <thead>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th>Manufacturer</th>
                                    <th>Expiry Date</th>
                                    <th>Action</th>
                                </thead>
                                <tbody>
                                    <?php
                                        foreach($Medicines as $medicines){ ?>
                                        <tr>
                                            <td class="Id"><?= $medicines['id']?></td>
                                            <td class="name"><?= $medicines['name']?></td>
                                            <td class="description"><?= $medicines['description']?></td>
                                            <td class="manufacturer"><?= $medicines['manufacturer']?></td>
                                            <td class="expiry_date"><?= $medicines['expiry_date']?></td>
                                            <td>
                                                <a href="" class="updateBtn" data-userid="<?= $medicines['id'] ?>"><i class="fa fa-pencil"></i> Edit</a>
                                                <a href="" class="deleteBtn" data-userid="<?= $medicines['id'] ?>" data-fname="<?=$medicines['name']?>"><i class="fa fa-trash"> </i> Delete</a>
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
                                        url: '../Database/deleteMedicine.php',
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
                        Name = targetElement.closest('tr').querySelector('td.name').innerHTML;
                        Description = targetElement.closest('tr').querySelector('td.description').innerHTML;
                        Manufacturer = targetElement.closest('tr').querySelector('td.manufacturer').innerHTML;
                        Expiry_date = targetElement.closest('tr').querySelector('td.expiry_date').innerHTML;

                        BootstrapDialog.confirm({
                            title: 'Update ' + Name + '?',
                            message: '<form>\
                                <div class="form-group">\
                                    <label for="Name">Name:</label>\
                                    <input type="Name" class="form-control" id="Name" value="'+Name + '">\
                                </div>\
                                <div class="form-group">\
                                    <label for="Description">Description:</label>\
                                    <input type="Description" class="form-control" id="Description" value="'+Description + '">\
                                </div>\
                                <div class="form-group">\
                                    <label for="Manufacturer">Manufacturer:</label>\
                                    <input type="Manufacturer" class="form-control" id="Manufacturer" value="'+Manufacturer + '">\
                                </div>\
                                <div class="form-group">\
                                    <label for="Expiry_date">Expiry date:</label>\
                                    <input type="Expiry_date" class="form-control" id="Expiry_date" value="'+Expiry_date + '">\
                                </div>\
                                </form>',
                            callback: function(isUpdate){
                                if(isUpdate){
                                    $.ajax({
                                        method: 'POST',
                                        data: {
                                            user_id: userId,
                                            f_name: document.getElementById('Name').value,
                                            description: document.getElementById('Description').value,
                                            manufacturer: document.getElementById('Manufacturer').value,
                                            expiry_date: document.getElementById('Expiry_date').value,
                                        },
                                        url: '../Database/updateMed.php',
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


