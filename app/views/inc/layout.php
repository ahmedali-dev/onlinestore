<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">



    <!-- fontawesome -->
    <link rel="stylesheet"
        href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">

    <!-- css file -->
    <link rel="stylesheet" href="/assets/style/main.css">


    <title>Document</title>
</head>

<body>
    <?php

    if (isset($_SESSION['userData']))
        if ($_SESSION['userData']->kind == 1) {
    ?>
    <?php
        } else {
    ?>
    <?php
        }
    ?>
    <?= $content ?>
    <!-- js file -->
    <script src="./assets/js/index.js"></script>
</body>

</html>