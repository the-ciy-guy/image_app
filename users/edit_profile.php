<?php

    include '../config.php';
    include ROOT_PATH . '/inc/header.php';
    include '../functions.php';

?>
<?php // getLoggedInUserName() from users_function.php ?>
<title>CIY Images | Edit <?= getLoggedInUserName(); ?>'s' Profile</title>
</head>
</body>
    <div id="main">
        <?php include ROOT_PATH . '/inc/navbar.php'; ?>
        <div class="container">
            <div class="body_container">
                <?php 
                    if (!isset($_SESSION['is_logged_in'])) : 
                        header('location: ../login.php');
                    // getLoggedInUserId() from users_function.php    
                    elseif (isset($_SESSION['is_logged_in']) && $_SESSION['u_id'] != getLoggedInUserId()):
                        header('location: ../index.php');
                    elseif (isset($_SESSION['is_logged_in']) && $_SESSION['u_id'] == true) :     
                ?>
                <h2>Edit your details</h2>
                <div class="form">
                    <?php 
                        // editUserErrors() from errors.php
                        editUserErrors(); 
                    ?>
                    <form action="edit_profile.php" method="post">
                        <?php if ($user_edit === true): ?>
                            <input type="hidden" name="id" value="<?= $id; ?>">
                            <input type="email" name="email" placeholder="Email" value="<?= $email; ?>">
                            <textarea name="user_desciption" id="" cols="30" rows="10" placeholder="Enter description"><?= $user_desc; ?></textarea>
                            <button type="submit" name="add_info" class="btn btn_create">Update</button>
                            <button type="button" class="btn btn_delete" onclick="window.location.href='<?= BASE_URL . 'users/profile.php?id='.getLoggedInUserId(); ?>'">Cancel</button>
                        <?php endif; ?>
                    </form>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <?php include ROOT_PATH . '/inc/footer.php';

// EOF
