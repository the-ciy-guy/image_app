<?php
    
    include 'config.php';
    include ROOT_PATH . '/inc/header.php';
    include 'functions.php';
    
?>
<title>CIY Images | Discover</title>
</head>
<body>
    <div id="main">
        <?php include ROOT_PATH . '/inc/navbar.php'; ?>
        <div class="container" id="home">
            <div class="body_container">
                <section class="section_discover">
                    <h2>Popular Galleries</h2>
                    <ul class="discover_grid">
                        <?php
                            // galleriesLatest() from galleries_functions.php
                            $galleries = galleriesLatest();
                            $i = 1;
                            if (mysqli_num_rows($galleries) == 0): ?>
                                <p>No Galleries</p>
                            <?php else: ?>
                                <?php while ($row = mysqli_fetch_array($galleries)):        
                        ?>
                        <li class="folder_discover">
                            <a href="<?= BASE_URL . 'galleries/gallery.php?gallery_id='.$row['id']; ?>">
                                <img src="<?= BASE_URL . 'gallery_thumbnails/'.$row['gallery_thumbnail']; ?>" alt="">
                                <div class="meta_discover">
                                    <h3 class="grid_row"><?= $row['gallery_name']; ?></h3>
                                    <p class="grid_row"><i class="fas fa-images"></i> 
                                        <?php 
                                            global $conn;
                                            $get_gallery = $row['id'];
                                            $query = "SELECT gallery_id, count(pictures.gallery_id) from pictures join galleries on pictures.gallery_id = galleries.id WHERE gallery_id = $get_gallery GROUP BY gallery_id";
                                            $result = mysqli_query($conn, $query);
                                            $pictures = mysqli_fetch_array($result);
                                            $total = $pictures[1];
                                            echo $total; 
                                        ?>
                                    </p>
                                </div>
                            </a>
                        </li>
                        <?php 
                            $i++;
                                endwhile;
                            endif;
                        ?>
                    </ul>
                    
                    <div class="category">
                        <h2>Photography Topics</h2>
                        <?php
                            $link1 = 'folks';
                            $link2 = 'people';
                            $link3 = 'women';
                        ?>
                        <ul class="cat_carousel">
                            <li class="cat_list"><a href="<?= BASE_URL . 'discover/category.php?category='.$link1; ?>">Folks</a></li>
                            <li class="cat_list"><a href="<?= BASE_URL . 'discover/category.php?category='.$link2; ?>">People</a></li>
                            <li class="cat_list"><a href="<?= BASE_URL . 'discover/category.php?category='.$link3; ?>">Women</a></li>
                        </ul>
                    </div>
                    <ul class="front_page">
                        <a class="folder_discover img_grid" href="<?= BASE_URL . 'discover/category.php?category='.$link1; ?>">
                        <ul>
                            <?php 
                                // getCategoryTopics() from galleries_functions.php
                                $cat_gallery = getCategoryTopics();
                                $n = 1;
                                while ($row = mysqli_fetch_array($cat_gallery)): 
                                    if ($row['gallery_category'] == "Folks"): ?>
                                        <li class="disc_grid">
                                            <img src="<?= BASE_URL . 'gallery_thumbnails/'.$row['gallery_thumbnail']; ?>" alt="">
                                        </li>  
                                <?php 
                                    endif;
                                endwhile;
                                $n++;
                                ?>
                            </ul>                  
                            <h3 class="grid_row"><?= $link1; ?></h3>
                        </a>
                        <a class="folder_discover img_grid" href="<?= BASE_URL . 'discover/category.php?category='.$link2; ?>">         
                            <ul>
                            <?php
                                $cat_gallery = getCategoryTopics();
                                $n = 1;
                                while ($row = mysqli_fetch_array($cat_gallery)): 
                                    if ($row['gallery_category'] == "People"): ?>
                                        <li class="disc_grid">
                                            <img src="<?= BASE_URL . 'gallery_thumbnails/'.$row['gallery_thumbnail']; ?>" alt="">
                                        </li>  
                                <?php 
                                    endif; 
                                endwhile;
                                $n++;
                                ?> 
                            </ul>
                            <h3 class="grid_row"><?= $link2; ?></h3>
                        </a>
                    </ul>
                </section>
                <section class="section_discover">
                    <h2>Drinks</h2>
                    <div class="category">
                        <?php
                            $link1 = 'summer';
                            $link2 = 'beer';
                            $link3 = 'wine';
                        ?>
                        <ul class="cat_carousel">
                            <li class="cat_list"><a href="<?= BASE_URL . 'discover/category.php?category='.$link1; ?>">Summer</a></li>
                            <li class="cat_list"><a href="<?= BASE_URL . 'discover/category.php?category='.$link2; ?>">Beer</a></li>
                            <li class="cat_list"><a href="<?= BASE_URL . 'discover/category.php?category='.$link3; ?>">Wine</a></li>
                        </ul>
                    </div>
                    <ul class="front_page">
                        <a class="folder_discover img_grid" href="<?= BASE_URL . 'discover/category.php?category='.$link1; ?>">
                            <ul>
                                <?php
                                    // getDrinksCatGalleries() from galleries_functions.php
                                    $drinks_gallery = getDrinksCatGalleries();
                                    $i = 1;
                                    while ($row = mysqli_fetch_array($drinks_gallery)): 
                                        if ($row['gallery_category'] == "Summer"): ?>
                                <li class="disc_grid">
                                    <img src="<?= BASE_URL . 'gallery_thumbnails/'.$row['gallery_thumbnail']; ?>" alt="">
                                </li>
                                <?php 
                                        endif; 
                                    endwhile;
                                    $i++;
                                ?>
                            </ul>
                            <h3 class="grid_row">Summer</h3>
                        </a>
                        <a class="folder_discover img_grid" href="<?= BASE_URL . 'discover/category.php?category='.$link2; ?>">
                            <ul>
                                <?php
                                    $drinks_gallery = getDrinksCatGalleries();
                                    $i = 1;
                                    while ($row = mysqli_fetch_array($drinks_gallery)): 
                                        if ($row['gallery_category'] == "Beer"): ?>
                                            <li class="disc_grid">
                                                <img src="<?= BASE_URL . 'gallery_thumbnails/'.$row['gallery_thumbnail']; ?>" alt="">
                                            </li>
                                <?php 
                                        endif; 
                                    endwhile;
                                    $i++;
                                ?> 
                            </ul>
                            <h3 class="grid_row">Beer</h3>
                        </a>
                        <a class="folder_discover img_grid" href="<?= BASE_URL . 'discover/category.php?category='.$link3; ?>">
                            <ul>
                                <?php 
                                    $wine_gallery = getDrinksCatGalleries();
                                    $i = 1;
                                    while ($row = mysqli_fetch_array($wine_gallery)):
                                        if ($row['gallery_category'] == "Wine"): ?>
                                            <li class="disc_grid">
                                                <img src="<?= BASE_URL . 'gallery_thumbnails/'.$row['gallery_thumbnail']; ?>" alt="">
                                            </li>
                                    <?php 
                                        endif; 
                                    endwhile;
                                    $i++;
                                    ?>
                            </ul>
                            <h3 class="grid_row">Wine</h3>
                        </a>
                    </ul>
                </section>
                <section class="section_discover">
                    <h2>Food</h2>
                    <div class="category">
                        <?php
                            $link1 = 'meat';
                            $link2 = 'chicken';
                            $link3 = 'amazing vegetables';
                        ?>
                        <ul class="cat_carousel">
                            <li class="cat_list"><a href="<?= BASE_URL . 'discover/category.php?category='.$link1; ?>">Meat</a></li>
                            <li class="cat_list"><a href="<?= BASE_URL . 'discover/category.php?category='.$link2; ?>">Chicken</a></li>
                            <li class="cat_list"><a href="<?= BASE_URL . 'discover/category.php?category='.$link3 ?>">Amazing Vegetables</a></li>
                        </ul>    
                    </div>
                    <ul class="front_page">
                        <a class="folder_discover img_grid" href="<?= BASE_URL . 'discover/category.php?category='.$link1; ?>">
                            <ul>
                                <?php
                                    // getFoodsCatGalleryOne() from galleries_functions.php
                                    $food_gallery = getFoodsCatGalleryOne();
                                    $i = 1;
                                    while ($row = mysqli_fetch_array($food_gallery)): 
                                        
                                ?>
                                    <li class="disc_grid"><img src="<?= BASE_URL . 'gallery_thumbnails/'.$row['gallery_thumbnail']; ?>" alt=""></li>
                                <?php 
                                    endwhile;
                                    $i++;
                                ?>
                            </ul>
                            <h3 class="grid_row">Meat</h3>
                        </a>
                        <a class="folder_discover img_grid" href="<?= BASE_URL . 'discover/category.php?category='.$link2; ?>">
                            <ul>
                            <?php
                                // getFoodsCatGalleryTwo() from galleries_functions.php
                                $food_gallery = getFoodsCatGalleryTwo();
                                $i = 1;
                                while ($row = mysqli_fetch_array($food_gallery)): 
                                    if ($row['gallery_category'] == "Chicken" || $row['gallery_category'] == "chicken"): 
                            ?>
                                <li class="disc_grid"><img src="<?= BASE_URL . 'gallery_thumbnails/'.$row['gallery_thumbnail']; ?>" alt=""></li>
                            <?php 
                                endif;
                            endwhile;
                            $i++;
                            ?>
                            </ul>
                            <h3 class="grid_row">Chicken</h3>
                        </a>
                        <a class="folder_discover img_grid" href="<?= BASE_URL . 'discover/category.php?category='.$link3; ?>">
                            <ul>
                            <?php
                                // getFoodsCatGalleryThree() from galleries_functions.php
                                $food_gallery = getFoodsCatGalleryThree();
                                $i = 1;
                                while ($row = mysqli_fetch_array($food_gallery)): 
                            ?>
                                <li class="disc_grid"><img src="<?= BASE_URL . 'gallery_thumbnails/'.$row['gallery_thumbnail']; ?>" alt=""></li>
                            <?php 
                                endwhile;
                                $i++;
                            ?>
                            </ul>
                            <h3 class="grid_row">Amazing Vegetables</h3>
                        </a>
                    </ul>
                </section>
                <section class="section_discover">
                    <h2>Travel</h2>
                    <div class="category">
                    <?php
                        $link1 = 'adventure';
                        $link2 = 'beach';
                        $link3 = 'nature';
                    ?>
                        <ul class="cat_carousel">
                            <li class="cat_list"><a href="<?= BASE_URL . 'discover/category.php?category='.$link1; ?>">Adventure</a></li>
                            <li class="cat_list"><a href="<?= BASE_URL . 'discover/category.php?category='.$link2; ?>">Beach</a></li>
                            <li class="cat_list"><a href="<?= BASE_URL . 'discover/category.php?category='.$link3; ?>">Nature</a></li>
                        </ul>
                    </div>
                    <ul class="front_page">
                        <a class="folder_discover img_grid" href="<?= BASE_URL . 'discover/category.php?category='.$link1; ?>">
                            <ul>
                            <?php
                                // getTravelCatGalleriesOne() from galleries_functions.php
                                $travel_gallery = getTravelCatGalleriesOne();
                                $i = 1;
                                while ($row = mysqli_fetch_array($travel_gallery)): 
                            ?>
                                <li class="disc_grid"><img src="<?= BASE_URL . 'gallery_thumbnails/'.$row['gallery_thumbnail']; ?>" alt=""></li>
                            <?php 
                                endwhile;
                                $i++;
                            ?>
                            </ul>
                            <h3 class="grid_row">Adventure</h3>
                        </a>
                        <a class="folder_discover img_grid" href="<?= BASE_URL . 'discover/category.php?category='.$link2; ?>">
                            <ul>
                            <?php
                                // getTravelCatGalleriesTwo() from galleries_functions.php
                                $travel_gallery = getTravelCatGalleriesTwo();
                                $i = 1;
                                while ($row = mysqli_fetch_array($travel_gallery)): 
                            ?>
                                <li class="disc_grid"><img src="<?= BASE_URL . 'gallery_thumbnails/'.$row['gallery_thumbnail']; ?>" alt=""></li>
                            <?php 
                                endwhile;
                                $i++;
                            ?>
                            </ul>
                            <h3 class="grid_row">Beach</h3>
                        </a>
                        <a class="folder_discover img_grid" href="<?= BASE_URL . 'discover/category.php?category='.$link3; ?>">
                            <ul>
                            <?php
                                // getTravelCatGalleriesThree() from galleries_functions.php
                                $travel_gallery = getTravelCatGalleriesThree();
                                $i = 1;
                                while ($row = mysqli_fetch_array($travel_gallery)): 
                            ?>
                                <li class="disc_grid"><img src="<?= BASE_URL . 'gallery_thumbnails/'.$row['gallery_thumbnail']; ?>" alt=""></li>
                            <?php 
                                endwhile;
                                $i++;
                            ?>
                            </ul>
                            <h3 class="grid_row">Nature</h3>
                        </a>
                    </ul>
                </section>
            </div>
        </div>
    </div>
    <?php 
    
    include ROOT_PATH . '/inc/footer.php';

    // EOF
