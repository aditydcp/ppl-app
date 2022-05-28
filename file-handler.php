<?php
session_start();
require_once 'connect.php';

$email = $_SESSION['email'];
if (!isset($email)) { //if session not valid, return to login page
    header('location: /login');
    exit;
}

//get user data via query
$user_data_query = "SELECT * FROM competitors WHERE email='$email' LIMIT 1";
$user = mysqli_fetch_assoc(mysqli_query($conn, $user_data_query));

$user_id = $user['id'];
$errors = array();

// prepare large uploads
ini_set('upload_max_filesize', '30M');
ini_set('post_max_size', '30M');
ini_set('max_input_time', 900);
ini_set('max_execution_time', 900);

// Prepare the upload directory
$user_root_dir = "/ppl-app/user-uploads/user-$user_id";
// create directory if not exist
if (!file_exists($user_root_dir)) {
    mkdir($user_root_dir, 0777, true);
}

# PHOTO UPLOAD REGION -- START

if (isset($_POST['photo_form'])) {

    $file = $_FILES['photo'];

    // Check uploaded file type, reject if doesn't match
    if (!preg_match("/^image\/(png|jp(e?)g)$/", $file['type'])) {
        $errors[] = "File hanya dapat berupa png, jpg, atau jpeg.";
    }

    // Check if image file is an actual image or fake image
    if (
        preg_match("/^image\/(png|jp(e?)g)$/", $file['type']) &&
        !getimagesize($file['tmp_name'])
    ) {
        $errors[] =  "File gambar tidak sesuai.";
    }

    if (count($errors) == 0) {

        $target_file_path = "$user_root_dir/foto.".strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        if (move_uploaded_file($file['tmp_name'], $target_file_path)) {
            mysqli_query($conn, "UPDATE competitors SET photo_flag=1, photo_url='$target_file_path' WHERE email='$email'");
            header("Location: /ppl-app/dashboard.php");
        }
        else {
            $errors[] =  "Terjadi kegagalan dalam mengunggah file.";
        }
    }
}

# PHOTO UPLOAD REGION -- END

# FILE UPLOAD REGION -- START

if (isset($_POST['file_form'])) {

    $file = $_FILES['file'];
    //var_dump($file);

    // Check uploaded file type, reject if doesn't match
    if (!preg_match("/^application\/(zip|x-zip-compressed|x-rar-compressed|vnd\.rar|rar|octet-stream)|multipart\/x-zip$/", $file['type'])) {
        $errors[] = "Tipe file tidak sesuai! File hanya dapat berupa format .rar atau .zip.";
    }

    if (count($errors) == 0) {

        $target_file_path = "$user_root_dir/proposed_solution.".strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        if (move_uploaded_file($file['tmp_name'], $target_file_path)) {
            mysqli_query($conn, "UPDATE competitors SET file_flag=1, file_url='$target_file_path' WHERE email='$email'");
            header("Location: /ppl-app/dashboard.php");
        }
        else {
            $errors[] =  "Terjadi kegagalan dalam mengunggah file.";
        }
    }

}

# FILE UPLOAD REGION -- END