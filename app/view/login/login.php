
<?php
include __DIR__ . '/../header.php'; ?>
<form class="col-md-6 mx-auto">
    <!-- Email input -->
    <div class="form-outline mb-4">
        <input type="email" id="email" name="email" class="form-control"/>
        <label class="form-label" for="email">Email address</label>
    </div>

    <!-- Password input -->
    <div class="form-outline mb-4">
        <input type="password" id="password" name="password" class="form-control col-6"/>
        <label class="form-label" for="password">Password</label>
    </div>

    <!-- 2 column grid layout for inline styling -->
    <div class="row mb-4">
        <div class="col d-flex justify-content-center">
            <!-- Checkbox -->
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="form2Example31" checked/>
                <label class="form-check-label" for="form2Example31"> Remember me </label>
            </div>
        </div>

        <div class="col">
            <!-- Simple link -->
            <a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal">Forgot password?</a>
        </div>
    </div>

    <div class="d-flex justify-content-center">
        <input type="submit" class="btn btn-primary btn-block mb-4" value="Login" formaction="/signin" formmethod="post" style="width: 95px">
    </div>

    <!-- Submit button -->

    <!-- Register buttons -->
    <div class="text-center">
        <p>Not a member? <a href="/register">Register</a></p>
    </div>
</form>

<form method="post" action="/resetPassword/sendLink">
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Enter your email to receive reset link</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="col-md-12 mb-3">
                        <div class="form-floating">
                            <input required type="email" class="form-control" id="resetEmail" name="resetEmail"
                                   placeholder="Email address">
                            <label for="resetEmail" class="form-label">Email address</label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" name="sendResetLink">Send reset link</button>
                </div>
            </div>
        </div>
    </div>
</form>

<?php
include __DIR__ . '/../footer.php'; ?>