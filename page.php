<?php
ob_start(); ?>
<style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
    }

    header {
        position: relative;
    }

    .logo {
        height: 65px;
        width: auto;
    }

    .address {

        position: absolute;
        text-align: center;
        font-size: 12px;
    }

    .title {
        margin-top: 3rem;
        text-align: center;
        font-size: 14px;
    }

    .ref {
        color: #3771C8
    }

    .name {
        font-weight: bold;
        font-size: 1.3rem;
    }

    .client {
        position: absolute;
        right: 0;
        display: inline-block;
        margin-top: 2.2rem;
        border: 1px solid #000;
        margin-left: auto;
        padding-left: 1rem;
        padding-right: 1rem;
    }
</style>

<body>
    <header>
        <img class="logo" src="/img/logo_underline.png" alt="novocib logo">
        <div class="address">
            <strong>NOVOCIB</strong><br>
            Criée Boulogne<br>
            Halle à Marée Quai Jean Voisin<br>
            62200 BOULOGNE-SUR-MER<br>
            Tél : 06 31 44 68 05 / Email : labo@novocib.com<br>
        </div>
        <div class="title">
            <p>
                <span class="title-text"> Rapport d'essais numéro:</span>
                <span class="ref">NOVOCIB 210825-2 DOS KBIO NORDVIK</span>
            </p>
            <p>
                <span class="title-text"> Date d'émission:</span>
                <span class="date">01/01/2022</span>
            </p>
            <p class="name">
                Dos de cabillaud
            </p>
        </div>
        <div class="client">
            <p>
                <strong>SCAPMAREE</strong><br>
                5 rue Marcelin Berthelot <br>
                91320 WISSOUS Cedex <br>
                A l'attention de M. Adrien CAGNA
            </p>

        </div>
    </header>

</body>

<?php return ob_get_clean(); ?>