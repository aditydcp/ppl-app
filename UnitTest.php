<?php declare(strict_types=1);
session_start();
use PHPUnit\Framework\TestCase;


final class UnitTest extends TestCase
{
    public function testConnection(): mysqli
    {
        // this is the code for connect.php
        // given initials (credential)
        $hostname = 'localhost';
        $username = 'root';
        $password = '';
        $database = 'ppl_data';
        
        // do
        $conn = mysqli_connect($hostname,$username,$password,$database);

        // then
        // assert the connect_error method of the object $conn
        // the method will return NULL if there is no connection error
        $this->assertNull($conn->connect_error);

        return $conn; // this connection is passed for use in further test cases
    }

    /**
     * @depends testConnection
     */
    public function testRegister(mysqli $conn): void
    {
        // this is the code in auth.php for registration
        // given initials
        $name = "testAditya";
        $email = "aditya@test-mail.com";
        $password_1 = "password";
        $password_2 = "password";
        $company = "Any Company";
        $errors = array();
        $result = false;
        
        // do
        if (empty($email)) {
            $errors[] = "Email tidak boleh kosong";
        }
        else {
            // check if e-mail address is well-formed
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = "Format email tidak sesuai";
            }
        }
    
        if (empty($name)) {
            $errors[] = "Nama tidak boleh kosong";
        }
        else {
            // check if name only contains letters, numbers and whitespace
            if (!preg_match("/^[0-9a-zA-Z-' ]*$/",$name)) {
            $errors[] = "Nama hanya dapat diisi alfanumerik dan spasi";
            }
        }
    
        if (empty($company)) { $errors[] = "Nama Instansi harus diisi"; }
        else { 
            // check if name only contains letters, numbers and whitespace
            if (!preg_match("/^[0-9a-zA-Z-' ]*$/", $company)) {
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

        if(count($errors) == 0){
            $user_query = "INSERT INTO competitors (
                email,
                password,
                name,
                company
            ) VALUES (
                '$email',
                '$password_1',
                '$name',
                '$company'
            )";
            $result = mysqli_query($conn, $user_query);
        }

        // then
        $this->assertTrue($result);
    }

    /**
     * @depends testConnection
     */
    public function testRegisterNoPassword(mysqli $conn): void
    {
        // this is the code in auth.php for registration
        // given initials
        $name = "testAdityaNoPassword";
        $email = "aditya@test-mail.com";
        $password_1 = "";
        $password_2 = "";
        $company = "Any Company";
        $errors = array();
        $result = false;

        // do
        if (empty($email)) {
            $errors[] = "Email tidak boleh kosong";
        }
        else {
            // check if e-mail address is well-formed
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = "Format email tidak sesuai";
            }
        }
    
        if (empty($name)) {
            $errors[] = "Nama tidak boleh kosong";
        }
        else {
            // check if name only contains letters, numbers and whitespace
            if (!preg_match("/^[0-9a-zA-Z-' ]*$/",$name)) {
            $errors[] = "Nama hanya dapat diisi alfanumerik dan spasi";
            }
        }
    
        if (empty($company)) { $errors[] = "Nama Instansi harus diisi"; }
        else { 
            // check if name only contains letters, numbers and whitespace
            if (!preg_match("/^[0-9a-zA-Z-' ]*$/", $company)) {
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

        if(count($errors) == 0){
            $user_query = "INSERT INTO competitors (
                email,
                password,
                name,
                company
            ) VALUES (
                '$email',
                '$password_1',
                '$name',
                '$company'
            )";
            $result = mysqli_query($conn, $user_query);
        }

        // then
        $this->assertTrue($result);
    }

    /**
     * @depends testConnection
     */
    public function testRegisterNoEmail(mysqli $conn): void
    {
        // this is the code in auth.php for registration
        // given initials
        $name = "testAdityaNoEmail";
        $email = "";
        $password_1 = "password";
        $password_2 = "password";
        $company = "Any Company";
        $errors = array();
        $result = false;

        // do
        if (empty($email)) {
            $errors[] = "Email tidak boleh kosong";
        }
        else {
            // check if e-mail address is well-formed
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = "Format email tidak sesuai";
            }
        }
    
        if (empty($name)) {
            $errors[] = "Nama tidak boleh kosong";
        }
        else {
            // check if name only contains letters, numbers and whitespace
            if (!preg_match("/^[0-9a-zA-Z-' ]*$/",$name)) {
            $errors[] = "Nama hanya dapat diisi alfanumerik dan spasi";
            }
        }
    
        if (empty($company)) { $errors[] = "Nama Instansi harus diisi"; }
        else { 
            // check if name only contains letters, numbers and whitespace
            if (!preg_match("/^[0-9a-zA-Z-' ]*$/", $company)) {
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

        if(count($errors) == 0){
            $user_query = "INSERT INTO competitors (
                email,
                password,
                name,
                company
            ) VALUES (
                '$email',
                '$password_1',
                '$name',
                '$company'
            )";
            $result = mysqli_query($conn, $user_query);
        }

        // then
        $this->assertFalse($result); // assertFalse because we expect this to fail
    }

