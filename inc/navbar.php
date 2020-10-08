<nav class="navbar">
    <span class="navbar_slider">
        <a href="#" class="btn_slider">
            <i class="fas fa-bars"></i>
        </a>
    </span>
    <div class="navbar_nav">
        <div class="navbar_logo">
            <a href="<?= BASE_URL . 'index.php'; ?>">Logo</a>
        </div>
        <ul class="navbar_list">
            <li>
                <a href="<?= BASE_URL . 'about.php' ?>">Aout</a>
                <a href="<?= BASE_URL . 'discover.php' ?>">Discover</a>
                <a href="<?= BASE_URL . 'faq.php' ?>">FAQ</a>
                <?php if (isset($_SESSION['u_id'])): ?>
                    <a href="<?= BASE_URL . 'users/dashboard.php?id='.$_SESSION['u_id']; ?>">Dashboard</a>
                    <a href="<?= BASE_URL . 'users/profile.php?id='.$_SESSION['u_id']; ?>">Profile</a>
                <?php elseif (empty($_SESSION['u_id'])): ?>
                    <a href="<?= BASE_URL . 'register.php' ?>">Sign Up</a>
                    <a href="<?= BASE_URL . 'login.php' ?>">Login</a>    
                <?php endif; ?>    
            </li>
        </ul>
        <ul class="register">
            <?php if (isset($_SESSION['u_id'])): ?>
                <li><form method="post" action="<?= BASE_URL . 'logout.php'; ?>"><button type="submit" name="logout" class="btn_logout">Logout</button></form></li>
            <?php endif; ?>    
        </ul>
    </div>
    <div class="navbar_logo_mob">
        <a href="<?= BASE_URL . 'index.php'; ?>">Logo</a>
    </div>
</nav>
<div id="navbar_side_menu" class="side_nav">
    <a href="#" class="btn_close">&times;</a>
    <ul class="navbar_list">
        <li>
            <a href="<?= BASE_URL . 'about.php' ?>">About</a>
            <a href="<?= BASE_URL . 'discover.php' ?>">Discover</a>
            <a href="<?= BASE_URL . 'faq.php' ?>">FAQ</a>
            <?php if (isset($_SESSION['u_id'])): ?>
                <a href="<?= BASE_URL . 'users/dashboard.php?id='.$_SESSION['u_id']; ?>">Dashboard</a>
                <a href="<?= BASE_URL . 'users/profile.php?id='.$_SESSION['u_id']; ?>">Profile</a>
            <?php endif; ?> 
        </li>
    </ul>
    <ul class="register">
        <?php if (isset($_SESSION['u_id'])): ?>
                <li><form method="post" action="<?= BASE_URL . 'logout.php'; ?>"><button type="submit" name="logout" class="btn_logout">Logout</button></form></li>
            <?php elseif (empty($_SESSION['u_id'])): ?>
                <li><a href="<?= BASE_URL . 'register.php' ?>">Sign Up</a></li>
                <li><a href="<?= BASE_URL . 'login.php' ?>">Login</a></li>
            <?php endif; ?>
    </ul>
</div>
