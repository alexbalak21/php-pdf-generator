<?php
ob_start(); ?>
<style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
    }

    header {
        display: flex;

    }

    .logo {
        height: 75px;
        width: auto;
        border: 1px solid blue;
        ;

    }

    .address {
        text-align: center;
        font-size: 12px;
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
    </header>

</body>

<?php return ob_get_clean(); ?>