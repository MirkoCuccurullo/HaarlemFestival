
<?php
include __DIR__ . '/../header.php'; ?>

<form method="post" action="/add/artist">
    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" class="form-control" id="name" name="name" placeholder="Enter name">
    </div>
    <div class="form-group">
        <label for="picture">Picture Path</label>
        <input type="text" class="form-control" id="picture" name="picture" placeholder="Enter picture path">
    </div>
    <div class="form-group">
        <label for="genre">Genre</label>
        <input type="text" class="form-control" id="genre" name="genre" placeholder="Enter genre">
    </div>
    <div class="form-group">
        <label for="date">Description</label>
        <input type="text" class="form-control" id="description" name="description" placeholder="Enter description">
    </div>

    <button type="submit" name="addDanceArtist" class="btn btn-primary">Submit</button>
</form>
<?php
include __DIR__ . '/../footer.php'; ?>
