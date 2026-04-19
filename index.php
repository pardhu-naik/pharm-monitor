<?php
error_reporting(1);
session_start();
include("dbcon.php");

function invoice_number(){
    $chars = "09302909209300923";
    srand((double)microtime()*1000000);
    $i = 1;
    $pass = '';
    while($i <=7){
      $num  = rand()%10;
      $tmp  = substr($chars, $num,1);
      $pass = $pass.$tmp;
      $i++;
    }
    return $pass;
}

if(isset($_SESSION['user_session'])){
    $invoice_number="CA-".invoice_number();
	header("location:home.php?invoice_number=$invoice_number");
    exit();
}

if(isset($_POST['submit'])){
    $username = $_POST['username'];
    $password = sha1($_POST['password']);
    $select_sql = "SELECT * FROM users WHERE user_name = '$username' AND password = '$password'";
    $select_query = mysqli_query($con, $select_sql);
    
    if($select_query && mysqli_num_rows($select_query) > 0){
        $_SESSION['user_session'] = $username;
        $invoice_number="CA-".invoice_number();
        header("location:home.php?invoice_number=$invoice_number");
        exit();
    } else {
        $error_msg = "Login Failed. Please check your credentials.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>pharm@monitor | Precision Pharmacy Management</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/premium.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/3.2.1/anime.min.js"></script>
    <style>
        .error-overlay {
            color: #d9534f;
            margin-top: 1rem;
            font-size: 0.9rem;
            font-weight: 500;
        }
    </style>
</head>
<body>

    <section class="hero-container">
        <img src="images/pill_hero.png" alt="Premium Pill" class="hero-pill">
        <h1 class="hero-title">pharm@monitor</h1>
        <p class="hero-subtitle">Next-generation pharmaceutical orchestration.</p>

        <div class="login-card">
            <h3 style="margin-bottom: 2rem; font-weight: 400;">Secure Portal</h3>
            <form method="POST">
                <input type="text" name="username" class="input-field" placeholder="Username" required autocomplete="off">
                <input type="password" name="password" class="input-field" placeholder="Password" required>
                <button type="submit" name="submit" class="btn-premium">Authenticate</button>
                <?php if(isset($error_msg)): ?>
                    <div class="error-overlay"><?php echo $error_msg; ?></div>
                <?php endif; ?>
            </form>
        </div>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const timeline = anime.timeline({
                easing: 'easeOutExpo',
                duration: 1000
            });

            timeline
            .add({
                targets: '.hero-pill',
                opacity: [0, 1],
                translateY: [50, 0],
                rotate: [15, 0],
                duration: 1500,
                delay: 500
            })
            .add({
                targets: '.hero-title',
                opacity: [0, 1],
                translateY: [30, 0],
                filter: ['blur(10px)', 'blur(0px)'],
                offset: '-=800'
            })
            .add({
                targets: '.hero-subtitle',
                opacity: [0, 1],
                translateY: [20, 0],
                filter: ['blur(10px)', 'blur(0px)'],
                offset: '-=600'
            })
            .add({
                targets: '.login-card',
                opacity: [0, 1],
                translateY: [40, 0],
                offset: '-=400'
            });
        });
    </script>
</body>
</html>