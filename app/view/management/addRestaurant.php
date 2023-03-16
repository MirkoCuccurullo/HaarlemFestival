
<?php
include __DIR__ . '/../header.php';
?>

<form method="post" action="/add/restaurant">
    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" class="form-control" id="name" name="name" placeholder="Enter restaurant name">
    </div>
    <div class="form-group">
        <label for="address">Address</label>
        <input type="text" class="form-control" id="address" name="address" placeholder="Enter address">
    </div>
    <div class="form-group">
        <label for="description">Description</label>
        <input type="text" class="form-control" id="description" name="description" placeholder="Enter description">
    </div>
    <div class="form-group">
        <label for="cuisines">Cuisines</label>
        <input type="text" class="form-control" id="cuisines" name="cuisines" placeholder="Enter cuisines">
    </div>
    <div class="form-group">
        <label for="dietary">Dietary</label>
        <input type="text" class="form-control" id="dietary" name="dietary" placeholder="Enter dietary information">
    </div>
    <div class="form-group">
        <label for="photo">Photo Path</label>
        <input type="text" class="form-control" id="photo" name="photo" placeholder="Enter photo path, for multiple paths use comma to separate">
    </div>
    <br>
    <button type="submit" name="addRestaurant" class="btn btn-primary">Submit</button>
</form>
<?php
include __DIR__ . '/../footer.php'; ?>
