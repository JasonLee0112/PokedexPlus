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

        <script>
        function onSignIn(googleUser) {
            // Handle the Google user object here
            var profile = googleUser.getBasicProfile();
            console.log('ID: ' + profile.getId()); // Do not send to your backend! Use an ID token instead.
            console.log('Name: ' + profile.getName());
            console.log('Image URL: ' + profile.getImageUrl());
            console.log('Email: ' + profile.getEmail()); // This is null if the 'email' scope is not present.
        }
        

        function signUp() {
            // var auth2 = gapi.auth2.getAuthInstance();
            // auth2.signOut().then(function () {
            // console.log('User signed out.');
            // });
            var url = 'http://localhost:3000/sign-up';
            
            // Redirect to the specified URL
            window.location.href = url;
        }
        function signIn() {
            // var auth2 = gapi.auth2.getAuthInstance();
            // auth2.signOut().then(function () {
            // console.log('User signed out.');
            // });
            var url = 'http://localhost:3000/sign-in';
            
            // Redirect to the specified URL
            window.location.href = url;
        }


        </script>
        <div class="g-signin2" data-onsuccess="onSignIn"></div>
        <button onclick="signOut()">Sign out</button>

        <button onclick="signUp()"> Sign Up</button>
        <button onclick="signIn()"> Sign In</button>

      

        

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
