<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Latest compiled and minified CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- DataTables CDN -->
    <link href="https://cdn.datatables.net/v/bs5/dt-1.13.4/datatables.min.css" rel="stylesheet"/>

    <title>Crud App Using PHP OOP and AJAX</title>
</head>

<body>

<!-- Navbar section -->
<nav class="navbar navbar-expand-sm navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="javascript:void(0)">
            <i class="fab fa-wolf-pack-battalion"></i>
            &nbsp; Bakheet
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mynavbar">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="mynavbar">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="javascript:void(0)">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="javascript:void(0)">Blog</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="javascript:void(0)">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="javascript:void(0)">Contact</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<!-- Navbar section -->


<div class="container">

    <div class="row">
        <div class="col-lg-12">
            <h4 class="text-center text-danger font-weight-normal my-3">CRUD Application using PHP OOP and AJAX</h4>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6">
            <h4 class="mt-2 text-primary">
                All Users in Database
            </h4>
        </div>
        <div class="col-lg-6">
            <button class="btn btn-primary m-1 float-end" type="button" data-toggle="modal" data-target="#addModal">
                <i class="fas fa-user-plus fa-lg"></i>
                &nbsp;Add New User
            </button>
            <a href="action.php?export=excel" class="btn btn-success m-1 float-end">
                <i class="fas fa-table fa-lg"></i>
                &nbsp;Export to Excel
            </a>
        </div>
        <hr class="my-1">
        <div class="row">
            <div class="col-lg-12">
                <div class="table-responsive" id="showUsers">
                    <h3 class="text-center text-success" style="margin-top: 150px;">Loading....</h3>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add New User Modal section -->
<div class="modal" id="addModal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Add New User</h4>
                <button type="button" class="btn-close" data-dismiss="modal"></button>
            </div>

            <!-- Modal body -->
            <div class="modal-body px-4">
                <form id="form-data" method="post" action="">

                    <div class="mb-3">
                        <input type="text" class="form-control" name="fname" placeholder="First Name " required>
                    </div>
                    <div class="mb-3">
                        <input type="text" class="form-control" name="lname" placeholder="Last Name " required>
                    </div>
                    <div class="mb-3">
                        <input type="email" class="form-control" name="email" placeholder="Email " required>
                    </div>
                    <div class="mb-3">
                        <input type="tel" class="form-control" name="phone" placeholder="123-456-7890"
                               pattern="[0-9]{3}[0-9]{3}[0-9]{4}" required>
                    </div>
                    <div class="mb-3 d-grid gap-2">
                        <input type="submit" class="btn btn-success btn-block" name="insert" id="insert"
                               value="Add User">
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
<!-- Add New User Modal section -->


<!-- Edit User Modal section -->
<div class="modal" id="updateModal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Update User Data </h4>
                <button type="button" class="btn-close" data-dismiss="modal"></button>
            </div>

            <!-- Modal body -->
            <div class="modal-body px-4">
                <form id="update-form-data" method="post" action="">
                    <div class="mb-3">
                        <input type="hidden" name="id" id="id">
                    </div>
                    <div class="mb-3">
                        <input type="text" class="form-control" name="fname" id="fname">
                    </div>
                    <div class="mb-3">
                        <input type="text" class="form-control" name="lname" id="lname">
                    </div>
                    <div class="mb-3">
                        <input type="email" class="form-control" name="email" id="email">
                    </div>
                    <div class="mb-3">
                        <input type="tel" class="form-control" name="phone" id="phone"
                               pattern="[0-9]{3}[0-9]{3}[0-9]{4}">
                    </div>
                    <div class="mb-3 d-grid gap-2">
                        <input type="submit" class="btn btn-success btn-block" name="update" id="update"
                               value="Update User">
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
<!-- Edit User Modal section -->


<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

<!-- Popper JS -->
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

<!-- fontawesome -->
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

<!-- Data Tables CDN -->
<script src="https://cdn.datatables.net/v/bs5/dt-1.13.4/datatables.min.js"></script>

