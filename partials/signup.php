<div class="modal fade" id="signupModal" tabindex="-1" aria-labelledby="signupModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="signupModalLabel">SignUp</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="card-body py-5 px-md-5">
                    <div class="row d-flex justify-content-center">
                        <div class="col-lg-8">
                            <form action="partials/handlesignup.php" method="post">
                                <div class="row">
                                    <div class="col-md-6 mb-4">
                                        <div class="form-outline">
                                            <input type="text" id="fname" class="form-control" name="fname" />
                                            <label class="form-label" for="fname">First name</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <div class="form-outline">
                                            <input type="text" id="lname" class="form-control" name="lname" />
                                            <label class="form-label" for="lname">Last name</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-outline mb-4">
                                    <input type="email" id="email" class="form-control" name="u_email" />
                                    <label class="form-label" for="email">Email address</label>
                                </div>
                                <div class="form-outline mb-4">
                                    <input type="password" id="pass" name="u_pass" class="form-control" />
                                    <label class="form-label" for="pass">Password</label>
                                </div>
                                <div class="form-outline mb-4">
                                    <input type="password" id="cpass" name="uc_pass" class="form-control" />
                                    <label class="form-label" for="cpass"> Confirm Password</label>
                                </div>
                                <button type="submit" class="btn btn-primary btn-block mb-4">
                                    Sign up
                                </button>
                                <div class="text-center">
                                    <p>or sign up with:</p>
                                    <button type="button" class="btn btn-link btn-floating mx-1">
                                        <i class="fab fa-facebook-f"></i>
                                    </button>
                                    <button type="button" class="btn btn-link btn-floating mx-1">
                                        <i class="fab fa-google"></i>
                                    </button>
                                    <button type="button" class="btn btn-link btn-floating mx-1">
                                        <i class="fab fa-twitter"></i>
                                    </button>
                                    <button type="button" class="btn btn-link btn-floating mx-1">
                                        <i class="fab fa-github"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>