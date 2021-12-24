<?php View::setTitle('Page introuvable'); ?>

<main>
    <?php View::show('components/header', $params); ?>

    <?php if (isset($params['alert'])) : ?>
        <div id="alert" class="w-1/2 lead fade-in glass <?php echo $params['alert']['type'] ?? 'yellow'; ?> text-gray-less" style="margin: 2rem auto;">
            <?php echo $params['alert']['message'] ?>
        </div>
    <?php endif; ?>

    <section class="lead">
        <h1 class="slide-in-bottom-h1">Erreur 404</h1>
        <h6 class="text-gray-1 slide-in-bottom-subtitle subtitle">
            <?php echo $params['message'] ?? 'La page que vous recherchez n\'existe pas.'; ?>
        </h6>
    </section>

    <?php View::show('components/footer', array( 'landing' => true )); ?>
</main>