<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visit Haarlem</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>

<nav class="navbar navbar-expand-md navbar-dark mb-4 sticky-top" style="background-color: #9DE2BD">
    <div class="container">
        <a class="navbar-brand" href="/" style="color: black">Visit Haarlem</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse"
                aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav me-auto mb-2 mb-md-0">
                <li class="nav-item">
                    <a class="nav-link" href="/manageProfile" style="color: black" <?php if (!isset($_SESSION['current_user']))
                        echo "hidden" ?>>Manage profile</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="/manage/users" style="color: black">Manage users</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="/logout" style="color: black" <?php if (!isset($_SESSION['current_user']))
                        echo "hidden" ?>>Logout</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="/login" style="color: black" <?php if (isset($_SESSION['current_user']))
                        echo "hidden" ?>>Login</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="/manage/session" style="color: white" <?php if (isset($_SESSION['current_user']))
                        echo "hidden" ?>>Manage Sessions</a>

                <li class="nav-item">
                    <a class="nav-link" href="/shoppingCart">
                        <img src="shopping-cart.png" alt="Shopping cart" style="width: 32px; height: 32px">
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="/yummy" style="">Yummy </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<div class="container">