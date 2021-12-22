<?php View::setTitle('Evènement #'); ?>

<section class="hero">
    <section class="events">
        <div class="overview glass">
            <header class="flex items-center">
                <h2>
                    <?php echo $params['event']['title']; ?>
                </h2>
                <h3 class="author text-gray-1">
                    <i>par <?php echo $params['event']['owner']['firstName'] . $params['event']['owner']['lastName']; ?></i>
                </h3>
            </header>

            <div class="body">
                <?php echo $params['event']['description']; ?>
            </div>

            <hr />

            <footer class="text-gray-3">
                <h3 class="date">
                    <?php echo $params['event']['date']; ?>
                </h3>
                <h4 class="time">
                    <?php echo $params['event']['time']; ?>
                </h4>
                <h5 class="location">
                    <?php echo $params['event']['location']; ?>
                </h5>
            </footer>
        </div>
        <div class="user glass">
            <header class="flex items-center">
                <div class="avatar-container">
                    <img class="avatar" onerror="this.src='<?php echo Constants::getPublicPath() . '/vendor/svg/placeholder-bg.svg'; ?>'" src="<?php echo $params['event']['owner']['avatar']; ?>" alt="Avatar de <?php echo $params['event']['owner']['firstName'] . $params['event']['owner']['lastName']; ?>">
                </div>
                <h2>
                    <?php echo $params['event']['owner']['firstName'] . ' ' . $params['event']['owner']['lastName']; ?>
                </h2>
                <h3 class="author text-gray-1">
                    <?php echo $params['event']['owner']['email']; ?>
                </h3>
            </header>
        </div>
        <div class="misc glass">
            <h2>Voir aussi</h2>
            <div class="flex flex-wrap">
                <?php 
                    $params['related'] = array(
                        array(
                            'title' => 'Titre de l\'évènement',
                            'description' => 'Description de l\'évènement',
                            'date' => 'Date de l\'évènement',
                            'time' => 'Heure de l\'évènement',
                            'location' => 'Lieu de l\'évènement',
                            'owner' => array(
                                'firstName' => 'Prénom de l\'auteur',
                                'lastName' => 'Nom de l\'auteur',
                                'avatar' => 'Avatar de l\'auteur',
                                'email' => 'Email de l\'auteur'
                            )
                        ),
                        array(
                            'title' => 'Titre de l\'évènement',
                            'description' => 'Description de l\'évènement',
                            'date' => 'Date de l\'évènement',
                            'time' => 'Heure de l\'évènement',
                            'location' => 'Lieu de l\'évènement',
                            'owner' => array(
                                'firstName' => 'Prénom de l\'auteur',
                                'lastName' => 'Nom de l\'auteur',
                                'avatar' => 'Avatar de l\'auteur',
                                'email' => 'Email de l\'auteur'
                            )
                        ),
                        array(
                            'title' => 'Titre de l\'évènement',
                            'description' => 'Description de l\'évènement',
                            'date' => 'Date de l\'évènement',
                            'time' => 'Heure de l\'évènement',
                            'location' => 'Lieu de l\'évènement',
                            'owner' => array(
                                'firstName' => 'Prénom de l\'auteur',
                                'lastName' => 'Nom de l\'auteur',
                                'avatar' => 'Avatar de l\'auteur',
                                'email' => 'Email de l\'auteur'
                            )
                        )
                    );
                    
                    $params['related'] = array_slice($params['related'], 0, 5); ?>
        </div>
    </section>
</section>