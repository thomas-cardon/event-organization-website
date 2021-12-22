<?php View::setTitle('Evènement #'); ?>

<section class="hero">
    <section class="events">
        <div class="overview glass">
            <header class="flex items-center">
                <h2 class="title">
                    <?php echo $params['event']['title']; ?>
                </h2>
                <h3 class="author text-gray-1">
                    <i>par <?php echo $params['event']['owner']['firstName'] . $params['event']['owner']['lastName']; ?></i>
                </h3>
            </header>

            <div class="body">
                <?php echo $params['event']['description']; ?>
            </div>

            <footer class="flex items-center">
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
                <img class="avatar" src="<?php echo $params['event']['owner']['avatar']; ?>" alt="Avatar de <?php echo $params['event']['owner']['firstName'] . $params['event']['owner']['lastName']; ?>">
                <h1 class="title">
                    <?php echo $params['event']['owner']['firstName'] . ' ' . $params['event']['owner']['lastName']; ?>
                </h1>
                <h3 class="author text-gray-1">
                    <?php echo $params['event']['owner']['email']; ?>
                </h3>
            </header>
        </div>
        <div class="misc glass"></div>
    </section>
</section>