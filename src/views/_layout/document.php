<!doctype html>
<html lang="fr">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" /> 

        <title>E-Event.IO | <?php echo View::getTitle() ?></title>

        <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,700" rel="stylesheet">
        <link rel="preload" href="<?php echo Constants::getPublicPath() ?>/vendor/css/bourbon/font/BigNoodleTooOblique.woff2" as="font" type="font/woff2" crossorigin>

        <link rel="stylesheet" href="<?php echo Constants::getPublicPath() ?>/vendor/css/normalize.css" />

        <link rel="stylesheet" href="<?php echo Constants::getPublicPath() ?>/vendor/css/bourbon/animations.css" />
        <link rel="stylesheet" href="<?php echo Constants::getPublicPath() ?>/vendor/css/bourbon/globals.css" />
        <link rel="stylesheet" href="<?php echo Constants::getPublicPath() ?>/vendor/css/bourbon/alert.css" />

        <?php 
            foreach (View::getStyleSheets() as $stylesheet) : ?>
                <link rel="stylesheet" href="<?php echo Constants::getPublicPath(); ?><?php echo $stylesheet ?>" />
        <?php endforeach ?>
        
        <link rel="stylesheet" href="<?php echo Constants::getPublicPath() ?>/vendor/css/bourbon/headings.css" />
        <link rel="stylesheet" href="<?php echo Constants::getPublicPath() ?>/vendor/css/bourbon/header.css" />
        <link rel="stylesheet" href="<?php echo Constants::getPublicPath() ?>/vendor/css/bourbon/footer.css" />
        <link rel="stylesheet" href="<?php echo Constants::getPublicPath() ?>/vendor/css/bourbon/section.css" />
        <link rel="stylesheet" href="<?php echo Constants::getPublicPath() ?>/vendor/css/bourbon/input.css" />
        <link rel="stylesheet" href="<?php echo Constants::getPublicPath() ?>/vendor/css/bourbon/glass.css" />
        <link rel="stylesheet" href="<?php echo Constants::getPublicPath() ?>/vendor/css/bourbon/alert.css" />

        <?php
            /**
             * TODO:
             * - Gérer l'intégrité et le crossorigin
             */

            foreach (View::getScripts()['head'] ?? array() as $k => $s) : ?>
                <script type="<?php echo $s['type'] ?? 'text/javascript'; ?>" src="<?php echo $s['offline'] ? '' : Constants::getPublicPath(); ?><?php echo $s['path']; ?>"></script>
        <?php endforeach ?>
    </head>
    <body class="bg-gray-less">
        <?php echo $params['body'] ?>
        
        <?php
            /**
             * TODO:
             * - Gérer l'intégrité et le crossorigin
             */

            foreach (View::getScripts()['footer'] ?? array() as $k => $s) : ?>
                <script type="<?php echo $s['type'] ?? 'text/javascript'; ?>" src="<?php echo $s['offline'] ? '' : Constants::getPublicPath(); ?><?php echo $s['path']; ?>"></script>
        <?php endforeach ?>
    </body>
</html>