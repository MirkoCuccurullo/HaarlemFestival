
<?php
include __DIR__ . '/../header.php'; ?>
<form>

    <div class="form-group">
        <label for="name">Name of User</label>
        <input type="text" class="form-control" id="name" name="usedBy" placeholder="Enter name">
    </div>
    <div class="form-group">
        <label for="picture">Purpose</label>
        <input type="text" class="form-control" id="picture" name="purpose" placeholder="Enter picture path">
    </div>


    <button type="submit" formmethod="post" formaction="/generateToken" name="addDanceArtist" class="btn btn-primary mt-2">Submit</button>

    <?php if (isset($_SESSION['message'])): ?>
        <div class="alert alert-success mt-2" role="alert">
            <?php echo $_SESSION['message']; ?> <br>
            Token: <?php echo $_SESSION['token']; ?>
        </div>
    <?php endif; ?>

</form>
<?php
include __DIR__ . '/../footer.php'; ?>
