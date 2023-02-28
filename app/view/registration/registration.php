<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Registration</title>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <link rel="stylesheet" href="/css/registration.css">
</head>

<body>
<section class="container">
    <header>Registration Form</header>
    <form action="/register" method="POST" class="form" id="registrationForm" name="registrationForm">
        <div class="success"> <?php if (isset($successMessage)){ ?> <span id="registerSuccess"style="color: limegreen"> <?=$successMessage?> </span> <?php } ?> </div>
        <div class="input-box">
            <label>Name</label>
            <input type="text" id="name" name="name" placeholder="Enter your name" required/><br /><br />
            <div class="error"> <?php if (isset($invalidChar)){ ?> <span id="error-msg"> <?=$invalidChar?> </span> <?php } ?> </div>
        </div>

        <div class="input-box">
            <label>Email</label>
            <input type="email" id="email" name="email" placeholder="Enter your email" required/><br /><br />
            <div class="error"> <?php if (isset($emailError)){ ?> <span id="error-msg" > <?=$emailError?> </span> <?php } ?> </div>
        </div>

        <div class="input-box">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" placeholder="Enter your password" required/><br />
        </div>
        <br />
        <div class="input-box">
            <label for="date_of_birth">Birth Date</label>
            <input type="date" id="date_of_birth" name="date_of_birth" placeholder="Enter date of birth" required/><br /><br />
            <div class="error"> <?php if (isset($dateInPast)){ ?> <span id="error-msg"> <?=$dateInPast?> </span> <?php } ?> </div><br />
        </div>

        <p>Already have an account? <a href="/login"> Login</a></p>
        <br />
        <div class="g-recaptcha" data-sitekey="6Lf1GqQkAAAAADa0inLw28QN3DXrXLsSN4g5kojc"></div> <br />
        <div class="success"> <?php if (isset($captchaMessage)){ ?> <span style="color: red"> <?=$captchaMessage?> </span> <?php } ?> </div>
        <button type="submit" id="submit" value="submit" name="submit">Submit</button><br /><br />
    </form>
</section>
</body>
</html>
