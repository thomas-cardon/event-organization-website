<?php 
    View::setTitle('Evènement #');
?>

<section class="hero">
    <section class="events">
        <div class="overview glass slide-in-bottom">
            <header class="flex items-center">
                <h2>
                    <?php echo $params['event']['title']; ?>
                </h2>
                <h3 class="author text-gray-1">
                    <i>par <?php echo $params['event']['owner']['firstName'] . $params['event']['owner']['lastName']; ?></i>
                </h3>
            </header>

            <div class="description">
                <?php echo $params['event']['description']; ?>
            </div>

            <hr />
            <h2 class="sm" style="margin-left: 2rem; margin-bottom: 2rem;">Contenu débloquable</h2>
            <div class="unlockable-content-container">
                <?php if ($params['event']['unlockableContent'] ?? null) {
                    foreach ($params['event']['unlockableContent'] as $content) { ?>
                        <div class="glass gold unlockable-content locked" <?php if (isset($content['image'])) { ?>style="background-image: url(<?php echo $content['image']; ?>);color: <?php echo $content['textColor'] ?? 'white'; ?>"<?php } ?>>
                            <h3>
                                <?php echo $content['title']; ?>
                            </h3>
                            <p class="desc">
                                <?php echo $content['description']; ?>
                            </p>
                            
                            <?php if ($content['pointsRequired'] > $params['event']['points']): ?>
                                <svg fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"></path></svg>
                                <span><?php echo $params['event']['points']; ?>/<?php echo $content['pointsRequired']; ?></span>
                            <?php else: ?>
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M10 2a5 5 0 00-5 5v2a2 2 0 00-2 2v5a2 2 0 002 2h10a2 2 0 002-2v-5a2 2 0 00-2-2H7V7a3 3 0 015.905-.75 1 1 0 001.937-.5A5.002 5.002 0 0010 2z"></path></svg>
                                <span>Contenu débloqué !</span>
                            <?php endif; ?>
                        </div>
                    <?php }
                } else { ?>
                    <h3 class="text-gray-1">
                        <i>
                            Aucun objet à débloquer
                        </i>
                    </h3>
                <?php } ?>
            </div>

            <hr />

            <footer class="text-gray-3">
                <h3 class="date meta">
                    Du <?php echo date('j/m à H:i', strtotime($params['event']['from'])); ?>
                    au <?php echo date('j/m à H:i', strtotime($params['event']['to'])); ?>
                </h3>
                <h4 class="points meta">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path d="M8.433 7.418c.155-.103.346-.196.567-.267v1.698a2.305 2.305 0 01-.567-.267C8.07 8.34 8 8.114 8 8c0-.114.07-.34.433-.582zM11 12.849v-1.698c.22.071.412.164.567.267.364.243.433.468.433.582 0 .114-.07.34-.433.582a2.305 2.305 0 01-.567.267z"></path><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-13a1 1 0 10-2 0v.092a4.535 4.535 0 00-1.676.662C6.602 6.234 6 7.009 6 8c0 .99.602 1.765 1.324 2.246.48.32 1.054.545 1.676.662v1.941c-.391-.127-.68-.317-.843-.504a1 1 0 10-1.51 1.31c.562.649 1.413 1.076 2.353 1.253V15a1 1 0 102 0v-.092a4.535 4.535 0 001.676-.662C13.398 13.766 14 12.991 14 12c0-.99-.602-1.765-1.324-2.246A4.535 4.535 0 0011 9.092V7.151c.391.127.68.317.843.504a1 1 0 101.511-1.31c-.563-.649-1.413-1.076-2.354-1.253V5z" clip-rule="evenodd">
                        </path>
                    </svg>
                    <?php echo $params['event']['points']; ?>
                </h4>
            </footer>
        </div>
        <aside>
            <div class="user glass slide-in-bottom">
                <header class="flex items-center">
                    <div class="avatar-container">
                        <img class="avatar" onerror="this.src='<?php echo Constants::getPublicPath() . '/vendor/svg/placeholder-bg.svg'; ?>'" src="<?php echo $params['event']['owner']['avatar']; ?>" alt="Avatar de <?php echo $params['event']['owner']['firstName'] . $params['event']['owner']['lastName']; ?>">
                    </div>
                    <h2 class="slide-in-bottom-h1">
                        <?php echo $params['event']['owner']['firstName'] . ' ' . $params['event']['owner']['lastName']; ?>
                    </h2>
                    <h3 class="author text-gray-1 slide-in-bottom-subtitle">
                        <?php echo $params['event']['owner']['email']; ?>
                    </h3>
                </header>
            </div>
            <div class="donations glass slide-in-bottom">
                <a id="donationSorting" onclick="sort(this)" href="javascript:void(0);">
                    <h2>
                        Dons&nbsp;
                        <span id="donationState" style="font-family: 'BigNoodleTitling'; ">↓</span
                    ></h2>
                </a>
                <table>
                    <thead>
                        <tr>
                            <th scope="col">Nom</th>
                            <th scope="col">Date</th>
                            <th scope="col">Montant</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($params['donations'] as $donation): ?>
                            <tr>
                                <td>
                                    <?php echo $donation['user']['firstName'] . ' ' . $donation['user']['firstName']; ?>
                                </td>
                                <td>
                                    <?php echo date('d/m à H:i', strtotime($donation['created_at'])); ?>
                                </td>
                                <td>
                                    <svg fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M8.433 7.418c.155-.103.346-.196.567-.267v1.698a2.305 2.305 0 01-.567-.267C8.07 8.34 8 8.114 8 8c0-.114.07-.34.433-.582zM11 12.849v-1.698c.22.071.412.164.567.267.364.243.433.468.433.582 0 .114-.07.34-.433.582a2.305 2.305 0 01-.567.267z"></path><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-13a1 1 0 10-2 0v.092a4.535 4.535 0 00-1.676.662C6.602 6.234 6 7.009 6 8c0 .99.602 1.765 1.324 2.246.48.32 1.054.545 1.676.662v1.941c-.391-.127-.68-.317-.843-.504a1 1 0 10-1.51 1.31c.562.649 1.413 1.076 2.353 1.253V15a1 1 0 102 0v-.092a4.535 4.535 0 001.676-.662C13.398 13.766 14 12.991 14 12c0-.99-.602-1.765-1.324-2.246A4.535 4.535 0 0011 9.092V7.151c.391.127.68.317.843.504a1 1 0 101.511-1.31c-.563-.649-1.413-1.076-2.354-1.253V5z" clip-rule="evenodd">
                                        </path>
                                    </svg>
                                    <?php echo $donation['amount']; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </aside>
    </section>
</section>