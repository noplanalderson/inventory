<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900">SIMDC</h1>
                                        <h4 class="h5 text-gray-900 mb-4">Sistem Informasi dan Manajemen Data Center</h4>
                                    </div>
                                    <div id="response"></div>
                                    <?= form_open('login/auth', 'id="loginForm" class="user" method="post"'); ?>

                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user" id="username" placeholder="Username" required>
                                            <small id="user_error" class="text-danger"></small>
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user" id="password" placeholder="********" required>
                                            <small id="pass_error" class="text-danger"></small>
                                        </div>
                                        <button type="submit" id="login" class="btn btn-primary btn-user btn-block">
                                            <i class="fas fa-door-open"></i> Login
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>