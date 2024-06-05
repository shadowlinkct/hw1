<div class="fixed-button">
    <p>?</p><a>Assistenza</a>
</div>
<nav>
    <div id="flexlogin">
        <div id="loginelemcontainer">
            <div class="group">
                <a>About InVictus</a><img id='downarrowiconsmall' src="../img/down-arrow2.svg" />
                <div class='iconContainer'><img class='myImgClass' src='../img/userGroupIcon.svg'/><a  href="https://www.facebook.com/projectinvictus">Gruppo Facebook</a></div>
            </div>

            <div class="group2">
            <div class='iconContainer'><img class='myImgClass' src='../img/bagShopping.svg'/><a>€0,00 0 prodotti</a></div>
                <?php
                if (isset($_SESSION['id'])) {
                    $query = "SELECT `nome` FROM `account` WHERE id = '" . mysqli_real_escape_string($conn, $_SESSION['id']) . "'";
                
                    $result = mysqli_query($conn, $query);
                
                    if ($result) {
                        $row = mysqli_fetch_array($result);
                        echo "<div class='iconContainer'><img class='myImgClass' src='../img/userIcon.svg'/><a href='paginaUtente.php'>Ciao $row[nome]!</a></div>";
                        echo "<a id='Esci' href='logout.php'>Esci</a>";
                        
                    }
                } else {
                    echo "<div class='iconContainer'><img class='myImgClass' src='../img/userIcon.svg'/><a href='login.php'>Accedi</a></div>";
                }
                
                ?>
            </div>
        </div>
    </div>
    <div class="logonav">
        <div id="logodiv">
            <a href="index.php"><img src="../img/logo.png" alt="Descrizione dell'immagine"></a>
        </div>
        <div class="centerlink">
            <div class="centerlink-item" id="blog"><a>BLOG</a><img src="../img/forward-arrow.png" /></div>
            <div class="centerlink-item" id="libri"><a>LIBRI</a><img src="../img/forward-arrow.png" /></div>
            <div class="centerlink-item" id="rivista"><a>RIVISTA</a><img src="../img/forward-arrow.png" /></div>
            <div class="centerlink-item" id="videocorsi"><a>VIDEOCORSI</a><img src="../img/forward-arrow.png" />
            </div>
            <div class="centerlink-item" id="formazioni"><a>API</a><img src="../img/forward-arrow.png" />
            </div>
            <div class="centerlink-item" id="personal"><a>PERSONAL TRAINER</a><img src="../img/forward-arrow.png" />
            </div>
        </div>

        <div id="iconmenu">
            <p>MENU</p>
            <div id="menu">
                <div></div>
                <div></div>
                <div></div>
            </div>
        </div>
    </div>
    <div id="active" class="hidden">
        <div><a href="../php/exerciseApi.php">ESERCIZI</a></div>
        <div><a href="../php/sportMusic.php">LE NOSTRE PLAYLIST</a></div>
        <div><a href="../php/preferiti.php">PREFERITI</a></div>
        <div><a>VIDEOCORSI</a></div>
        <div><a>FORMAZIONI</a></div>
        <div><a>PERSONAL TRAINER</a></div>
    </div>
    <div class="dropdown-center">
        <div class="dropdown-content hidden" id="blogContent">
            <div class="titledropdown">
                <h3> BLOG </h3>
                <div>
                    <p>Bodybuilding</p>
                    <p>Calisthenics</p>
                    <p>Al Femminile</p>
                    <p>Strength e conditioning</p>
                    <p>Ultimi Articoli</p>
                </div>
            </div>
        </div>
        <div class="dropdown-content hidden" id="libriContent">
            <div class="titledropdown">
                <h3> LIBRI </h3>
                <div>
                    <p>Metodo LEA</p>
                    <p>eBook Cellulite</p>
                    <p>eBook Carboidrati</p>
                </div>
            </div>
        </div>
        <div class="dropdown-content hidden" id="rivistaContent">
            <div class="titledropdown">
                <h3> RIVISTA </h3>
                <div>
                    <p>Metodo LEA</p>
                </div>
            </div>
        </div>
        <div class="dropdown-content hidden" id="videocorsiContent">
            <div class="titledropdown">
                <h3> VIDEOCORSI </h3>
                <div>
                    <p>Metodo LEA</p>
                    <p>Trazioni - Strength Games</p>
                    <p>Panca piana - Strength Games</p>
                    <p>Project Movement</p>
                    <p>Videocorso Calisthenics</p>
                </div>
            </div>
        </div>
        <div class="dropdown-content hidden" id="formazioniContent">
            <div class="titledropdown">
                <h3> API </h3>
                <div>
                    <a href="../php/exerciseApi.php">Esercizi</a>
                    <a href="../php/sportMusic.php">Le nostre playlist</a>
                    <a href="../php/preferiti.php">Preferiti</a>
                </div>
            </div>
        </div>
        <div class="dropdown-content hidden" id="personalContent">
            <div class="titledropdown">
                <h3> PERSONAL TRAINER </h3>
                <div>
                    <p>Albo Certificazioni</p>
                    <p>inVictus Academy</p>
                </div>
            </div>
        </div>
    </div>
</nav>