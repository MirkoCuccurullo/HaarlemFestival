<?php
include __DIR__ . '/../header.php';
include_once __DIR__ . '/../../model/dance.php';
?>

<div class="row">
    <div class="col-md-6">
        <form action="/edit/event" method="post">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-sm-12 ">
                        <h1 class="text-center mb-4">Edit event</h1>
                        <div class="card bg-light">
                            <div class="card-body">
                                <form>
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


                                    <h2 class="mb-3">Price</h2>
                                    <div class="row mb-3">
                                        <div class="col-md">
                                            <div class="form-floating">
                                                <input required type="text" class="form-control" id="price"
                                                       name="price" placeholder="price" value="<?=$event->price?>">
                                                <label for="price" class="form-label">Price</label>
                                            </div>
                                        </div>
                                    </div>

                                    <h2 class="mb-3">Start Time</h2>
                                    <div class="row mb-3">
                                        <div class="col-md">
                                            <div class="form-floating">
                                                <input required type="time" class="form-control" id="start_time"
                                                       name="start_time" placeholder="start_time" value="<?=$event->start_time?>">
                                                <label for="start_time" class="form-label">Start Time</label>
                                            </div>
                                        </div>
                                    </div>
                                    <h2 class="mb-3">End Time</h2>
                                    <div class="row mb-3">
                                        <div class="col-md">
                                            <div class="form-floating">
                                                <input required type="time" class="form-control" id="end_time"
                                                       name="end_time" placeholder="end_time" value="<?=$event->end_time?>">
                                                <label for="end_time" class="form-label">End Time</label>
                                            </div>
                                        </div>
                                    </div>
                                    <h2 class="mb-3">Date</h2>
                                    <div class="row mb-3">
                                        <div class="col-md">
                                            <div class="form-floating">
                                                <input required type="date" class="form-control" id="date"
                                                       name="date" placeholder="date" value="<?=$event->date?>">
                                                <label for="date" class="form-label">Date</label>
                                            </div>
                                        </div>
                                    </div>

                                    <input type="text" hidden name="id" value="<?=$event->id?>">
                                    <button type="submit" class="btn btn-primary" name="editArtist">Confirm changes</button>
                                    <a href="/manage/dance/events" class="btn btn-warning">Cancel</a>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <?php
    include __DIR__ . '/../footer.php'; ?>