<!-- Sweet Alert 2 CDN -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- This function for DataTable -->
<script type="text/javascript">
    $(document).ready(function () {

        showAllUsers();

        /* get all users function ajax request section  */
        function showAllUsers() {
            $.ajax({
                url: "action.php",
                type: "POST",
                data: {
                    action: "view"
                },
                success: function (response) {
                    //console.log(reponse);
                    $("#showUsers").html(response);
                    $("table").DataTable({
                        order: [0, 'desc']
                    });
                }
            });
        }

        /* get all users function ajax request  section */

        /* insert function ajax request section */
        $("#insert").click(function (event) {
            // here you we grab the data from the from and check if it valid or not
            if ($("#form-data")[0].checkValidity()) {
                // this prevents stop submitting the form
                event.preventDefault();

                $.ajax({
                    url: "action.php",
                    type: "POST",
                    // this serializes method grab all the input fields values into a array
                    data: $("#form-data").serialize() + "&action=insert",
                    success: function (response) {
                        // console.log(response);
                        /* this section is the success message */
                        Swal.fire({
                            icon: 'success',
                            title: 'User added successfully',
                            type: 'success'
                        })
                        /* this section to hide the modal after click the submit button  */
                        $("#addModal").modal("hide");
                        /* now we need to reset the form fields */
                        $("#form-data")[0].reset();
                        showAllUsers();

                    }
                });
            }
        });
        /* insert function ajax request section */

        /* update function ajax request section */
        $("body").on("click", ".editBtn", function (event) {
            // console.log("working");
            event.preventDefault();
            update_id = $(this).attr('id');
            $.ajax({
                url: "action.php",
                type: "POST",
                data: {update_id: update_id},
                success: function (response) {
                    // console.log(response);
                    /* the line to parse the json data and converted into javascript object */
                    data = JSON.parse(response);
                    // console.log(data);
                    $("#id").val(data.id);
                    $("#fname").val(data.first_name);
                    $("#lname").val(data.last_name);
                    $("#email").val(data.email);
                    $("#phone").val(data.phone);
                }
            });
        });

        /* Update AJAX request section */
        $("#update").click(function (event) {
            if ($("#update-form-data")[0].checkValidity()) {
                event.preventDefault();
                $.ajax({
                    url: "action.php",
                    type: "POST",
                    data: $("#update-form-data").serialize() + "&action=update",
                    success: function (response) {
                        Swal.fire({
                            icon: 'success',
                            title: 'User Updated successfully',
                            type: 'success'
                        })
                        $("#updateModal").modal("hide");
                        $("#update-form-data")[0].reset();
                        showAllUsers();
                    }
                });
            }
        });
        /* Update AJAX request section */

        /* Delete AJAX request section */
        $("body").on("click", ".deleteBtn", function (event) {
            event.preventDefault();
            var tr = $(this).closest("tr");
            delete_id = $(this).attr('id');
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "action.php",
                        type: "POST",
                        data: {delete_id: delete_id},
                        success: function (response) {
                            tr.css("background-color", "#ff6666");
                            Swal.fire({
                                icon: 'success',
                                title: 'User Deleted successfully'
                            })
                            showAllUsers();
                        }
                    });
                }
            })
        });
        /* Delete AJAX request section */

        /* View User Information Section */
        $("body").on("click", ".infoBtn", function (event) {
            event.preventDefault();
            info_id = $(this).attr("id");
            $.ajax({
                url: "action.php",
                type: "POST",
                data: {info_id: info_id},
                success: function (response) {
                    data = JSON.parse(response);
                    Swal.fire({
                        icon: 'info',
                        title: '<strong>User Info : ID (' + data.id + ')</strong>',
                        type:'info',
                        html:'<b>First Name: </b> ' + data.first_name + '<br>' +
                            '<b>Last Name: </b> ' + data.last_name + '<br>'+
                            '<b>Last Name: </b> ' + data.email + '<br>'+
                            '<b>Last Name: </b> ' + data.phone ,
                        showCancelButton: true,
                    })
                }
            });
        });
        /* View User Information Section */
    });
</script>
</body>

</html>