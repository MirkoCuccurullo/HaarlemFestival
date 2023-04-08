
<?php
include __DIR__ . '/../header.php'; ?>

<form method="post" action="/add/venue" enctype="multipart/form-data">
    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" class="form-control" id="name" name="name" placeholder="Enter name">
    </div>
    <div class="form-group">
        <label for="picture"> Upload Picture</label>
        <input class="form-control" type="file" name="picture" id="picture" accept=".jpg">
    </div>
    <div class="form-group">
        <label for="address">Address</label>
        <input type="text" class="form-control" id="address" name="address" placeholder="Enter address">
    </div>
    <div class="form-group">
        <label for="date">Description</label>
        <input type="text" class="form-control" id="description" name="description" placeholder="Enter description">
    </div>
    <div class="form-group">
        <label for="capacity">Capacity</label>
        <input type="text" class="form-control" id="capacity" name="capacity" placeholder="Enter capacity">
    </div>

    <button type="submit" name="addDanceVenue" class="btn btn-primary">Submit</button>
</form>
<?php
include __DIR__ . '/../footer.php'; ?>
