<!doctype html>
<html lang="fr">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" /> 

        <title>E-Event.IO | <?php echo View::getTitle() ?></title>

        <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,700" rel="stylesheet">

        <link rel="stylesheet" href="<?php echo Constants::getPublicPath() ?>/vendor/css/normalize.css" />

        <link rel="stylesheet" href="<?php echo Constants::getPublicPath() ?>/vendor/css/bourbon/globals.css" />
        <link rel="stylesheet" href="<?php echo Constants::getPublicPath() ?>/vendor/css/bourbon/box.css" />

        <?php foreach (View::getStyleSheets() as $stylesheet) : ?>
            <link rel="stylesheet" href="<?php echo Constants::getPublicPath() ?>/<?php echo $stylesheet ?>" />
        <?php endforeach ?>
        
        <link rel="stylesheet" href="<?php echo Constants::getPublicPath() ?>/vendor/css/bourbon/header.css" />
        <link rel="stylesheet" href="<?php echo Constants::getPublicPath() ?>/vendor/css/bourbon/footer.css" />
        <link rel="stylesheet" href="<?php echo Constants::getPublicPath() ?>/vendor/css/bourbon/section.css" />
        <link rel="stylesheet" href="<?php echo Constants::getPublicPath() ?>/vendor/css/bourbon/input.css" />
        <link rel="stylesheet" href="<?php echo Constants::getPublicPath() ?>/vendor/css/bourbon/glass.css" />
        <link rel="stylesheet" href="<?php echo Constants::getPublicPath() ?>/vendor/css/bourbon/alert.css" />

        <link rel="stylesheet" href="<?php echo Constants::getPublicPath() ?>/assets/css/events.css" />
        <link rel="stylesheet" href="<?php echo Constants::getPublicPath() ?>/assets/css/extrafonts.css" />
    </head>
    <body class="bg-gray-less">
        <?php echo $params['body'] ?>
    </body>

    <?php foreach (View::getScripts() as $script) : ?>
        <script src="<?php echo Constants::getPublicPath() ?>/<?php echo $script ?>"></script>
    <?php endforeach ?>
</html>