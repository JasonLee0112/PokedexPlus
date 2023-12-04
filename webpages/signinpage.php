<!DOCTYPE html>
<html>
    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="styles.css">
        <script src="https://apis.google.com/js/platform.js" async defer></script>
        <meta name="google-signin-client_id" content="926122338315-95c1lbkulm3en0ui5icuechntk4eq7jn.apps.googleusercontent.com">
    </head>
    <body>
        <?php
        include('header.php');
        ?>

        <!-- Content -->
        
        <div class="container d-flex justify-content-center mt-5">
            
            <form action="/authenticate" method="post" class="form-control" style="width: 75%;">
                <div class="d-flex row m-4">
                    <h1>  Sign In</h1>
                </div>
                
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
                    <input type="password" class="form-control" id="password-input" name="password" required>
                </div>

                <div class="d-flex row m-4">
                    <input type="submit" class="btn btn-primary" value="Sign In">
                </div>

            </form>
        </div>
        

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
