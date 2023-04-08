<?php
include __DIR__ . '/../header.php';
include_once __DIR__ . '/../../model/session.php';
?>

<div class="row">
    <div class="col-md-6">
        <form action="/edit/session" method="post">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-sm-12 ">
                        <h1 class="text-center mb-4">Edit session</h1>
                        <div class="card bg-light">
                            <div class="card-body">

                                    <div class="row mb-3">
                                        <h2 class="mb-3">Start Time</h2>
                                        <div class="col-md-12">
                                            <div class="form-floating">
                                                <input required type="time" class="form-control" id="startTime"
                                                       name="startTime" placeholder="startTime" value="<?=$session->startTime?>">
                                                <label for="startTime" class="form-label">Start Time</label>
                                            </div>
                                        </div>
                                    </div>


                                    <h2 class="mb-3">End Time</h2>
                                    <div class="row mb-3">
                                        <div class="col-md">
                                            <div class="form-floating">
                                                <input required type="time" class="form-control" id="endTime"
                                                       name="endTime" placeholder="endTime" value="<?=$session->endTime?>">
                                                <label for="endTime" class="form-label">End Time</label>
                                            </div>
                                        </div>
                                    </div>

                                <h2 class="mb-3">Date</h2>
                                <div class="row mb-3">
                                    <div class="col-md">
                                        <div class="form-floating">
                                            <input required type="date" class="form-control" id="date"
                                                   name="date" placeholder="date" value="<?=$session->date?>">
                                            <label for="date" class="form-label">Date</label>
                                        </div>

                                    <h2 class="mb-3">Capacity</h2>
                                    <div class="row mb-3">
                                        <div class="col-md">
                                            <div class="form-floating">
                                                <input required type="number" class="form-control" id="capacity"
                                                       name="capacity" placeholder="capacity" value="<?=$session->capacity?>">
                                                <label for="capacity" class="form-label">Capacity</label>
                                            </div>
                                        </div>
                                    </div>

                                    <h2 class="mb-3">Reservation Price</h2>
                                    <div class="row mb-3">
                                        <div class="col-md">
                                            <div class="form-floating">
                                                <input required type="number" class="form-control" id="reservationPrice"
                                                       name="reservationPrice" placeholder="reservationPrice" value="<?=$session->reservationPrice?>">
                                                <label for="reservationPrice" class="form-label">Reservation Price</label>
                                            </div>
                                        </div>
                                    </div>

                                    <h2 class="mb-3">Session Price</h2>
                                    <div class="row mb-3">
                                        <div class="col-md">
                                            <div class="form-floating">
                                                <input required type="number" step="0.01" class="form-control" id="sessionPrice"
                                                       name="sessionPrice" placeholder="sessionPrice" value="<?=$session->sessionPrice?>">
                                                <label for="sessionPrice" class="form-label">Session Price</label>
                                            </div>
                                        </div>
                                    </div>

                                        <h2 class="mb-3">Price for Under 12</h2>
                                        <div class="row mb-3">
                                            <div class="col-md">
                                                <div class="form-floating">
                                                    <input required type="number" step="0.01" class="form-control" id="reducedPrice"
                                                           name="reducedPrice" placeholder="reducedPrice" value="<?=$session->reducedPrice?>">
                                                    <label for="reducedPrice" class="form-label">Price for Under 12</label>
                                                </div>
                                            </div>
                                        </div>



                                    <h2 class="mb-3">Restaurant ID</h2>
                                    <div class="row mb-3">
                                        <div class="col-md">
                                            <div class="form-floating">
                                                <input required type="number" class="form-control" id="restaurantId"
                                                       name="restaurantId" placeholder="restaurantId" value="<?=$session->restaurantId?>">
                                                <label for="restaurantId" class="form-label">Restaurant ID</label>
                                            </div>
                                        </div>
                                    </div>

                                    <input type="number" hidden name="id" value="<?=$session->id?>">
                                    <button type="submit" class="btn btn-primary" name="editSession">Confirm changes</button>
                                    <a href="/manage/session" class="btn btn-warning">Cancel</a>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <?php
    include __DIR__ . '/../footer.php'; ?>

