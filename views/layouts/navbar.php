    <header class="navbar">            
      <div class="navbarLogo">
        <img src="<?= BASE_URL ?>/images/pawHomeLogo.png" alt="logo pawHome">
      </div>

      <!-- Responsif Navbar -->
      <nav class="navMenu">
        <ul class="nav">
          <li><a href="<?= BASE_URL ?>index.php" class="navLink">Home</a></li>
          <li><a href="<?= BASE_URL ?>services.php" class="navLink">Service</a></li>
          <li><a href="<?= BASE_URL ?>about.php" class="navLink">About</a></li>
          <li><a href="<?= BASE_URL ?>contact.php" class="navLink">Contact</a></li>
          <a href="<?= BASE_URL ?>login.php" class="btnLogin">Login</a>
        </ul>
      </nav>

      <div class="hamburger" id="hamburger">
        <span></span>
        <span></span>
        <span></span>
      </div>
    </header>