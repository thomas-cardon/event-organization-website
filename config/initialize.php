<?php
/**
 * Pour des raisons de sécurité, ce script
 * doit être exécuté, puis supprimé.
 * Ce fichier vous permettra d'initialiser d'une traite la base de données.
 * PENSEZ à créer les fichiers de configuration de votre projet. (voir fichiers sql.example.php et config.example.php) et à créer une base de donnée 
 */


$p = dirname(__FILE__);
if (file_exists($p . '/config.php')) require_once $p . '/config.php';
else die('Le fichier de configuration n\'existe pas.');

if (file_exists($p . '/sql.php')) require_once $p . '/sql.php';
else die('Le fichier de configuration de la base de données SQL n\'existe pas.');

$sql = [
    'DROP TABLE IF EXISTS `transactions`',
    'DROP TABLE IF EXISTS `users`',
    'DROP TABLE IF EXISTS `campaigns`',
    'DROP TABLE IF EXISTS `events`',
    
    /* A partir d'ici, ce sont des exemples de requêtes générées automatiquement */
    'CREATE TABLE `users` (
        `id` int(11) NOT NULL AUTO_INCREMENT,
        `first_name` varchar(255) NOT NULL,
        `last_name` varchar(255) NOT NULL,
        `password` varchar(255),
        `email` varchar(255) NOT NULL,
        `role` varchar(255) NOT NULL DEFAULT "member",
        `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        `updated_at` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        PRIMARY KEY (`id`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8',

    'CREATE TABLE IF NOT EXISTS `campaigns` (
        `id` int(11) NOT NULL AUTO_INCREMENT,
        `name` varchar(255) NOT NULL,
        `description` text NOT NULL,
        `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        `updated_at` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        PRIMARY KEY (`id`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8',


    'CREATE TABLE IF NOT EXISTS `events` (
        `id` int(11) NOT NULL AUTO_INCREMENT,
        `name` varchar(255) NOT NULL,
        `description` text NOT NULL,
        `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        `updated_at` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        PRIMARY KEY (`id`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8',
        /* Transactions, @author Thomas Cardon */
    'CREATE TABLE `transactions` (
        `id` int(11) NOT NULL AUTO_INCREMENT,
        `user_id` int(11) NOT NULL,
        `event_id` int(11) NOT NULL,
        `amount` int(11) NOT NULL,
        `created_at` datetime NOT NULL,
        PRIMARY KEY (`id`),
        FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE,
        FOREIGN KEY (`event_id`) REFERENCES `events`(`id`) ON DELETE CASCADE
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8'
];

$sql_data = [
    'INSERT INTO `users` (`first_name`, `last_name`, `password`, `email`, `role`) VALUES
        ("admin", "admin", NULL, "test.test@test.fr", "admin");'];

$db = Model::getDatabaseInstance();

echo '<pre>';
echo '<h1>Initialisation de la base de données</h1>';

echo '<h2>Création des tables</h2>';
echo '<ul>';
foreach ($sql as $query) {
    echo '<li>' . $query . '</li>';
    $db->query($query);
}
echo '</ul>';
echo '<h2>Création des données</h2>';
echo '<ul>';
foreach ($sql_data as $query) {
    echo '<li>' . $query . '</li>';
    $db->query($query);
}
echo '</ul>';
echo '<h1>Supprimez ce script</h1>';
echo '<h2>Ce script est maintenant inutile, il à été renommé en .old.php.</h2>';

rename($p . '/initialize.php', $p . '/initialize.old.php');
