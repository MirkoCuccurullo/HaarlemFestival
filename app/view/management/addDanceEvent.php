<?php
include __DIR__ . '/../header.php'; ?>

<form method="post" action="/add/event">
    <div class="form-group">
        <label for="price">Price</label>
        <input type="text" class="form-control" id="price" name="price" placeholder="Enter price">
    </div>
    <div class="form-group">
        <label for="start_time">Start Time</label>
        <input type="time" class="form-control" id="start_time" name="start_time" placeholder="Enter start time">
    </div>
    <div class="form-group">
        <label for="end_time">End Time</label>
        <input type="time" class="form-control" id="end_time" name="end_time" placeholder="Enter duration">
    </div>
    <div class="form-group">
        <label for="date">Date</label>
        <input type="date" class="form-control" id="date" name="date" placeholder="Enter date">
    </div>

    <div class="form-group">
        <label for="artist">Artist</label>
        <select class="form-control" id="artits" name="artist">
            <?php
            foreach ($artists as $artist){ ?>
            <option value="<?= $artist->id ?>"><?= $artist->name ?></option>
            <?php } ?>
        </select>
    </div>
    <div class="form-group">
        <label for="location">Location</label>
        <select class="form-control" id="location" name="location">
            <?php
            foreach ($locations as $location){?>
                <option value="<?= $location->id ?>"><?= $location->name ?></option>
            <?php } ?>

        </select>
    </div>
    <button type="submit" name="addDanceEvent" class="btn btn-primary">Submit</button>
</form>
<?php
include __DIR__ . '/../footer.php'; ?>
