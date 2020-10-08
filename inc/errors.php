<?php
    function loginErrrors()
    {
        if (!isset($_GET['login'])) {
            return;
        }
        else {
            $login_check = $_GET['login'];
            if ($login_check == "empty") {
                echo "<p class='error'>Fields cannot be empty</p>";
                return;
            }
            elseif ($login_check == "not_a_valid_email") {
                echo "<p class='error'>Invalid Email</p>";
                return;
            }
            elseif ($login_check == "no_user_or_wrong_password") {
                echo "<p class='error'>Email and Password do not match our records!</p>";
                return;
            }
        }
    }

    function editUserErrors()
    {
        if (!isset($_GET['add_info'])) {
            return;
        }
    }

    // EOF
    