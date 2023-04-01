<?php

require_once 'db.php';


$database = new Database();

if (isset($_POST['action']) && $_POST['action'] == 'view') {
    $result = '';
    $data = $database->getAllUsers();
    if ($database->totalRowCount() > 0) {
        $result .= '<table class="table table-striped table-sm table-bordered">
                        <thead>
                            <tr class="text-center">
                                <th>ID</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                    <tbody>';
        foreach ($data as $row) {
            $result .= '<tr class="text-center text-secondary">
                            <td>' . $row['id'] . '</td>
                            <td>' . $row['first_name'] . '</td>
                            <td>' . $row['last_name'] . '</td>
                            <td>' . $row['email'] . '</td>
                            <td>' . $row['phone'] . '</td>
                            <td>
                                <a href="#" class="text-success infoBtn" id="' . $row['id'] . '" title="View Details">
                                    <i class="fas fa-info-circle fa-lg"></i>
                                </a>&nbsp;&nbsp;
                                <a href="#" class="text-primary editBtn" id="' . $row['id'] . '" data-toggle="modal" data-target="#updateModal" title="Edit">
                                    <i class="fas fa-edit fa-lg"></i>

                                </a>&nbsp;&nbsp;
                                <a href="#" class="text-danger deleteBtn" id="' . $row['id'] . '" title="Delete">
                                    <i class="fas fa-trash-alt fa-lg"></i>
                                </a>&nbsp;&nbsp;         
                            </td>
                        </tr>';
        }
        $result .= '</tbody></table>';
        echo $result;
    } else {
        echo '<h3 class="text-center text-secondary mt-5">NO Users in The Database</h3>';
    }
}


if (isset($_POST['action']) && $_POST['action'] == "insert") {

    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    $database->insertUser($fname, $lname, $email, $phone);
}

if (isset($_POST['update_id'])) {
    $id = $_POST['update_id'];
    $user = $database->getUserById($id);

    echo json_encode($user);
}

if (isset($_POST['action']) && $_POST['action'] == "update") {

    $id = $_POST['id'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    $database->updateUser($id, $fname, $lname, $email, $phone);
}


if (isset($_POST['delete_id'])) {
    $id = $_POST['delete_id'];
    $user = $database->deleteUser($id);
}


if (isset($_POST['info_id'])) {
    $id = $_POST['info_id'];
    $user = $database->getUserById($id);

    echo json_encode($user);
}

if (isset($_GET['export']) && $_GET['export'] == "excel"){
    header("Contect-Type: application/xlsx");
    header("Content-Disposition: attachment; filename=users.xlsx");
    header("Pragma: no-cache");
    header("Expires: 0");

    $data = $database->getAllUsers();

    echo '<table border="1">';
    echo '<tr><th>ID</th><th>First Name</th><th>Last Name</th><th>Email</th><th>Phone</th></tr>';

    foreach ($data as $row){
        echo '<tr>
                <td>'.$row['id'].'</td>
                <td>'.$row['first_name'].'</td>
                <td>'.$row['last_name'].'</td>
                <td>'.$row['email'].'</td>
                <td>'.$row['phone'].'</td>
              </tr>';
    }
    echo '</table>';
}


