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
            <label for="dateAndDay" class="form-label">Date and Day</label>
            <input type="date" class="form-control" id="dateAndDay" name="dateAndDay" placeholder="date and day" >
            <p id="selectedDay"></p>
        </div>
        <div class="mb-3">
            <label for="time" class="form-label">Time </label>
            <label for="timeFormat" id="timeFormat" class="form-label" style="font-size: smaller">(format: 00:00 - 00:00)</label>
            <input type="text" class="form-control" id="time" name="time" placeholder="time" required>
        </div>
        <div class="mb-3">
            <label for="language" class="form-label">Language</label>
            <input type="text" class="form-control" id="language" name="language" placeholder="language" required>
        </div>
        <div class="mb-3">
            <label for="ticketAmount" class="form-label">Ticket Amount</label>
            <input type="number" class="form-control" id="ticketAmount" name="ticketAmount" placeholder="ticket amount" required>
        </div>
        <div class="mb-3">
            <label for="price" class="form-label">Price</label>
            <input type="number" step="0.01" class="form-control" id="price" name="price" placeholder="price" required>
        </div>
        <div class="error"> <?php if (isset($sysError)){ ?> <span id="error-msg"> <?=$sysError?> </span> <?php } ?> </div>
        <button type="submit" class="btn btn-primary" id="submitSchedule" value="submitSchedule" name="submitSchedule" style="margin-top: 20px;">Add</button>
    </form>
</div>
<script>
    const dateInput = document.getElementById("dateAndDay");
    const selectedDay = document.getElementById("selectedDay");

    dateInput.addEventListener("input", function() {
        const date = new Date(this.value);
        const daysOfWeek = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
        selectedDay.textContent = daysOfWeek[date.getDay()];
    });

</script>
</body>
</html>