<?php

    if (isset($_POST['logout'])) {
        session_start();
        session_unset($_SESSION['u_id']);
        session_destroy();
        header('location: index.php?logout_successful');
    }

    // EOF
    