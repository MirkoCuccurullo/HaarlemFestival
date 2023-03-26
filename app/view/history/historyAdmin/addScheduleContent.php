<?php include __DIR__ . '/../../header_history.php'; ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link href="/css/addContent.css" rel="stylesheet">
    <title>Schedule CRUD</title>
</head>
<body>


<div class="container">
    <div class="me-auto p-2 bd-highlight" id="header" style="margin-top: 20px; margin-bottom: 20px"><h2>Add Schedule Content</div>
    <form action="/historyManagement" method="POST">
        <div class="mb-3">
            <label for="title" class="form-label">Date and Day</label>
            <input type="text" class="form-control" id="dateAndDay" name="title" placeholder="date and day">
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">Time </label>
            <input type="text" class="form-control" id="title" name="image" placeholder="time">
        </div>
        <div class="mb-3">
            <label for="content" class="form-label">Language</label>
            <input type="text" class="form-control" id="language" name="content" placeholder="language">
        </div>
        <div class="mb-3">
            <label for="content" class="form-label">Ticket Amount</label>
            <input type="text" class="form-control" id="ticketAmount" name="content" placeholder="ticket amount">
        </div>
        <button type="submit" class="btn btn-primary" id="submitSchedule" value="submitSchedule" name="submitSchedule">Add</button>
        <div class="error"> <?php if (isset($addError)){ ?> <span id="error-msg"> <?=$addError?> </span> <?php } ?> </div>
    </form>
</div>
</body>
</html>