<?php

    include 'config.php';
    include 'functions.php';
    include ROOT_PATH . '/inc/header.php';

?>
<title>CIY Images | Register</title>
</head>
<body>
    <div id="main">
        <?php include ROOT_PATH . '/inc/navbar.php'; ?>
        <div class="container">
            <div class="body_container">
                <div class="form">
                    <h2>Sign Up</h2>
                    <?php // register_error() from errors.php ?>
                    <?php register_error(); ?>
                    <form action="register.php" method="post">
                        <input type="text" name="username" id="" placeholder="Username" autocomplete="off">
                        <input type="email" name="user_email" id="" placeholder="Email" autocomplete="off">
                        <input type="password" name="password" id="" placeholder="Password" autocomplete="off">
                        <input type="password" name="password_confirmation" id="" placeholder="Confirm Password" autocomplete="off">
                        <button type="submit" class="btn btn_confirm" name="register_user">Register</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php 
    
    include ROOT_PATH . '/inc/footer.php';

    // EOF
    