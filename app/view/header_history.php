<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visit Haarlem</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<!--    <link rel="stylesheet" href="/css/header_style.css">-->
</head>
<body>

<nav class="navbar navbar-expand-md navbar-dark sticky-top" style="background-color: #BAC127">
    <div class="container">
        <a class="navbar-brand" href="/" style="color: black">Visit Haarlem</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse"
                aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav me-auto mb-2 mb-md-0">

                <li class="nav-item">
                    <a class="nav-link" href="/home" style="color: black">
                        <img class="header-icon" src="../../images/home-icon.svg" alt="Home" style="width: 25px; height: 25px; margin-right: 5px; margin-bottom: 5px;">
                        Home
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="/history" style="color: black">
                        <img class="header-icon" src="../../images/history-icon.svg" alt="Home" style="width: 25px; height: 25px; margin-right: 5px; margin-bottom: 5px;">
                        History
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="/music" style="color: black">
                        <img class="header-icon" src="../../images/music-icon.svg" alt="Home" style="width: 25px; height: 25px; margin-right: 5px; margin-bottom: 5px;">
                        Music
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="/kids" style="color: black">
                        <img class="header-icon" src="../../images/kids-icon.svg" alt="Home" style="width: 25px; height: 25px; margin-right: 5px; margin-bottom: 5px;">
                        Kids
                    </a>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" style="color: black">

                        <img class="header-icon" src="../../images/music-icon.svg" alt="Home" style="width: 25px; height: 25px; margin-right: 5px; margin-bottom: 5px;">
                        Festival
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <a class="dropdown-item" href="/festival/dance">DANCE</a>
                        </li>

                        <li>
                            <a class="dropdown-item" href="/festival/yummy">YUMMY!</a>
                        </li>

                        <li>
                            <a class="dropdown-item" href="/festival/history">A Stroll Through History</a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item dropdown" >
                    <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" style="color: black"> Admin Management </a>
                    <ul class="dropdown-menu">
                        <li>
                            <a class="dropdown-item" href="/manage/users">Users</a>
                        </li>


                        <li> <a class="dropdown-item" href="#"> DANCE &raquo; </a>
                            <ul class="submenu dropdown-menu">
                                <li><a class="dropdown-item" href="/manage/dance/artists">Artists</a></li>
                                <li><a class="dropdown-item" href="/manage/dance/venues">Venues</a></li>
                                <li><a class="dropdown-item" href="/manage/dance/events">Events</a></li>
                            </ul>
                        </li>

                        <li><a class="dropdown-item" href="#"> Yummy! &raquo; </a>
                            <ul class="submenu dropdown-menu">
                                <li><a class="dropdown-item" href="/manage/session">Sessions</a></li>
                                <li><a class="dropdown-item" href="/manage/restaurant">Restaurants</a></li>
                                <li><a class="dropdown-item" href="/manage/reservation">Reservations</a></li>
                            </ul>
                        </li>


                        <li><a class="dropdown-item" href="#"> A Stroll Through History </a>
                        </li>
                    </ul>
                </li>


            </ul>

            <ul class="nav col-md-4 justify-content-end">
                <li class="nav-item">
                    <a class="nav-link" href="/logout" style="color: black" <?php if (!isset($_SESSION['current_user']))
                        echo "hidden" ?>>Logout</a>
                </li>


                <li class="nav-item">
                    <a class="nav-link" href="/login" style="color: black" <?php if (isset($_SESSION['current_user']))
                        echo "hidden" ?>>Login</a>
                </li>
                <li class="nav-item" <?php if (!isset($_SESSION['current_user']))
                    echo "hidden" ?>>
                    <a class="nav-link" href="/manageProfile">
                        <img src="../../images/profile-menu-bar.svg" alt="Profile picture" style="width: 32px; height: 32px">
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/shoppingCart">
                        <img src="../../images/shopping-cart.png" alt="Shopping cart" style="width: 32px; height: 32px">
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container">