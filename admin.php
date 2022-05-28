<?php

session_start();
require_once("connect.php");

?>

<!DOCTYPE html>
<html>    
<head>
    <title> Backathon | Admin Dashboard </title>
    <?php include "basic-head.php"; ?>
</head>
<body>

    <?php
        
        $no = 1;

        // Peform operations if exist in POST request
        // Accept opertaions
        if (isset($_POST['confirm_photo'])) {
            $id = mysqli_real_escape_string($conn, $_POST['confirm_photo']);
            mysqli_query($conn, 
            "UPDATE competitors SET photo_flag=3 WHERE id=$id");
            echo "UPDATE competitors SET photo_flag=3 WHERE id=$id";
        }
        if (isset($_POST['confirm_file'])) {
            $id = mysqli_real_escape_string($conn, $_POST['confirm_file']);
            mysqli_query($conn, 
            "UPDATE competitors SET file_flag=3 WHERE id=$id");
            echo "UPDATE competitors SET file_flag=3 WHERE id=$id";
        }

        // Reject operations
        if (isset($_POST['reject_photo'])) {
            $id = mysqli_real_escape_string($conn, $_POST['reject_photo']);
            mysqli_query($conn, 
            "UPDATE competitors SET photo_flag=2 WHERE id=$id");
            echo "UPDATE competitors SET photo_flag=2 WHERE id=$id";
        }
        if (isset($_POST['reject_file'])) {
            $id = mysqli_real_escape_string($conn, $_POST['reject_file']);
            mysqli_query($conn, 
            "UPDATE competitors SET file_flag=2 WHERE id=$id");
            echo "UPDATE competitors SET file_flag=2 WHERE id=$id";
        }

        // Get data tim from competition
        $accounts_result = mysqli_query($conn, "SELECT * FROM competitors");
    ?>

    <table>
        <caption>Peserta Backathon</caption>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Instansi</th>
                <th>Foto</th>
                <th>Berkas Lomba</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($account = mysqli_fetch_assoc($accounts_result)): ?>
                <tr>
                    <th>
                        <?php
                            echo "$no";
                            $no = $no + 1;
                        ?>
                    </th>
                    <th>
                        <?= $account['name'] ?>
                    </th>
                    <th>
                        <?= $account['email'] ?>
                    </th>
                    <th>
                        <?= $account['company'] ?>
                    </th>
                    <th>
                        <?php
                            switch($account['photo_flag']) {
                                case '0':
                                    echo "Belum upload foto";
                                    break;
                                case '1':
                                    echo "Menunggu konfirmasi";
                                    break;
                                case '2':
                                    echo "Ditolak";
                                    break;
                                case '3':
                                    echo "&#x2705;Sudah terkonfirmasi";
                                    break;
                            }
                            ?>
                            
                            <?php if ($account['photo_flag'] != '0'): ?>
                                <form class="action-button" action="download.php" method="POST">
                                    <input type="text" name="fromandto" value="foto" hidden />
                                    <button type="submit" name="file_download" value="<?= $account['photo_url'] ?>">
                                        Download Ganteng
                                    </button>
                                </form>
                                <?php endif; ?>

                                <?php if ($account['photo_flag'] == '1'): ?>
                                <form class="action-button" action="" method="POST">
                                    <button type="submit" name="confirm_photo" value="<?= $account['id'] ?>">
                                        Konfirmasikan
                                    </button>
                                </form>
                                <form class="action-button" action="" method="POST">
                                    <button type="submit" name="reject_photo" value="<?= $account['id'] ?>">
                                        Tolak
                                    </button>
                                </form>
                            <?php endif;
                        ?>
                    </th>
                    <th>
                        <?php
                            switch($account['file_flag']) {
                                case '0':
                                    echo "Belum upload file";
                                    break;
                                case '1':
                                    echo "Menunggu konfirmasi";
                                    break;
                                case '2':
                                    echo "Ditolak";
                                    break;
                                case '3':
                                    echo "&#x2705;Sudah terkonfirmasi";
                                    break;
                            }
                            ?>
                            
                            <?php if ($account['file_flag'] != '0'): ?>
                                <form class="action-button" action="download.php" method="POST">
                                    <input type="text" name="fromandto" value="berkas" hidden />
                                    <button type="submit" name="file_download" value="<?= $account['file_url'] ?>">
                                        Download Berkas
                                    </button>
                                </form>
                                <?php endif; ?>

                                <?php if ($account['file_flag'] == '1'): ?>
                                <form class="action-button" action="" method="POST">
                                    <button type="submit" name="confirm_file" value="<?= $account['id'] ?>">
                                        Konfirmasikan
                                    </button>
                                </form>
                                <form class="action-button" action="" method="POST">
                                    <button type="submit" name="reject_file" value="<?= $account['id'] ?>">
                                        Tolak
                                    </button>
                                </form>
                            <?php endif;
                        ?>
                    </th>
                </tr>
            <?php endwhile ?>
        </tbody>
    </table>
</body>
</html>