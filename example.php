<?php
ob_start(); ?>
<style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
    }

    .header-table {
        width: 100%;
        border-bottom: 2px solid #000;
        padding: 20px 40px;
        border-collapse: collapse;
    }

    .logo-cell {
        width: 50%;
        vertical-align: middle;
    }

    .address-cell {
        width: 50%;
        text-align: right;
        font-size: 12px;
        line-height: 1.4;
        vertical-align: middle;
    }

    .logo {
        height: 75px;
        width: auto;
    }
</style>

<table class="header-table">
    <tr>
        <td class="logo-cell">
            <img class="logo" src="/img/logo_underline.png" alt="novocib logo">
        </td>
        <td class="address-cell">
            <strong>NOVOCIB</strong><br>
            60 Avenue Rockefeller<br>
            69008 Lyon, France<br>
            contact@novocib.com
        </td>
        <td> </td>
    </tr>
</table>
<?php return ob_get_clean(); ?>