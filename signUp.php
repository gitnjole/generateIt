<!DOCTYPE html>
<html lang="en">
<head>
    <title>Password Generator</title>
    <?php 
        require_once('dbcons.php');
        function displayError($error) {
            echo "<p class='error'>$error</p>"; 
        }
    ?>
</head>
    <link rel="stylesheet" type="text/css" href="style.css">
<body>
<div class="container">
        <h1>Sign up!</h1>
        <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">
            <label>Enter a username:</label>
            <input type="text" name="username" required placeholder="maximum of 16 characters!"><br><br>

            <label>Enter a password:</label>
            <input type="password" name="password1" required placeholder="maximum of 32 characters!"><br><br>

            <label>Enter password again:</label>
            <input type="password" name="password2" required placeholder="maximum of 32 characters!"><br><br>

            <label>Enter your email:</label><br>
            <input type="email" name="email" required placeholder="must be a valid e-mail address!"><br><br>
            
            <input type="submit" name = "submit" value="Sign me up!">
        </form>
</div>
    <?php
        $error = '';
        
        try {
            $dbconnect = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        } catch (mysqli_sql_exception $e) {
            var_dump($e->getMessage());
        }

        if (isset($_POST['submit'])) {
            echo "<div class='container'>";
            //check for valid user input
            $username = mysqli_real_escape_string($dbconnect, trim($_POST['username']));
            $password1 = mysqli_real_escape_string($dbconnect, trim($_POST['password1']));
            $password2 = mysqli_real_escape_string($dbconnect, trim($_POST['password2']));
            $email = mysqli_real_escape_string($dbconnect, trim($_POST['email']));
            if (($password1 == $password2) && !empty($_POST['password1']) && !empty($_POST['password2'])) {

                //check if username is taken
                try{
                    $query_checkName = mysqli_query($dbconnect, "SELECT username FROM user WHERE username = '$username'");
                } catch (mysqli_sql_exception $e) {
                    var_dump($e->getMessage());
                }

                if ($query_checkName->num_rows == 0) {

                    //input is good, enroll new user
                    try{
                        mysqli_query($dbconnect,"INSERT INTO user (username, password, email) VALUES ('$username', SHA('$password1'), '$email')");
                    } catch (mysqli_sql_exception $e) {
                        var_dump($e->getMessage());
                    }
                    mysqli_close($dbconnect);
                    echo 'Success! Welcome to generateIt! Visit your profile <a href=profile.php>here</a>';

                }
                else {
                    $error = "The username $username is taken, please use another.";
                    displayError($error);
                }
                
            }
            else {
                $error = 'Your passwords did not match, check your input.';
                displayError($error);
            }
        }
        echo "</div>";
    ?>
</body>
</html>
