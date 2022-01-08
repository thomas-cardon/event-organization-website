<!doctype html>
<html lang="fr">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" /> 

        <title>E-Event.IO | <?php echo View::getTitle() ?></title>

        <link rel="icon" type="image/svg+xml" href="data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 width=%22256%22 height=%22256%22 viewBox=%220 0 100 100%22><rect width=%22100%22 height=%22100%22 rx=%2220%22 fill=%22%23000000%22></rect><text x=%2250%%22 y=%2250%%22 dominant-baseline=%22central%22 text-anchor=%22middle%22 font-size=%2282%22>🎫</text></svg>" />
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