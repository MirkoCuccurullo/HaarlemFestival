<?php
include __DIR__ . '/../header.php';
include_once __DIR__ . '/../../model/user.php';
?>

<div class="row">
    <div class="col-md-6">
        <form action="/manageProfile/update" method="post">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-sm-12 ">
                        <h1 class="text-center mb-4">Edit your profile</h1>
                        <div class="card bg-light">
                            <div class="card-body">
                                <form>

                                    <div class="row mb-3">
                                        <h2 class="mb-3">Name</h2>
                                        <div class="col-md-12">
                                            <div class="form-floating">
                                                <input required type="text" class="form-control" id="profileName"
                                                       name="profileName" placeholder="John" value="<?=$user->name?>">
                                                <label for="profileName" class="form-label">Name</label>
                                            </div>
                                        </div>
                                    </div>


                                    <h2 class="mb-3">Email</h2>
                                    <div class="row mb-3">
                                        <div class="col-md">
                                            <div class="form-floating">
                                                <input required type="email" class="form-control" id="email"
                                                       name="email" placeholder="Email" value="<?=$user->email?>">
                                                <label for="email" class="form-label">Email</label>
                                            </div>
                                        </div>
                                    </div>

                                    <h2 class="mb-3">Picture placeholder</h2>


                                    <button type="submit" class="btn btn-primary" name="editProfile">Confirm changes</button>
                                    <a href="/home" class="btn btn-warning">Cancel</a>
                                    <button type="submit" class="btn btn-danger float-end" name="delete">Delete
                                        profile
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <div class="col-md-6">
        <form action="/manageProfile/update" method="post">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <h1 class="text-center mb-4">Change your password</h1>
                        <div class="card bg-light">
                            <div class="card-body">
                                <form>

                                    <div class="row mb-3">
                                        <div class="col-md-12">
                                            <div class="form-floating">
                                                <input required type="password" class="form-control" id="currentPassword"
                                                       name="currentPassword" placeholder="Current password">
                                                <label for="currentPassword" class="form-label">Current password</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-md-12">
                                            <div class="form-floating">
                                                <input required type="password" class="form-control" id="newPassword"
                                                       name="newPassword" placeholder="New password">
                                                <label for="newPassword" class="form-label">New password</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-md-12">
                                            <div class="form-floating">
                                                <input required type="password" class="form-control" id="verifyPassword"
                                                       name="verifyPassword" placeholder="Verify Password">
                                                <label for="verifyPassword" class="form-label">Verify password</label>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary" name="editPassword">Confirm changes</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<?php
include __DIR__ . '/../footer.php'; ?>

