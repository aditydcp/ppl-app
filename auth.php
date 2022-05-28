<?php

session_start();
require_once 'connect.php';

// initializing variables
$email = "";
$nama = "";
$institusi = "";
$password_1 = "";
$errors = array();

# REGISTRATION REGION -- START

if (isset($_POST['register_form'])) {
    // receive all input values from the form
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $nama = mysqli_real_escape_string($conn, $_POST['nama']);
    $institusi =  mysqli_real_escape_string($conn, $_POST['asal']);
    $password_1 = mysqli_real_escape_string($conn, $_POST['password1']);
    $password_2 = mysqli_real_escape_string($conn, $_POST['password2']);

    ## DATA VALIDATION REGION -- START

    // form validation: ensure that the form is correctly filled
    // by adding (array_push()) corresponding error unto $errors array
    if (empty($email)) {
        $errors[] = "Email tidak boleh kosong";
    }
    else {
        // check if e-mail address is well-formed
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Format email tidak sesuai";
        }
    }

    if (empty($nama)) {
        $errors[] = "Nama tidak boleh kosong";
    }
    else {
        // check if name only contains letters, numbers and whitespace
        if (!preg_match("/^[0-9a-zA-Z-' ]*$/",$nama)) {
        $errors[] = "Nama hanya dapat diisi alfanumerik dan spasi";
        }
    }

    if (empty($institusi)) { $errors[] = "Nama Instansi harus diisi"; }
    else { 
        // check if name only contains letters, numbers and whitespace
        if (!preg_match("/^[0-9a-zA-Z-' ]*$/", $institusi)) {
            $errors[] = "Nama Instansi hanya dapat diisi alfanumerik dan spasi";
        }
    }

    if (empty($password_1) || empty($password_2)) { $errors[] = "Password harus diisi"; }
    else {
        // check if password only contains letters and numbers
        if (!preg_match("/^[0-9a-zA-Z]*$/",$password_1)) {
            $errors[] = "Password hanya dapat diisi alfanumerik";
        }
        // check if password contains less than 8 character or more than 20 character
        $pass_length = strlen(preg_replace("/[^0-9a-zA-Z]/", "", $password_1));
        if ($pass_length < 8 || $pass_length > 20) { $errors[] = "Password harus terdiri dari 8 - 20 karakter"; }
        if ($password_1 != $password_2) {
        $errors[] = "Kedua password tidak sesuai";
        }
    }

    // check the database to make sure 
    // a user does not already exist with the same username and/or email
    $user_check_query = "SELECT * FROM competitors WHERE email='$email' LIMIT 1";
    $uc_result = mysqli_query($conn, $user_check_query);

    if (mysqli_fetch_assoc($uc_result)) { // if user exists
        $errors[] = "Email sudah terdaftar";
    }
    ## DATA VALIDATION REGION -- END

    // Finally, register user if there are no errors in the form
    if (count($errors) == 0) {
        //add user into database
        $user_query = "INSERT INTO competitors (
            email,
            password,
            name,
            company
        ) VALUES (
            '$email',
            '$password_1',
            '$nama',
            '$institusi'
        )";
        mysqli_query($conn, $user_query);

        $_SESSION['email'] = $email;

        header('location: /ppl-app/dashboard.php'); // go to dashboard
    }
}

# REGISTRATION REGION -- END

# LOGIN REGION -- START

if (isset($_POST['login_form'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
  
    if (empty($email)) {
        $errors[] = "Email harus diisi";
    }
    if (empty($password)) {
        $errors[] = "Password harus diisi";
    }
  
    if (count($errors) == 0) {
        $query = "SELECT * FROM competitors WHERE email='$email' AND password='$password'";
        $results = mysqli_query($conn, $query);
        if (mysqli_num_rows($results) == 1) {
          $_SESSION['email'] = $email;
          header('Location: /ppl-app/dashboard.php'); //go to dashboard
        }else {
          $errors[] = "Email atau Password salah";
        }
    }
}

# LOGIN REGION -- END

?>