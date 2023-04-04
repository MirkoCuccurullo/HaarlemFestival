<?php
include __DIR__ . '/../header.php';
include_once __DIR__ . '/../../model/order.php';
?>

<div class="row">
    <div class="col-md-6">
        <form action="/edit/order" method="post">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-sm-12 ">
                        <h1 class="text-center mb-4">Edit Order</h1>
                        <div class="card bg-light">
                            <div class="card-body">

                                <div class="row mb-3">
                                    <h2 class="mb-3">User Id</h2>
                                    <div class="col-md-12">
                                        <div class="form-floating">
                                            <input required type="number" class="form-control" id="user_id"
                                                   name="user_id" placeholder="user_id" value="<?=$order->user_id?>">
                                            <label for="user_id" class="form-label">User Id</label>
                                        </div>
                                    </div>
                                </div>


                                <h2 class="mb-3">Number of Items </h2>
                                <div class="row mb-3">
                                    <div class="col-md">
                                        <div class="form-floating">
                                            <input required type="number" class="form-control" id="no_of_items"
                                                   name="no_of_items" placeholder="no_of_items" value="<?=$order->no_of_items?>">
                                            <label for="no_of_items" class="form-label">Number of Items</label>
                                        </div>
                                    </div>
                                </div>

                                <h2 class="mb-3">Price</h2>
                                <div class="row mb-3">
                                    <div class="col-md">
                                        <div class="form-floating">
                                            <input required type="number" class="form-control" id="total_price"
                                                   name="total_price" placeholder="total_price" value="<?=$order->total_price?>">
                                            <label for="total_price" class="form-label">Price</label>
                                        </div>

                                        <h2 class="mb-3">Status</h2>
                                        <div class="row mb-3">
                                            <div class="col-md">
                                                <div class="form-floating">
                                                    <input required type="text" class="form-control" id="status"
                                                           name="status" placeholder="status" value="<?=$order->status?>">
                                                    <label for="status" class="form-label">Status</label>
                                                </div>
                                            </div>
                                        </div>

                                        <input type="number" hidden name="id" value="<?=$order->id?>">
                                        <button type="submit" class="btn btn-primary" name="editOrder">Confirm changes</button>
                                        <a href="/manage/order" class="btn btn-warning">Cancel</a>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
        </form>
    </div>
    <?php
    include __DIR__ . '/../footer.php'; ?>
