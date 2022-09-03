<!--Signup Modal -->
<div class="modal fade" id="signupModal" tabindex="-1" aria-labelledby="signupModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="signupModalLabel">Create an Account</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="_handlesignup.php" method="post">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="fname" class="form-label">First Name</label>
                            <input type="text" class="form-control" id="fname" name="fname"
                                aria-describedby="emailHelp">
                        </div>

                        <div class="mb-3">
                            <label for="lname" class="form-label">Last Name</label>
                            <input type="text" class="form-control" id="lname" name="lname"
                                aria-describedby="emailHelp">
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">E-mail</label>
                            <input type="text" class="form-control" id="email" name="email"
                                aria-describedby="emailHelp">
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password">
                        </div>

                        <div class="mb-3">
                            <label for="repassword" class="form-label">Retype Password</label>
                            <input type="password" class="form-control" id="repassword" name="repassword">
                            <div id="emailHelp" class="form-text">Passwords must be same and atleast 8 character long.
                            </div>
                        </div>
                            <p class="text-primary" data-bs-toggle="modal" data-bs-target="#loginModal" style="cursor: pointer; text-decoration:underline; color:primary;">Already have an account? Login Here!</p><br>
                            <button type="submit" class="btn btn-primary my-1">Sign Up</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>