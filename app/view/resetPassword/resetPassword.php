<?php
include __DIR__ . '/../header.php'; ?>

<form action="#" method="post">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-lg-6 col-sm-12 mx-auto">
                <h1 class="text-center mb-4">Reset your password</h1>
                <div class="card bg-light">
                    <div class="card-body">
                        <form>
                            <div class="row mb-3">
                                <h3 class="mb-3">New password</h3>
                                <div class="col-md-12 mb-3">
                                    <div class="form-floating">
                                        <input required type="password" class="form-control" id="password" name="password" placeholder="Password">
                                        <label for="password" class="form-label">Password</label>
                                    </div>
                                </div>

                                <h3 class="mb-3">Confirm password</h3>
                                <div class="col-md-12 mb-3">
                                    <div class="form-floating">
                                        <input required type="password" class="form-control" id="confirmPassword" name="confirmPassword" placeholder="Password">
                                        <label for="confirmPassword" class="form-label">Confirm password</label>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary" name="confirm">Confirm changes</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

<?php
include __DIR__ . '/../footer.php'; ?>