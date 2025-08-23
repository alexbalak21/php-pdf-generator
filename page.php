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
        text-align: center;
        font-size: 12px;
    }

    .title {
        text-align: center;
        margin-top: 10px;
        font-size: 14px;
    }

    .ref {
        color: #3771C8
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
    </header>

</body>

<?php return ob_get_clean(); ?>