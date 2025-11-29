
<?php
require_once "app/config.php";      
include "views/layouts/header.php";
include "views/layouts/navbar.php";
// include "app/db.php"
?>

<section class="heroServiceSection">
    <div class="heroServiceOverlay"></div>
    <div class="heroServiceContent">
        <h1 class="heroServiceTitle">Helping Every Paw<br>Find a Loving Home</h1>
    </div>
</section>


    <section class="pageContainer reveal">
        <h1 class="sectionTitle">OUR SERVICE</h1>
        <div class="servicesGrid">
            <!-- AdoptPaw Card -->
            <div class="serviceCard reveal data-service="adopt">
                <h2 class="cardTitle">AdoptPaw</h2>
                <img src="./images/AdoptPawLogo.png" alt="AdoptPaw Logo" class="adoptLogoCircle">
                <p class="cardDescription">
                    Temukan sahabat berbulu yang cocok dengan karatermu dan siap kamu rawat.
                </p>

                <a href="<?= BASE_URL ?>openPaw.php" class="actionButton">
                    <span style="position: relative; z-index: 1;">Start Open Adopt</span>
                </a>
            </div>

            <!-- OpenPaw Card -->
            <div class="serviceCard reveal" data-service="open">
                <h2 class="cardTitle">OpenPaw</h2>
                
                <img src="./images/OpenPawLogo.png" alt="AdoptPaw Logo" class="adoptLogoCircle">

                <p class="cardDescription">
                    Buka adopsi hewan peliharaanmu untuk menemukan keluarga baru yang menyayanginya.
                </p>

                <a href="<?= BASE_URL ?>openPaw.php" class="actionButton"">
                    <span style="position: relative; z-index: 1;">Find ur Cat Now</span>
                </a>
            </div>
        </div>
</section>

<?php 
include "views/layouts/footer.php";
?>

 