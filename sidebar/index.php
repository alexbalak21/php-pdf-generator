<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css">
    <link rel="stylesheet" href="style.css">
    <script src="script.js" defer></script>
    <title>Bootstrap Sidebar</title>
</head>

<body>
    <div class="wrapper">
        <aside id="sidebar">
            <div class="d-flex">
                <button class="" type="button" id="toggle-btn"><i class="fa-solid fa-bars"></i></button>
                <div class="sidebar-logo">
                    <a href="#">Sidebar</a>
                </div>
            </div>
            <ul class="sidebar-nav">
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link"><i class=" fa-solid fa-user"></i><span>Profile</span></a>
                </li>
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link"><i class="fa-solid fa-building"></i><span>Company</span></a>
                </li>
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link"><i class="fa-solid fa-file-invoice"></i><span>Reports</span></a>
                </li>
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link"><i class="fa-solid fa-file-invoice-dollar"></i><span>Invoices</span></a>
                </li>
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link" data-bs-toggle="collapse" data-bs-target="#auth" aria-expanded="false" aria-controls="collapseOne"><i class="fa-solid fa-right-to-bracket"></i><span>Auth</span></a>
                    <ul class="sidebar-dropdown list-unstyled collapse" id="auth">
                        <li><a href="#" class="sidebar-link"><span>Login</span></a></li>
                        <li><a href="#" class="sidebar-link"><span>Register</span></a></li>
                    </ul>
                </li>
            </ul>


        </aside>
    </div>


</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>

</html>