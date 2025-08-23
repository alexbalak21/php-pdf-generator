<?php
ob_start(); ?>
<style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
    }

    .header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 20px 40px;
        border-bottom: 2px solid #000;
    }

    .logo {
        height: 75px;
        width: auto;
    }

    .address {
        text-align: right;
        font-size: 12px;
        line-height: 1.4;
    }
</style>

<div class="header">
    <img class="logo" src="/img/logo_underline.png" alt="novocib logo">
    <div class="address">
        <strong>NOVOCIB</strong><br>
        60 Avenue Rockefeller<br>
        69008 Lyon, France<br>
        contact@novocib.com
    </div>
</div>
<?php return ob_get_clean(); ?>