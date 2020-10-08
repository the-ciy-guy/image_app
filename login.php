<?php

    include 'config.php';
    include ROOT_PATH . '/inc/header.php';
    include 'functions.php';

?>
<title>CIY Images | Login</title>
</head>
</body>
    <div id="main">
        <?php include ROOT_PATH . '/inc/navbar.php'; ?>
        <div class="container">
            <div class="body_container">
                <div class="form">
                    <h2>Login</h2>
                    <?php // loginErrors() from errors.php ?>
                    <?php loginErrrors(); ?>
                    <form action="login.php" method="post">
                        <input type="email" name="user_email" placeholder="Email" autocomplete="off">
                        <input type="password" name="user_pass" placeholder="Password">
                        <button type="submit" class="btn btn_confirm" name="login">Login</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php 
    
    include ROOT_PATH . '/inc/footer.php';

    // EOF
