
<?php
include __DIR__ . '/../header.php'; ?>
<form enctype="multipart/form-data">

    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" class="form-control" id="name" name="name" placeholder="Enter name">
    </div>
    <div class="form-group">
        <label for="genre">Genre</label>
        <input type="text" class="form-control" id="genre" name="genre" placeholder="Enter genre">
    </div>
    <div class="form-group">
        <label for="date">Description</label>
        <input type="text" class="form-control" id="description" name="description" placeholder="Enter description">
    </div>
    <div class="form-group">
        <label for="spotify">Spotify Link</label>
        <input type="text" class="form-control" id="spotify" name="spotify" placeholder="Enter spotify link to the artist">
    </div>
    <div class="form-group">
        <label for="picture"> Upload Picture</label>
        <input class="form-control" type="file" name="picture" id="picture" accept=".jpg">
    </div>

    <button type="submit" formmethod="post" formaction="/add/artist" name="addDanceArtist" class="btn btn-primary my-2">Submit</button>
</form>
<?php
include __DIR__ . '/../footer.php'; ?>
