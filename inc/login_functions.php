<?php
    if (!isset($_POST['login'])) {
        return;
        header('location: login.php?=cannot_login');
        exit();
    }

    if (isset($_POST['login'])) {
        $email = mysqli_real_escape_string($conn, $_POST['user_email']);
        $password = mysqli_real_escape_string($conn, $_POST['user_pass']);

        if (empty($email) || empty($password)) {
            header('location: login.php?login=empty');
            exit();
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            header('location: login.php?login=not_a_valid_email');
            exit();
        }
    }

    $login_query = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($conn, $login_query);
    $check = mysqli_num_rows($result);

    if ($check < 1) {
        header('location: login.php?login=no_user_or_wrong_password');
        exit();
    } else {
        if ($row = mysqli_fetch_assoc($result)) {
            $hashedpwd = password_verify($password, $row['password']);
            if ($hashedpwd == false) {
                header('location: login.php?login=no_user_or_wrong_password');
                exit();
            } elseif ($hashedpwd == true) {
                $_SESSION['is_logged_in'] = $row['id'];
                $_SESSION['u_id'] = $row['id'];
                $_SESSION['u_username'] = $row['username'];
                $_SESSION['u_email'] = $row['email'];
                $_SESSION['u_password'] = $row['password'];
                header('location: ' .BASE_URL. 'users/dashboard.php?id='.$_SESSION['u_id']);
            }
        }
    }

    // EOF
    