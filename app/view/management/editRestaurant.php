<?php
include __DIR__ . '/../header.php';
include_once __DIR__ . '/../../model/restaurant.php';
?>

<div class="row">
    <div class="col-md-6">
        <form action="/edit/restaurant " method="post">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-sm-12 ">
                        <h1 class="text-center mb-4">Edit Restaurant</h1>
                        <div class="card bg-light">
                            <div class="card-body">

                                    <div class="row mb-3">
                                        <h2 class="mb-3">Name</h2>
                                        <div class="col-md-12">
                                            <div class="form-floating">
                                                <input required type="text" class="form-control" id="name"
                                                       name="name" placeholder="name" value="<?=$restaurant->name?>">
                                                <label for="name" class="form-label">Name</label>
                                            </div>
                                        </div>
                                        <h2 class="mb-3">Address</h2>
                                        <div class="col-md-12">
                                            <div class="form-floating">
                                                <input required type="text" class="form-control" id="address"
                                                       name="address" placeholder="address" value="<?=$restaurant->address?>">
                                                <label for="address" class="form-label">Address</label>
                                            </div>
                                        </div>
                                        <h2 class="mb-3">Description</h2>
                                        <div class="col-md-12">
                                            <div class="form-floating">
                                                <input required type="text" class="form-control" id="description"
                                                       name="description" placeholder="description" value="<?=$restaurant->description?>">
                                                <label for="description" class="form-label">Description</label>
                                            </div>
                                        </div>
                                        <h2 class="mb-3">Cuisines</h2>
                                        <div class="col-md-12">
                                            <div class="form-floating">
                                                <input required type="text" class="form-control" id="cuisines"
                                                       name="cuisines" placeholder="cuisines" value="<?=$restaurant->cuisines?>">
                                                <label for="cuisines" class="form-label">Cuisines</label>
                                            </div>
                                        </div>
                                        <h2 class="mb-3">Dietary</h2>
                                        <div class="col-md-12">
                                            <div class="form-floating">
                                                <input required type="text" class="form-control" id="dietary"
                                                       name="dietary" placeholder="dietary" value="<?=$restaurant->dietary?>">
                                                <label for="dietary" class="form-label">Dietary</label>
                                            </div>
                                        </div>
                                        <h2 class="mb-3">Photo path</h2>
                                        <div class="col-md-12">
                                            <div class="form-floating">
                                                <input required type="text" class="form-control" id="photoPath"
                                                       name="photo" placeholder="photoPath" value="<?=$restaurant->photo?>">
                                                <label for="photoPath" class="form-label">Photo path</label>
                                            </div>
                                        </div>

                                        <input type="number" hidden name="id" value="<?=$restaurant->id?>">
                                        <button type="submit" class="btn btn-primary" name="editRestaurant">Confirm changes</button>
                                        <a href="/manage/restaurant" class="btn btn-warning">Cancel</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>


</div>
