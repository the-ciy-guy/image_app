<?php

    include '../config.php';
    include ROOT_PATH . '/inc/header.php';
    include '../functions.php';

?>
<title>CIY Images | Create Gallery</title>
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
                    elseif (isset($_SESSION['is_logged_in']) && $_SESSION['u_id'] == true):
                ?>
                <div class="form">
                    <?php if ($edit_gallery === true): ?>
                        <h2>Edit Gallery</h2>
                    <?php else: ?>
                        <h2>Create Gallery</h2>
                    <?php endif; ?>
                    <form action="create_gallery.php" method="post" enctype="multipart/form-data">
                        <?php if ($edit_gallery === true): ?>
                            <input type="hidden" name="gallery_id" value="<?= $gallery_id; ?>">
                            <input type="text" name="gallery_name" placeholder="Gallery Name" value="<?= $gallery_name; ?>">
                            <textarea name="gallery_desc" class="gallery_textarea" cols="30" rows="10" placeholder="Description"><?= $gallery_desc; ?></textarea>
                            <input type="text" name="gallery_category" placeholder="Category" value="<?= $gallery_cat; ?>">
                            <label for="gallery_thumbnail" class="form_label">Change Thumbnail</label>
                            <input type="file" name="gallery_thumbnail" id="" placeholder="Add Thumbnail" value="<?php $gallery_thumbnail; ?>">
                            <button type="submit" class="btn btn_create" name="update_gallery">Update</button>
                            <?php // getTheGalleryId() from galleries_functions.php ?>
                            <button type="button" class="btn btn_delete" onclick="window.location.href='<?= BASE_URL . 'galleries/gallery.php?gallery_id=' . getTheGalleryId(); ?>'">Cancel</button>
                        <?php else: ?>
                            <input type="text" name="gallery_name" placeholder="Gallery Name">
                            <textarea name="gallery_desc" class="gallery_textarea" cols="30" rows="10" placeholder="Description"></textarea>
                            <input type="text" name="gallery_category" placeholder="Category">
                            <label for="gallery_thumbnail" class="form_label">Add a Thumbnail</label>
                            <input type="file" name="gallery_thumbnail" id="" placeholder="Add Thumbnail">
                            <button type="submit" class="btn btn_create" name="create_gallery">Create</button>
                            <button type="button" class="btn btn_delete" onclick="window.location.href='<?= BASE_URL . 'galleries/gallery.php?gallery_id=' . getTheGalleryId(); ?>'">Cancel</button>
                        <?php endif; ?>    
                    </form>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <?php include ROOT_PATH . '/inc/footer.php';

    // EOF
    