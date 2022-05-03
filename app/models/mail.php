<?php
include "model.php";
$model = new model;

// $model->sendEmail([
//     'email' => 'mohamedali850100@gmail.com',
//     'name' => 'mohamedali',
//     'subject' => 'active your account',
//     'body' => '<a href=\'google.com\'>active</a>'
// ]);


$body = <<< EOF

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>onlinestore</title>

    <style>
    * {
        padding: 0;
        margin: 0;
        box-sizing: border-box;
    }

    body {
        display: flex;
        flex-flow: column;
        align-items: center;
        justify-content: center;
        gap: 2rem;
    }

    a {
        display: inline-block;
        padding: 1rem 5rem;
        text-decoration: none;
        border-radius: .5rem;
        background: lightblue;
        color: #333;
        text-transform: capitalize;
        font-family: sans-serif;
    }
    </style>

</head>

<body>

    <h1>Hi Dr ahmedali</h1>
    <p>Thanks for signing up with Heroku!</p>
    <a href="http://localhost:5511/account/accept/{id}">active</a>
</body>

</html>

EOF;

// $model->sendEmail([
//     'email' => 'mohamedali850100@gmail.com',
//     'name' => 'mohamedali',
//     'subject' => 'active your account',
//     'body' => $body
// ]);

$model->getPath("", "/about/home/{id}");


// echo $body;
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>onlinestore</title>

    <style>
    * {
        padding: 0;
        margin: 0;
        box-sizing: border-box;
    }

    body {
        display: flex;
        flex-flow: column;
        align-items: center;
        justify-content: center;
        gap: 2rem;
    }

    a {
        display: inline-block;
        padding: 1rem 5rem;
        text-decoration: none;
        border-radius: .5rem;
        background: lightblue;
        color: #333;
        text-transform: capitalize;
        font-family: sans-serif;
    }
    </style>

</head>

<body>

    <h1>Hi Dr ahmedali</h1>
    <p>Thanks for signing up with Heroku!</p>
    <a href="http://localhost/account/accept/{id}">active</a>
</body>

</html>