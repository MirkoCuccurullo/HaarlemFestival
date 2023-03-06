<?php
include __DIR__ . '/../header.php';
include_once __DIR__ . '/../../model/venues.php';
?>

<div class="row">
    <div class="col-md-6">
        <form action="/edit/venue" method="post">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-sm-12 ">
                        <h1 class="text-center mb-4">Edit venue</h1>
                        <div class="card bg-light">
                            <div class="card-body">
                                <form>

                                    <div class="row mb-3">
                                        <h2 class="mb-3">Name</h2>
                                        <div class="col-md-12">
                                            <div class="form-floating">
                                                <input required type="text" class="form-control" id="name"
                                                       name="name" placeholder="Name" value="<?=$venue->name?>">
                                                <label for="name" class="form-label">Name</label>
                                            </div>
                                        </div>
                                    </div>


                                    <h2 class="mb-3">Address</h2>
                                    <div class="row mb-3">
                                        <div class="col-md">
                                            <div class="form-floating">
                                                <input required type="text" class="form-control" id="address"
                                                       name="address" placeholder="address" value="<?=$venue->address?>">
                                                <label for="address" class="form-label">Address</label>
                                            </div>
                                        </div>
                                    </div>

                                    <h2 class="mb-3">Picture Path</h2>
                                    <div class="row mb-3">
                                        <div class="col-md">
                                            <div class="form-floating">
                                                <input required type="text" class="form-control" id="picture"
                                                       name="picture" placeholder="picture" value="<?=$venue->picture?>">
                                                <label for="picture" class="form-label">Picture</label>
                                            </div>
                                        </div>
                                    </div>
                                    <h2 class="mb-3">Description</h2>
                                    <div class="row mb-3">
                                        <div class="col-md">
                                            <div class="form-floating">
                                                <input required type="text" class="form-control" id="descirption"
                                                       name="description" placeholder="description" value="<?=$venue->description?>">
                                                <label for="description" class="form-label">Picture</label>
                                            </div>
                                        </div>
                                    </div>
                                    <h2 class="mb-3">Capacity</h2>
                                    <div class="row mb-3">
                                        <div class="col-md">
                                            <div class="form-floating">
                                                <input required type="text" class="form-control" id="capacity"
                                                       name="capacity" placeholder="capacity" value="<?=$venue->capacity?>">
                                                <label for="capacity" class="form-label">Capacity</label>
                                            </div>
                                        </div>
                                    </div>

                                    <input type="text" hidden name="id" value="<?=$venue->id?>">
                                    <button type="submit" class="btn btn-primary" name="editArtist">Confirm changes</button>
                                    <a href="/manage/dance/venues" class="btn btn-warning">Cancel</a>
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

