<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Registration</title>
    <link rel="stylesheet" href="/css/stylesheet.css">
</head>

<body>
<section class="container">
    <header>Registration Form</header>
    <form action="" method="POST" class="form">
        <div class="input-box">
            <label>Name</label>
            <input type="text" name="name" placeholder="Enter name" required />
        </div>

        <div class="input-box">
            <label>Email</label>
            <input type="text" name="email" placeholder="Enter email address" required />
        </div>

        <div class="input-box">
            <label>Password</label>
            <input type="password" name="password" placeholder="Enter password" required />
        </div>

        <div class="input-box">
            <label>Birth Date</label>
            <input type="date" name="date_of_birth" placeholder="Enter birth date" required />
        </div>

        <p>Already have an account? <a href="/login"> Login</a></p>

        <button id="submit" name="submit">Submit</button>
    </form>
</section>
</body>
</html>
