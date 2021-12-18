<!doctype html>
<html lang="fr">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>E-Event.IO | <?php echo View::$title ?></title>

        <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,700" rel="stylesheet">

        <link rel="stylesheet" href="<?php echo Constants::getPublicPath() ?>/vendor/css/normalize.css" />
        <link rel="stylesheet" href="<?php echo Constants::getPublicPath() ?>/vendor/css/bourbon/globals.css" />

        <link rel="stylesheet" href="<?php echo Constants::getPublicPath() ?>/vendor/css/bourbon/header.css" />
        <link rel="stylesheet" href="<?php echo Constants::getPublicPath() ?>/vendor/css/bourbon/footer.css" />
        <link rel="stylesheet" href="<?php echo Constants::getPublicPath() ?>/vendor/css/bourbon/main.css" />
        <link rel="stylesheet" href="<?php echo Constants::getPublicPath() ?>/vendor/css/bourbon/section.css" />
        <link rel="stylesheet" href="<?php echo Constants::getPublicPath() ?>/vendor/css/bourbon/input.css" />

        <link rel="stylesheet" href="<?php echo Constants::getPublicPath() ?>/assets/css/events.css" />
        <link rel="stylesheet" href="<?php echo Constants::getPublicPath() ?>/assets/css/extrafonts.css" />
    </head>
    <body class="bg-gray-less">
        <?php echo $params['body'] ?>
    </body>
</html>