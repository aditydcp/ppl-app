<?php

    session_start();
    require_once "connect.php";

    if (!isset($_SESSION["email"])) {
        header("Location: /ppl-app/index.php?login");
    }

    // fetch account data
    $accountQueryString = "SELECT * from competitors WHERE email='{$_SESSION['email']}' LIMIT 1";
    $accountQueryResult = mysqli_query($conn, $accountQueryString);
    $accountData = mysqli_fetch_assoc($accountQueryResult);

    require "file-handler.php";
?>

<html>
<head>
    <title>Backathon | Dashboard</title>

    <?php include "basic-head.php"; ?>
    <link rel="stylesheet" href="dashboard.css">
</head>
<body>
    <div class="title-wrapper">
        <h1 class="title-main">Backathon</h1>
        <h2 id="welcome">Welcome, <?= $accountData['name'] ?></h2>
    </div>    

    <section id="foto">
        <?php
            if (is_null($accountData['photo_url'])) { ?>
            <h2> <?= "Lengkapi identitasmu"; ?> </h2>
        <?php } ?>

        <div class="img-wrapper">
            <img id="foto-ganteng" src="assets-img-placeholder_photo.jpg" alt="Si ganteng" height="400">
            <?php if($accountData['photo_flag'] == 1) { ?>
                <label class="notification-wrapper notification">
                    <span class="notification-description"> Foto sedang dalam review. Notifikasi ini akan hilang ketika sudah selesai. </span>
                </label>
            <?php } ?>
            <?php if($accountData['photo_flag'] == 2) { ?>
                <label class="notification-wrapper warning">
                    <span class="notification-description"> Foto Anda kurang cakep. Mohon diganti. </span>
                </label>
            <?php } ?>
        </div>

        <form action="" method="POST">
            <label class="input-wrapper" id="photoWrapper">
                <span class="input-label">Upload your beautiful face</span>
                <input type="file" name="photo" accept="image/*" class="form-control-file" required <?php if($accountData['photo_flag'] == 1) { ?> disabled <?php } ?>>
            </label>

            <button type="submit" name="photo_form" class="button action-button">Kunci Berkas</button>
            <span class="input-description"> Berkas akan dikunci dan hanya dapat diubah setelah ada konfirmasi dari pihak Admin. </span>
        </form>

    </section>
    <section id="file">
        <h2> Upload Berkas Lomba </h2>

        <?php if($accountData['file_flag'] == 1) { ?>
            <label class="notification-wrapper notification">
                <span class="notification-description"> Berkas sedang dalam review. Mohon bersabar, ini ujian. </span>
            </label>
        <?php } ?>
        <?php if($accountData['file_flag'] == 2) { ?>
            <label class="notification-wrapper warning">
                <span class="notification-description"> Berkas Anda ditolak. Mohon diganti. </span>
            </label>
        <?php } ?>
        <?php if($accountData['file_flag'] == 3) { ?>
            <label class="notification-wrapper success">
                <span class="notification-description"> Berkas Anda telah diterima. </span>
                <br>
                <span class="notification-description"> [insert nama file] </span>
            </label>
        <?php } ?>

        <form action="" method="POST">

            <?php if ((count($errors) > 0) && (isset($_POST['file_form']))) { ?>
                <div class="notification-wrapper warning">
                    <?php foreach ($errors as $errorMsg) { ?>
                        <p class="form-alert mg-0"><?= $errorMsg ?></p>
                    <?php } ?>
                </div>
            <?php } ?>

            <label class="input-wrapper" id="fileWrapper">
                <?php if($accountData['file_flag'] == 3) { ?>
                    <span class="input-label">Upload new file</span>
                <?php } ?>
                <input type="file" name="file" accept="application/pdf" class="form-control-file" required <?php if($accountData['file_flag'] == 1) { ?> disabled <?php } ?>>
            </label>

            <button type="submit" name="file_form" class="button action-button">Kunci Berkas</button>
            <span class="input-description"> Berkas akan dikunci dan hanya dapat diubah setelah ada konfirmasi dari pihak Admin. </span>
        </form>
    </section>
</body>
</html>