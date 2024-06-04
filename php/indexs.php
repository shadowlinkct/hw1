<?php
session_start();
require_once "dbconnection.php";
//echo "". $_SESSION["id"]."<br>"; //DEBUG
?>
<!DOCTYPE html>
<html>

<head>
    <?php
    require_once 'header.php';
    ?>
    <link rel="stylesheet" href="../css/index.css" />
    <link rel="stylesheet" href="../css/persistent.css">
    <script src="../javascript/myApi.js" defer></script>
    <script src="../javascript/index.js" defer></script>
    <title>hw1</title>
</head>

<body>
    <?php
    require_once 'navbar.php';
    ?>
    </header>
    <article>
        <div class="articlecontainer">
            <div class="articlecontainercontent">
                <div id="h1article">
                    <div id="alinktopmarg"><a>Nuovo libro BodyBuilding</a></div>
                    <div>
                        <h1>Scienza e Pratica del Natural Bodybuilding</h1>
                    </div>
                    <div>
                        <p>
                            Il libro più completo sull’ipertrofia, sintesi di tutte le evidenze scientifiche degli
                            ultimi
                            30 anni e dell’esperienza agonistica sul campo, per ottenere il massimo stimolo ipertrofico
                            e
                            scolpire il tuo corpo con successo.
                        </p>
                    </div>
                    <div id="divalink"><a data-primo-volume="Scienza e Pratica del Natural Bodybuilding" data-pubblicazione="2024" data-costo="20.99€" data-secondo-volume="Master inVictus Academy" data-pubblicazione-secondo-volume="2023" data-costo-secondo-volume="15.99€" id="alink2">Scopri i
                            volumi</a></div>
                </div>
                <div id="articleimg">
                    <img src="../img/Scienza-e-pratica-natural-bodybuilding-1.jpg" alt="">
                </div>
            </div>
        </div>
    </article>
    <section class="academy-section">
        <div class="academy-container">
            <div class="academy-item">
                <div class="academy-content">
                    <div class="academy-image">
                        <img src="../img/Master-inVictus-Academy-specializzazioni-3.jpg" alt="">
                    </div>
                    <div class="academy-description"><span>Master inVictus Academy: distinguiti dagli altri Trainer<a class="academy-link"> Scopri</a></span></div>

                </div>
            </div>
            <div class="academy-item">
                <div class="academy-content">
                    <div class="academy-image">
                        <img src="../img/Project-Exercise-Vol-1-2-book2.jpg" alt="">
                    </div>
                    <div class="academy-description"><span>Libri Project inVictus<a class="academy-link"><br>
                                Scopri</a></span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="multisection">
    <div class="multisectioncontainer contenitore-articoli">
            <!-- Gli articoli verranno caricati qui dinamicamente -->
        </div>
        
    </section>
    <article class="slideshow-div">
        <div class="SideshowText">
            <h1>I NOSTRI LIBRI</h1>
            <h3>Solo chi conosce sceglie altrimenti crede di scegliere.</h3>
            <p>Questa è la filosofia alla base di Project inVictus e da questa filosofia nascono i volumi inVictus
                Editions. Utili strumenti a supporto della conoscenza.</p>
            <div>
                <span class="dot" id="dot1"></span>
                <span class="dot" id="dot2"></span>
                <span class="dot" id="dot3"></span>
            </div>
        </div>
        <div class="slideshow-container">
            <div class="mySlides">
                <div class="row">
                    <div data-Titolo="Project Nutrition" data-Costo="10.99€" data-pubblicazione="2015" class="column">
                        <img src="../img/slideshow (1).jpg">
                    </div>
                    <div data-Titolo="Project Exercise" data-Costo="10.99€" data-pubblicazione="2017" class="column">
                        <img src="../img/slideshow (2).jpg">
                    </div>
                    <div data-Titolo="Project Calisthenics" data-Costo="10.99€" data-pubblicazione="2020" class="column">
                        <img src="../img/slideshow (3).jpg">
                    </div>
                    <div data-Titolo="Project Exercise vol. 2" data-Costo="10.99€" data-pubblicazione="2024" class="column">
                        <img src="../img/slideshow (4).jpg">
                    </div>
                </div>
            </div>

            <div class="mySlides">
                <div class="row">
                    <div data-Titolo="Project Exercise vol. 3" data-Costo="10.99€" data-pubblicazione="2021" class="column">
                        <img src="../img/slideshow (5).jpg">
                    </div>
                    <div data-Titolo="Fitness posturale" data-Costo="10.99€" data-pubblicazione="2022" class="column">
                        <img src="../img/slideshow (6).jpg">
                    </div>
                    <div data-Titolo="300 Invictus" data-Costo="10.99€" data-pubblicazione="2023" class="column">
                        <img src="../img/slideshow (7).jpg">
                    </div>
                    <div data-Titolo="Project Bodybuilding" data-Costo="10.99€" data-pubblicazione="2019" class="column">
                        <img src="../img/slideshow (8).jpg">
                    </div>
                </div>
            </div>

            <div class="mySlides">
                <div class="row">
                    <div data-Titolo="Project Cross-Athlete" data-Costo="10.99€" data-pubblicazione="2018" class="column">
                        <img src="../img/slideshow (9).jpg">
                    </div>
                    <div data-Titolo="Project Strenght" data-Costo="10.99€" data-pubblicazione="2012" class="column">
                        <img src="../img/slideshow (10).jpg">
                    </div>
                    <div data-Titolo="Project Exercise vol. 4" data-Costo="10.99€" data-pubblicazione="2023" class="column">
                        <img src="../img/slideshow (2).jpg">
                    </div>
                    <div data-Titolo="Project Calisthenics vol. 2" data-Costo="10.99€" data-pubblicazione="2024" class="column">
                        <img src="../img/slideshow (3).jpg">
                    </div>
                </div>
            </div>
            <a class="prev">❮</a>
            <a class="next">❯</a>
        </div>
        <br>
    </article>
    <?php
    require_once 'footer.php';
    $conn->close();
    ?>
</body>

</html>