    /**
     * @depends testConnection
     */
    public function testLogin(mysqli $conn): int
    {
        // this is the code in auth.php for login
        // given initials
        $email = "aditya@test-mail.com";
        $password = "password";
        $errors = array();
        $_SESSION['email'] = "";
        $result = null;

        // do
        if (empty($email)) {
            $errors[] = "Email harus diisi";
        }
        if (empty($password)) {
            $errors[] = "Password harus diisi";
        }
      
        if (count($errors) == 0) {
            $user_query = "SELECT * FROM competitors WHERE email='$email' AND password='$password' LIMIT 1";
            $user = mysqli_query($conn, $user_query);
            $result = mysqli_num_rows($user);
            if ($result == 1) {
                $_SESSION['email'] = $email;
            }
        }

        // then
        $this->assertEquals(1, $result); // we expected that there will only be 1 result -> successful login
        $this->assertEquals($email, $_SESSION['email']); // we expect that email is passed to the session var 'email'

        return $user['id']; // this id will be used in InsertPhoto and InsertFile test cases
    }

    /**
     * @depends testConnection
     */
    public function testLoginNoAccount(mysqli $conn): void
    {
        // this is the code in auth.php for login
        // given initials (random account)
        $email = "randomize@randomail.com";
        $password = "randompassword";
        $errors = array();
        $_SESSION['email'] = "";
        $result = null;

        // do
        if (empty($email)) {
            $errors[] = "Email harus diisi";
        }
        if (empty($password)) {
            $errors[] = "Password harus diisi";
        }
      
        if (count($errors) == 0) {
            $user_query = "SELECT * FROM competitors WHERE email='$email' AND password='$password' LIMIT 1";
            $user = mysqli_query($conn, $user_query);
            $result = mysqli_num_rows($user);
            if ($result == 1) {
                $_SESSION['email'] = $email;
            }
        }

        // then
        $this->assertNull($result); // assertNull because we expect no resulting record
        $this->assertEmpty($_SESSION['email']); // assertEmpty because we expect nothing passed into session variable 'email'
    }

    /**
     * @depends testConnection
     */
    public function testLoginNoPassword(mysqli $conn): void
    {
        // this is the code in auth.php for login
        // given initials
        $email = "aditya@test-mail.com";
        $password = "";
        $errors = array();
        $_SESSION['email'] = "";
        $result = null;

        // do
        if (empty($email)) {
            $errors[] = "Email harus diisi";
        }
        if (empty($password)) {
            $errors[] = "Password harus diisi";
        }
      
        if (count($errors) == 0) {
            $user_query = "SELECT * FROM competitors WHERE email='$email' AND password='$password' LIMIT 1";
            $user = mysqli_query($conn, $user_query);
            $result = mysqli_num_rows($user);
            if ($result == 1) {
                $_SESSION['email'] = $email;
            }
        }

        // then
        $this->assertNull($result); // assertNull because we expect no resulting record
        $this->assertEmpty($_SESSION['email']); // assertEmpty because we expect nothing passed into session variable 'email'
    }

    /**
     * @depends testConnection
     * @depends testLogin
     */
    public function testAcceptData(mysqli $conn, int $id): void
    {
        // given initials
        $photo_flag = "";
        $file_flag = "";

        // do
        // this is the code in admin.php for accepting photo and file
        mysqli_query($conn, "UPDATE competitors SET photo_flag=3 WHERE id=$id"); // accept photo
        mysqli_query($conn, "UPDATE competitors SET file_flag=3 WHERE id=$id"); // accept file

        // fetch the flags from database
        $account_query = "SELECT * from competitors WHERE id='$id' LIMIT 1";
        $account_query_result = mysqli_query($conn, $account_query);
        $account_data = mysqli_fetch_assoc($account_query_result);
        $photo_flag = $account_data['photo_flag'];
        $file_flag = $account_data['file_flag'];

        // then
        // assert equal to 3 because 3 is the flag for accepted data
        $this->assertEquals(3, $photo_flag);
        $this->assertEquals(3, $file_flag);
    }

    /**
     * @depends testConnection
     * @depends testLogin
     */
    public function testRejectData(mysqli $conn, int $id): void
    {
        // given initials
        $photo_flag = "";
        $file_flag = "";

        // do
        // this is the code in admin.php for rejecting photo and file
        mysqli_query($conn, "UPDATE competitors SET photo_flag=2 WHERE id=$id"); // accept photo
        mysqli_query($conn, "UPDATE competitors SET file_flag=2 WHERE id=$id"); // accept file

        // fetch the flags from database
        $account_query = "SELECT * from competitors WHERE id='$id' LIMIT 1";
        $account_query_result = mysqli_query($conn, $account_query);
        $account_data = mysqli_fetch_assoc($account_query_result);
        $photo_flag = $account_data['photo_flag'];
        $file_flag = $account_data['file_flag'];

        // then
        // assert equal to 2 because 2 is the flag for rejected data
        $this->assertEquals(2, $photo_flag);
        $this->assertEquals(2, $file_flag);
    }
}