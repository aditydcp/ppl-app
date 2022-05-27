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

    //include "file-handler.php";
?>

<html>
<head>
    <title>Backathon | Dashboard</title>

    <?php include "basic-head.php"; ?>
    <link rel="stylesheet" href="dashboard.css">
</head>
<body>
    <h1 id="welcome">Welcome, <?= $accountData['name'] ?></h1>
    <section id="foto">
        <?php
            if (is_null($accountData['photo_url'])) { ?>
            <h2> <?= "Lengkapi identitasmu"; ?> </h2>
        <?php } ?>

        <img id="foto-ganteng" src="assets-img-placeholder_photo.jpg" alt="Si ganteng" height="400">

        <form action="" method="POST">
            <label class="input-wrapper" id="photoWrapper">
                <span class="input-label">Upload your beautiful face</span>
                <input type="file" name="photo" accept="image/*" class="form-control-file" required>
            </label>

            <button type="submit" name="photo_form" class="button action-button">Kunci Berkas</button>
            <span class="input-description"> Berkas akan dikunci dan hanya dapat diubah setelah ada konfirmasi dari pihak Admin. </span>
        </form>

    </section>
    <section id="file">
        <h2> Upload Berkas Lomba </h2>
        <form action="" method="POST">
            <label class="input-wrapper" id="fileWrapper">
                <input type="file" name="file" accept="application/pdf" class="form-control-file" required>
            </label>

            <button type="submit" name="file_form" class="button action-button">Kunci Berkas</button>
            <span class="input-description"> Berkas akan dikunci dan hanya dapat diubah setelah ada konfirmasi dari pihak Admin. </span>
        </form>
    </section>
</body>
</html>