<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>History Navigation Bar</title>
    <link rel="stylesheet" type="text/css" href="../public/css/historyHeader.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>

<nav class="navbar navbar-expand-md navbar-dark mb-4 sticky-top" style="background-color: #BAC127;">
    <div class="container">
        <a class="navbar-brand" href="/" style="color: white">Visit Haarlem</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse"
                aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav me-auto mb-2 mb-md-0">
                <li class="nav-item">
                    <a class="nav-link" href="/manageProfile" style="color: white" <?php if (!isset($_SESSION['current_user']))
                        echo "hidden" ?>>Manage profile</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="/home" style="color: white">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/history" style="color: white">History</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/music" style="color: white">Music</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/kids" style="color: white">Kids</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/culinary" style="color: white">Culinary</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/festival" style="color: white">Festival</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="/logout" style="color: white" <?php if (!isset($_SESSION['current_user']))
                        echo "hidden" ?>>Logout</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="/login" style="color: white" <?php if (isset($_SESSION['current_user']))
                        echo "hidden" ?>>Login</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<div class="container">
