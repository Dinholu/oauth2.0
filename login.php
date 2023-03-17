<?php
require('config.php')
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Mon site</title>
</head>


<body>
    <h1>Se connecter</h1>

    <p>
        <a href="https://accounts.google.com/o/oauth2/v2/auth?scope=email&access_type=online&redirect_uri=<?= urlencode('http://localhost/googleConnect/connect.php') ?>&response_type=code&client_id=<?= GOOGLE_ID ?>">Se
            connecter via google</a>
    </p>
</body>

</html>