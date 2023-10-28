<!DOCTYPE html>
<html lang="en">
<head>
    <title>Password Generator</title>
    <?php 
        error_reporting(E_ALL);
        ini_set('display_errors', 1);
    ?>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<div class="container">
        <h1>Password Generator</h1>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
        <div>
            <label for="length-input">Password Length:</label>
            <input type="number" id="length-input" name="length" min="8" max="32" value="<?php echo isset($_POST['length']) ? $_POST['length'] : '12'; ?>">
        </div>
        <div>
            <input type="range" id="length-slider" name="length" min="8" max="32" value="<?php echo isset($_POST['length']) ? $_POST['length'] : '12'; ?>">
        </div>

        <div class="options">
            <label for="include-symbols">Include Symbols</label>
            <input type="checkbox" id="include-symbols" checked>
            <label for="include-numbers">Include Numbers</label>
            <input type="checkbox" id="include-numbers" checked>
        </div>
        <button id="generate-button" name="generate">Generate Password</button>
        </form>
        <div id="password-output">
        <?php
            if (isset($_POST['generate'])) {
                $passwordLength = isset($_POST['length']) ? (int)$_POST['length'] : 12;
                //$password = generatePassword($passwordLength);
                echo "Generated Password length: $passwordLength";
                echo "<br><br><a href=savePassword.php>Save generated password?</a>";
            }
        ?>
        </div>
 </div>
    <script>
        //set constants
        const lengthInput = document    .getElementById('length-input');
        const lengthSlider = document.getElementById('length-slider');

        lengthInput.addEventListener('input', () => {
            lengthSlider.value = lengthInput.value;
        });

        lengthSlider.addEventListener('input', () => {
            lengthInput.value = lengthSlider.value;
        });
    </script>

<div class="container">
    <?php
    if (!isset($_COOKIE["user_id"])) {
        echo "<h2>Want to save and send your passwords?<br><br> <a href=signUp.php>Sign up!</a></h2>";
    }
    //else display profile

    ?>
</div>
</body>
</html>

