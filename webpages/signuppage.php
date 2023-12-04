<!DOCTYPE html>
<html>
    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="styles.css">
        <script src="https://apis.google.com/js/platform.js" async defer></script>
        <meta name="google-signin-client_id" content="926122338315-95c1lbkulm3en0ui5icuechntk4eq7jn.apps.googleusercontent.com">
    </head>
    <body>
        <!-- Header -->
        <div class="navbar navbar-expand-lg bg-body-secondary sticky-top">
                <div class="container-fluid">
                <a class="navbar-brand" href="/"><img class="brand-image" src="/uvaball.png"> Pokedex+ </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" 
                        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"> Hi </span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="/">Home</a>
                            </li>
                            <li class="nav-item">
                            <a class="nav-link" href="pokedex">Pokedex</a>
                            </li>
                            <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="create.php" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Create
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="team">Team</a></li>
                                <li><a class="dropdown-item" href="pokemon">Pokemon</a></li>
                            </ul>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="forum">Forum</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        <!-- End Header -->

        <!-- Content -->

        <div class="container d-flex justify-content-center mt-5">
            <form action="/sign-up" method="post" class="form-control" style="width: 75%;" onsubmit="return validateForm()">
                <div class="d-flex row m-4">
                    <label for="email-input" class="form-label"> Email Address </label>
                    <input type="email" class="form-control" id="email-input" name="email" required>
                    <div id="emailHelp" class="form-text">
                        example@email.com
                    </div>
                </div>
                <div class="d-flex row m-4">
                    <label for="username-input" class="form-label"> Username </label>
                    <input type="username" class="form-control" id="username-input" name="username" required>
                </div>
                <div class="d-flex row m-4">
                    <label for="password-input" class="form-label"> Password </label>
                    <input type="password" class="form-control" id="password-input" required>
                </div>
                <div class="d-flex row m-4">
                    <label for="confirm-password" class="form-label"> Verify Password </label>
                    <input type="password" class="form-control" id="confirm-password" required>
                </div>
                <div class="d-flex row m-4">
                    <input type="submit" class="btn btn-primary" value="Sign Up">
                </div>

            </form>
        </div>

        <script>
            function validateForm() {
                var username = document.getElementById("username-input").value;
                var password = document.getElementById("password-input").value;
                var confirmPassword = document.getElementById("confirm-password").value;

                if (password !== confirmPassword) {
                    alert("Passwords do not match");
                    return false;
                }

                // Continue with form submission
                console.log("continue");
                return true;
            }
        </script>
        

        <!-- End Content -->
        
        <!-- Footer -->
        <div class="navbar fixed-bottom bg-body-secondary">
            <div class="container-fluid">
                Footer
            </div>
        </div>
        <!-- End Footer -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    </body>
</html>
