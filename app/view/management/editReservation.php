<?php
include __DIR__ . '/../header.php';
include_once __DIR__ . '/../../model/reservation.php';
?>

<div class="row">
    <div class="col-md-6">
        <form action="/edit/reservation" method="post">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-sm-12 ">
                        <h1 class="text-center mb-4">Edit session</h1>
                        <div class="card bg-light">
                            <div class="card-body">

                                <div class="row mb-3">
                                    <h2 class="mb-3">Restaurant Name</h2>
                                    <div class="col-md-12">
                                        <div class="form-floating">
                                            <input required type="text" class="form-control" id="restaurantName"
                                                   name="restaurantName" placeholder="restaurantName" value="<?=$reservation->restaurantName?>">
                                            <label for="restaurantName" class="form-label">Start Time</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                <h2 class="mb-3">Session ID</h2>
                                    <div class="col-md">
                                        <div class="form-floating">
                                            <input required type="number" class="form-control" id="sessionId"
                                                   name="sessionId" placeholder="sessionId" value="<?=$reservation->sessionId?>">
                                            <label for="sessionId" class="form-label">Session ID</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                <h2 class="mb-3">Status</h2>
                                    <div class="col-md">
                                        <div class="form-floating">
                                            <input required type="text" class="form-control" id="status"
                                                   name="status" placeholder="status" value="<?=$reservation->status?>">
                                            <label for="status" class="form-label">Reservation status</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                <h2 class="mb-3">Number of adults</h2>
                                    <div class="col-md">
                                        <div class="form-floating">
                                            <input required type="number" class="form-control" id="numberOfAdults"
                                                   name="numberOfAdults" placeholder="numberOfAdults" value="<?=$reservation->numberOfAdults?>">
                                            <label for="numberOfAdults" class="form-label">Number of Adults</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                <h2 class="mb-3">Number of under 12</h2>
                                    <div class="col-md">
                                        <div class="form-floating">
                                            <input required type="number" class="form-control" id="numberOfUnder12"
                                                   name="numberOfUnder12" placeholder="numberOfUnder12" value="<?=$reservation->numberOfUnder12?>">
                                            <label for="numberOfUnder12" class="form-label">Number of under 12</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                <h2 class="mb-3">Reservation price</h2>
                                    <div class="col-md">
                                        <div class="form-floating">
                                            <input required type="number" class="form-control" id="reservationPrice"
                                                   name="reservationPrice" placeholder="reservationPrice" value="<?=$reservation->price?>">
                                            <label for="reservationPrice" class="form-label">Price paid to book </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                <h2 class="mb-3">Customer name</h2>
                                    <div class="col-md-12">
                                        <div class="form-floating">
                                            <input required type="text" class="form-control" id="customerName"
                                                   name="customerName" placeholder="customerName" value="<?=$reservation->customerName?>">
                                            <label for="customerName" class="form-label">Customer Name</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                  <h2 class="mb-3">Customer email</h2>
                                    <div class="col-md-12">
                                        <div class="form-floating">
                                            <input required type="text" class="form-control" id="customerEmail"
                                                   name="customerEmail" placeholder="customerEmail" value="<?=$reservation->customerEmail?>">
                                            <label for="customerEmail" class="form-label">Customer Email</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <h2 class="mb-3">Comment</h2>
                                    <div class="col-md-12">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" id="comment"
                                                   name="comment" placeholder="comment" value="<?=$reservation->comment?>">
                                            <label for="comment" class="form-label">Comment</label>
                                        </div>
                                    </div>
                                </div>

                                <input type="number" hidden name="id" value="<?=$reservation->id?>">
                                <button type="submit" class="btn btn-primary" name="editReservation">Confirm changes</button>
                                <a href="/manage/reservation" class="btn btn-warning">Cancel</a>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <?php
    include __DIR__ . '/../footer.php'; ?>


