<?php
include __DIR__ . '/../header_dance.php';
require_once __DIR__ . '/../../model/artist.php';
?>

<h2 class="mt-2">
    <p>
        <?php echo $artist->name; ?>
    </p>
</h2>

<form action="/festival/dance" method="post">
    <button type="submit" class="btn btn-outline-light my-3">Back</button>
</form>

<div class="row">
    <div class="col-md-6">
        <img src="<?php echo $artist->picture; ?>" alt="artist picture" class="img-fluid">
    </div>
    <div class="col-md-6">
        <p>
            Genre: <?php echo $artist->genre; ?>
        </p> <br>
        <p>
            <?php echo $artist->description; ?>
        </p>
    </div>
</div>


    <?php
    include __DIR__ . '/../footer.php'; ?>

