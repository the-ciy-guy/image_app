<?php
    $username = "";
    $email = "";
    $profile_pic = "";

    if (!isset($_POST['register_user'])) {
        return;
        header('location: register.php');
    }

    if (isset($_POST['register_user'])) {
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $email = mysqli_real_escape_string($conn, $_POST['user_email']);
        $password_1 = mysqli_real_escape_string($conn, $_POST['password']);
        $password_2 = mysqli_real_escape_string($conn, $_POST['password_confirmation']);

        if (empty($username) || empty($email) || empty($password_1)) {
            header('location: register.php?register=fields_empty&'.$username.'&email='.$email);
            exit();
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            header('location: register.php?register=not_a_valid_email&username='.$username.'&email='.$email);
            exit();
        }
        if ($password_1 != $password_2) {
            header('location: register.php?register=passwords_do_not_match='.$username.'&email='.$email);
            exit();
        }

        $user_check_query = "SELECT * FROM users WHERE username='$username' OR email='$email' LIMIT 1";
        $result = mysqli_query($conn, $user_check_query);
        $user = mysqli_fetch_assoc($result);

        if ($user) {
            if ($user['username'] === $username) {
                header('location: register.php?register=user_already_exists');
                exit();
            }
            if ($user['email'] === $email) {
                header('location: register.php?register=user_already_exists');
                exit();
            }
        }
        
        if ($user <= 0) {
            $password = password_hash($password_1, PASSWORD_DEFAULT);
            $sql = "INSERT INTO users (username, email, password, created_at, updated_at) VALUES ('$username', '$email', '$password', now(), now())";
            mysqli_query($conn, $sql);
            $query = "SELECT * FROM users WHERE email = '$email'";
            $login = mysqli_query($conn, $query);
            $check = mysqli_num_rows($login);
            $row = mysqli_fetch_assoc($login);
            $_SESSION['is_logged_in'] = $row['id'];
            $_SESSION['u_id'] = $row['id'];
            $_SESSION['u_username'] = $row['username'];
            $_SESSION['u_email'] = $row['email'];
            $_SESSION['u_password'] = $row['password'];
            header('location:' .BASE_URL. 'users/dashboard.php?register=successful&id='.$_SESSION['u_id']);
            exit();
        }
    }

    function register_error()
    {
        if (!isset($_GET['register'])) {
            return;
        }
        else {
            $register_check = $_GET['register'];
            if ($register_check == "fields_empty") {
                echo "<p class='error'>Fields cannot be empty!</p>";
                return;
            }
            elseif ($register_check == "not_a_valid_email") {
                echo "<p class='error'>Invalid Email</p>";
                return;
            }
            elseif ($register_check == "passwords_do_not_match") {
                echo "<p class='error'>Passwords do not match!</p>";
                return;
            }
            elseif ($register_check == "user_already_exists") {
                echo "<p class='error'>User or Email already exists</p>";
                return;
            }
        }
    }

    // EOF
    