<div class="flex card transparent">
    <header>
        <h4 class="font-thin">Mes dernières idées</h4>
        <a class="btn" href="<?php echo BASE_PATH; ?>/dashboard/create-event">
            <svg fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path>
            </svg>
            Créer
        </a>
    </header>
    <?php if (empty($params['data'])): ?>
        <p>Vous n'avez pas encore proposé d'évènements.</p>
    <?php else: ?>
        <table id="recentUsers" class="table table-striped table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th>Statut</th>
                    <th>Nom</th>
                    <th>Campagne</th>
                    <th>Points</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($params['data'] as $event) : ?>
                <?php echo var_dump($event->getCampaign()); ?>
                <tr>
                    <td>
                        <div class="role <?php echo $event->getStatus() ?>"></div>
                    </td>
                    <td>
                        <?php echo $event->getName() ?>
                    </td>
                    <td>
                        <i>
                            <?php echo $event->getCampaign()->getName() ?>
                        </i>
                    </td>
                    <td><?php echo $event->getPointsAmount() ?></td>
                    <td class="xs">
                        <a href="<?php echo BASE_PATH . '/event/see/' . $event->getId(); ?>">Voir</a>
                        | <a href="<?php echo BASE_PATH . '/dashboard/edit-event/' . $event->getId(); ?>">Modifier</a>
                    </td>
                </tr>
            <?php endforeach ?>
            </tbody>
        </table>
    <?php endif ?>
</div>
