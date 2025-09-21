<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
    <div class="card">
        <div class="card-body">
            <form method="post" action="" class="needs-validation" novalidate>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input id="email" type="email" class="form-control" name="email" required autofocus>
                    <div class="invalid-feedback">Please fill in your email</div>
                </div>

                <div class="form-group">
                    <label for="password" class="control-label">Password</label>
                    <input id="password" type="password" class="form-control" name="password" required>
                    <div class="invalid-feedback">Please fill in your password</div>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-lg btn-block">
                        Sign In
                    </button>
                </div>
            </form>

            <?php
            session_start();
            include "conn.php";

            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['email']) && isset($_POST['password'])) {
                function validate($data) {
                    return htmlspecialchars(stripslashes(trim($data)));
                }

                $email = validate($_POST['email']);
                $password = validate($_POST['password']);

                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    echo "<script>
                        Swal.fire({
                            icon: 'error',
                            title: 'Invalid Email',
                            text: 'Please enter a valid email address.',
                            confirmButtonText: 'OK'
                        }).then(() => {
                            window.location='index.php';
                        });
                    </script>";
                    exit();
                }

                // Secure login process
                $stmt = $conn->prepare("SELECT * FROM admin WHERE email = ?");
                $stmt->bind_param("s", $email);
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result->num_rows === 1) {
                    $row = $result->fetch_assoc();

                    if (password_verify($password, $row['password'])) {
                        $_SESSION['email'] = $row['email'];
                        $_SESSION['a_id'] = $row['a_id'];

                        echo "<script>
                            Swal.fire({
                                icon: 'success',
                                title: 'Login Successful',
                                text: 'Welcome to Credentials Verification Sibugay Technical Institute Inc. Admin',
                                confirmButtonText: 'OK'
                            }).then(() => {
                                window.location='dashboard.php';
                            });
                        </script>";
                    } else {
                        echo "<script>
                            Swal.fire({
                                icon: 'error',
                                title: 'Login Failed',
                                text: 'Incorrect Username or Password!',
                                confirmButtonText: 'Try Again'
                            }).then(() => {
                                window.location='index.php';
                            });
                        </script>";
                    }
                } else {
                    echo "<script>
                        Swal.fire({
                            icon: 'error',
                            title: 'Login Failed',
                            text: 'Incorrect Username or Password!',
                            confirmButtonText: 'Try Again'
                        }).then(() => {
                            window.location='index.php';
                        });
                    </script>";
                }

                $stmt->close();
                $conn->close();
            }
            ?>
        </div>
    </div>
</div>

<!-- Bootstrap & JavaScript Validation -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
<script>
    // Bootstrap form validation
    (function () {
        'use strict';
        window.addEventListener('load', function () {
            var forms = document.getElementsByClassName('needs-validation');
            Array.prototype.filter.call(forms, function (form) {
                form.addEventListener('submit', function (event) {
                    if (form.checkValidity() === false) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        }, false);
    })();
</script>

</body>
</html>
