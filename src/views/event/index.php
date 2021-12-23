<?php View::addStyleSheet('/assets/css/events.css'); ?>

<main class="page">
    <?php View::show('components/header', $params); ?>

    <?php echo $params['body']; ?>
    <?php View::show('components/footer', array( 'landing' => true )); ?>
</main>