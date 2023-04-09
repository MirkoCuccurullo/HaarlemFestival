
<?php
include __DIR__ . '/../header.php';
?>

<form method="post" action="/add/session">
    <div class="form-group">
        <label for="startTime">Start Time</label>
        <input type="time" class="form-control" id="startTime" name="startTime" placeholder="Enter start time">
    </div>
    <div class="form-group">
        <label for="endTime">End Time</label>
        <input type="time" class="form-control" id="endTime" name="endTime" placeholder="Enter end time">
    </div>
    <div class="form-group">
        <label for="date">Date</label>
        <input type="date" class="form-control" id="date" name="date" placeholder="Enter date">
    <div class="form-group">
        <label for="capacity">Capacity</label>
        <input type="number" class="form-control" id="capacity" name="capacity" placeholder="Enter capacity">
    </div>
    <div class="form-group">
        <label for="reservationPrice">Reservation Price</label>
        <input type="text" class="form-control" id="reservationPrice" name="reservationPrice" placeholder="Enter reservation price">
    </div>
    <div class="form-group">
        <label for="sessionPrice">Session Price</label>
        <input type="number" class="form-control" id="sessionPrice" name="sessionPrice" placeholder="Enter session price">
    </div>
    <div class="form-group">
        <label for="reducedPrice">Reduced Price</label>
        <input type="number" class="form-control" id="reducedPrice" name="reducedPrice" placeholder="Enter reduced price">
    </div>
    <div class="form-group">
        <label for="restaurantId">Restaurant ID</label>
        <input type="number" class="form-control" id="restaurantId" name="restaurantId" placeholder="Enter restaurant ID">
    </div>
        <br>
        <a href="/manage/session" class="btn btn-warning">Cancel</a>
        <button type="submit" name="addSession" class="btn btn-primary">Submit</button>
</form>

</div>
<?php
include __DIR__ . '/../footer.php'; ?>
