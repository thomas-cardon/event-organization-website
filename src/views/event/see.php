<?php 
    View::setTitle('Evènement #');
    $author = $params['event']->getAuthor();
?>

<section class="hero">
    <section class="events wrapper">
        <div class="overview glass slide-in-bottom">
            <header class="flex items-center">
                <h2 class="font-hero">
                    <?= $params['event']->getName(); ?>
                </h2>
                <p class="m text-gray-1">
                    <i>par <?= $author->getName(); ?></i>
                </p>
            </header>

            <div class="description">
                <?= $params['event']->getDescription(); ?>
            </div>

            <hr />
            <h3 class="text-center font-hero">Contenu débloquable</h3>
                <?php $unlockable = $params['event']->findUnlockableContent();
                 if (!empty($unlockable)) {
                ?>
                <div class="unlockable-content-container">
                    <?php
                        foreach ($unlockable as $u) { ?>
                            <div class="glass gold unlockable-content locked" style="background-image: url(<?= $content->getImage(); ?>);color: <?= $content->getTextColor() ?? 'white'; ?>">
                                <h4 class="font-hero">
                                    <?= $u->getTitle(); ?>
                                </h4>
                                <p class="desc">
                                    <?= $u->getDescription(); ?>
                                </p>
                                
                                <?php if ($u->getRequiredPoints() > $params['event']->getPoints()): ?>
                                    <svg fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"></path></svg>
                                    <span><?= $params['event']->getPoints() ?>/<?= $u->getRequiredPoints(); ?></span>
                                <?php else: ?>
                                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M10 2a5 5 0 00-5 5v2a2 2 0 00-2 2v5a2 2 0 002 2h10a2 2 0 002-2v-5a2 2 0 00-2-2H7V7a3 3 0 015.905-.75 1 1 0 001.937-.5A5.002 5.002 0 0010 2z"></path></svg>
                                    <span>Contenu débloqué !</span>
                                <?php endif; ?>
                            </div>
                    <?php } ?>
                </div>
                <?php } else { ?>
                    <h6 class="text-center font-hero">
                        <i>Aucun contenu débloquable pour l'instant</i>
                    </h6>
                <?php } ?>
            <hr />

            <footer class="text-gray-3">
                <h5 class="date meta s">
                    Du <?= $params['event']->getStartDate()->format('Y/m/d à H:i'); ?>
                    au <?= $params['event']->getEndDate()->format('Y/m/d à H:i'); ?>
                </p>
                <h5 class="points meta s">
                    <svg fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path d="M8.433 7.418c.155-.103.346-.196.567-.267v1.698a2.305 2.305 0 01-.567-.267C8.07 8.34 8 8.114 8 8c0-.114.07-.34.433-.582zM11 12.849v-1.698c.22.071.412.164.567.267.364.243.433.468.433.582 0 .114-.07.34-.433.582a2.305 2.305 0 01-.567.267z"></path><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-13a1 1 0 10-2 0v.092a4.535 4.535 0 00-1.676.662C6.602 6.234 6 7.009 6 8c0 .99.602 1.765 1.324 2.246.48.32 1.054.545 1.676.662v1.941c-.391-.127-.68-.317-.843-.504a1 1 0 10-1.51 1.31c.562.649 1.413 1.076 2.353 1.253V15a1 1 0 102 0v-.092a4.535 4.535 0 001.676-.662C13.398 13.766 14 12.991 14 12c0-.99-.602-1.765-1.324-2.246A4.535 4.535 0 0011 9.092V7.151c.391.127.68.317.843.504a1 1 0 101.511-1.31c-.563-.649-1.413-1.076-2.354-1.253V5z" clip-rule="evenodd">
                        </path>
                    </svg>
                    <?= $params['event']->getPointsAmount() ?>
                </h5>
            </footer>
        </div>
        <aside>
            <div class="user glass slide-in-bottom">
                <header class="flex items-center">
                    <div class="avatar-container">
                        <img class="avatar" onerror="this.src='<?= Constants::getPublicPath() . '/vendor/svg/placeholder-bg.svg'; ?>'" src="<?= $author->getAvatar(); ?>" alt="Avatar de <?= $author->getName(); ?>">
                    </div>
                    <h2 class="font-hero slide-in-bottom-h1">
                        <?= $author->getName(); ?>
                    </h2>
                    <p class="m text-gray-1 slide-in-bottom-subtitle">
                        <?= $author->getEmail(); ?>
                    </p>
                </header>
            </div>
            <div class="donations glass slide-in-bottom">
                <a id="donationSorting" onclick="sort(this)" href="javascript:void(0);">
                    <h2 class="font-hero">
                        Dons&nbsp;
                        <?php if (!empty($params['donations'])): ?>
                            <span id="donationState" style="font-family: 'BigNoodleTitling'; ">↓</span>
                        <?php endif; ?>
                    </h2>
                </a>
                <?php if (empty($params['donations'])): ?>
                    <p>
                        Aucun don n'a été effectué pour l'instant. &nbsp;
                        <a href="<?= BASE_PATH . '/event/donate/' . $params['event']->getId(); ?>">
                            Donner des points
                        </a>
                    </p>
                <?php else: ?>
                    <table>
                        <thead>
                            <tr>
                                <th scope="col">Nom</th>
                                <th scope="col">Date</th>
                                <th scope="col">Montant</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($params['donations'] as $t): ?>
                                <tr>
                                    <td>
                                        <?= $t->getUser()->getName(); ?>
                                    </td>
                                    <td class="xs">
                                        <?= $t->getCreatedAt()->format('d/m à H:i'); ?>
                                    </td>
                                    <td>
                                        <svg fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M8.433 7.418c.155-.103.346-.196.567-.267v1.698a2.305 2.305 0 01-.567-.267C8.07 8.34 8 8.114 8 8c0-.114.07-.34.433-.582zM11 12.849v-1.698c.22.071.412.164.567.267.364.243.433.468.433.582 0 .114-.07.34-.433.582a2.305 2.305 0 01-.567.267z"></path><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-13a1 1 0 10-2 0v.092a4.535 4.535 0 00-1.676.662C6.602 6.234 6 7.009 6 8c0 .99.602 1.765 1.324 2.246.48.32 1.054.545 1.676.662v1.941c-.391-.127-.68-.317-.843-.504a1 1 0 10-1.51 1.31c.562.649 1.413 1.076 2.353 1.253V15a1 1 0 102 0v-.092a4.535 4.535 0 001.676-.662C13.398 13.766 14 12.991 14 12c0-.99-.602-1.765-1.324-2.246A4.535 4.535 0 0011 9.092V7.151c.391.127.68.317.843.504a1 1 0 101.511-1.31c-.563-.649-1.413-1.076-2.354-1.253V5z" clip-rule="evenodd">
                                            </path>
                                        </svg>
                                        <?= $t->getAmount(); ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="3">
                                        <p class="text-gray-less italic">
                                            <?= $t->getComment() ?? 'Aucun commentaire'; ?>
                                        </p>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="3">
                                        <hr class="text-gray-less" />
                                    </td>
                                </tr>
                        </tbody>
                    </table>
                    <?php endforeach; ?>
                    <center>
                        <a class="xs" href="<?= BASE_PATH . '/event/donate/' . $params['event']->getId(); ?>">
                            Donner des points
                        </a>
                    </center>
                <?php endif; ?>
            </div>
        </aside>
    </section>
</section>