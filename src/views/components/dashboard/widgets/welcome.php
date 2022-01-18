<div class="flex card" style="margin-top: -1rem;">

    <header class="horizontal">
        <h4 class="font-thin">
            Bienvenue sur votre <b>tableau de bord</b>
        </h4>
        <p class="s">
            En tant que <b>
            <?php switch($params['user']->getRole()){
                case 'donor':
                    echo 'donateur</b>, vous possédez des points qui vous sont restitués à chaque début de campagne. Vous pouvez les utiliser pour mettre en avant un évènement qui vous intéresse.';
                    break;
                case 'organizer':
                    echo 'organisateur</b>, votre rôle est de voter pour les évènements qui vous intéressent, dans les 24 heures qui suivent la campagne.';
                    break;
                case 'admin':
                    echo 'administrateur</b>, vous pouvez accéder à toutes les fonctionnalités de l\'application, comme la gestion des évènements, campagnes, utilisateurs, etc.';
                    break;
                case 'member':
                    echo 'membre</b>, vous ne possédez que les droits en lecture.';
                    break;
            } ?>
        </p>
    </header>

</div>
<?php if(isset($params['campaign_pending_for_vote']) && $params['user']->getRole() == 'jury'): ?>
    <div class="flex card" style="margin-top: 2rem;">

        <header class="horizontal">
            <h4 class="font-thin">
                Voter pour une campagne: <b><?php echo $params['campaign_pending_for_vote']->getName(); ?></b>
            </h4>
            <div class="horizontal w-full">
                <p class="s">
                    <?php
                        $d1 = new DateTime();
                        $d2 = new DateTime();
                        $d2->add(new DateInterval('P1D'));
                        $d2->setTime(0,0,0);

                        $diff = $d1->diff($d2);
                        $hours = $diff->format('%h heures %i minutes');
                    ?>
                    Il vous reste <b><?= $hours; ?></b> pour voter pour cette campagne.
                    <br />
                    Cliquez sur le bouton ci-dessous pour voter.
                </p>
                <a class="btn action" href="<?= BASE_PATH . '/dashboard/vote'; ?>" class="button">
                    Voter
                </a>
            </div>
        </header>

    </div>
<?php endif; ?>
<div style="margin-bottom: 1rem;"></div>