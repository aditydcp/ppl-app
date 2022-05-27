<html>
<head>
    <title>Backathon | Home</title>

    <link rel="stylesheet" href="index.css">
    <link rel="stylesheet" href="main.css">
</head>
<body>
    <div class="title-box">
        <h1 class="title-main">Backathon</h1>
        <span class="title-subtitle">Mundur perlahan</span>
    </div>

    <?php if(isset($_GET["login"])) { // login form, if parameter passed ?>
        Hello, ini login form
        
        <form action="" method="POST" class="form">
            <label class="input-wrapper" id="emailWrapper">
                <span class="input-label">Email</span>
                <input type="email" name="email" class="input-field" value="<?php echo $email; ?>" required>
            </label>

            <label class="input-wrapper">
                <span class="input-label">Password</span>
                <input type="password" name="password" pattern="^[0-9a-zA-Z]*$" minlength="8" maxlength="20" class="input-field" required>
            </label>
                
            <button type="submit" name="login_form" class="button action-button">Login</button>
        </form>
    
    <?php
    } else { // register form, default state ?> 

        <h3> Daftarkan dirimu sekarang! </h3>
        <p>Ikuti Backathon dan menangkan hingga ratusan rupiah!<p>

        <form action="" method="POST" class="form">
            <label class="input-wrapper" id="emailWrapper">
                <span class="input-label">Email</span>
                <input type="email" name="email" class="input-field" value="<?php echo $email; ?>" required>
            </label>

            <label class="input-wrapper" id="namaWrapper">
                <span class="input-label">Nama</span>
                <input type="text" name="nama" class="input-field" value="<?php echo $nama; ?>" required>
            </label>

            <label class="input-wrapper">
                <span class="input-label">Asal sekolah/institusi</span>
                <input type="text" name="asal" class="input-field" value="<?php echo $institusi; ?>" required>
            </label>        
        
            <div class="input-wrapper">
                <label class="input-wrapper">
                    <span class="input-label">Password</span>
                    <input type="password" name="password1" pattern="^[0-9a-zA-Z]*$" minlength="8" maxlength="20" class="input-field" required autocomplete="new-password" aria-describedby="password-help-block">
                </label>
        
                <p class="input-description" id="password-help-block">
                    Password harus terdiri atas 8-20 karakter tanpa mengandung spasi, karakter khusus, atau emoji.
                </p>
            </div>
        
            <div class="input-wrapper">
                <label class="input-wrapper">
                    <span class="input-label">Konfirmasi password</span>
                    <input type="password" name="password2" pattern="^[0-9a-zA-Z]*$" minlength="8" maxlength="20" class="input-field" required autocomplete="new-password" aria-describedby="confirm-password-help-block">
                </label>
        
                <p class="input-description" id="confirm-password-help-block">
                    Masukkan kembali password yang sama.
                </p>
            </div>
                
            <button type="submit" name="register_form" class="button action-button">Sign Up</button>
        </form>
    <?php } ?>
    
</body>
</html>