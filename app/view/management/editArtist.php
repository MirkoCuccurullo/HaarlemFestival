<?php
include __DIR__ . '/../header.php';
include_once __DIR__ . '/../../model/artist.php';
?>

<div class="row">
    <div class="col-md-6">
        <form action="/edit/artist" method="post" enctype="multipart/form-data">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-sm-12 ">
                        <h1 class="text-center mb-4">Edit artist</h1>
                        <div class="card bg-light">
                            <div class="card-body">

                                    <div class="row mb-3">
                                        <h2 class="mb-3">Name</h2>
                                        <div class="col-md-12">
                                            <div class="form-floating">
                                                <input required type="text" class="form-control" id="name"
                                                       name="name" placeholder="Name" value="<?=$artist->name?>">
                                                <label for="name" class="form-label">Name</label>
                                            </div>
                                        </div>
                                    </div>


                                    <h2 class="mb-3">Genre</h2>
                                    <div class="row mb-3">
                                        <div class="col-md">
                                            <div class="form-floating">
                                                <input required type="text" class="form-control" id="genre"
                                                       name="genre" placeholder="genre" value="<?=$artist->genre?>">
                                                <label for="genre" class="form-label">Genre</label>
                                            </div>
                                        </div>
                                    </div>

                                    <h2 class="mb-3">Picture Path</h2>
                                    <div class="row mb-3">
                                        <div class="col-md">
                                            <div class="form-floating">
                                                <label for="picture" class="form-label">Picture</label>
                                                <input type="text" value="<?= $artist->picture ?>" hidden name="old_pic_path">
                                                <input required type="file" class="form-control" id="picture"
                                                       name="picture" accept=".jpg">
                                            </div>
                                        </div>
                                    </div>
                                    <h2 class="mb-3">Description</h2>
                                    <div class="row mb-3">
                                        <div class="col-md">
                                            <div class="form-floating">
                                                <input required type="text" class="form-control" id="descirption"
                                                       name="description" placeholder="description" value="<?=$artist->description?>">
                                                <label for="description" class="form-label">Picture</label>
                                            </div>
                                        </div>
                                    </div>

                                    <input type="text" hidden name="id" value="<?=$artist->id?>">
                                    <button type="submit" class="btn btn-primary" name="editArtist">Confirm changes</button>
                                    <a href="/manage/dance/artists" class="btn btn-warning">Cancel</a>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

    </div>
<?php
include __DIR__ . '/../footer.php'; ?>

