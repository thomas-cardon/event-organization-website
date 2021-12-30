<div class="flex card card-transparent">
    <header>
        <h2>Mes dernières idées</h2>
        <a class="btn" href="<?php echo BASE_PATH; ?>/dashboard/create-event">
            <svg fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path>
            </svg>
            Créer
        </a>
    </header>
    <h2 class="title"></h2>
    <table id="recentUsers" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>Statut</th>
                <th>Nom</th>
                <th>Campagne</th>
                <th>Points</th>
                <th>Voir</th>
                <th>Modifier</th>
            </tr>
        </thead>
        <tbody>
          <?php $params['recent_events'] = array(
                (object) array(
                    'id' => 1,
                    'name' => 'Event 1',
                    'campaignName' => 'Campaign 1',
                    'status' => 'success', // inProgress, success, failure
                    'points' => 1000
                ),
                (object) array(
                    'id' => 2,
                    'name' => 'Event 2',
                    'campaignName' => 'Campaign 1',
                    'status' => 'inProgress', // inProgress, success, failure
                    'points' => 1000
                ),
                (object) array(
                    'id' => 3,
                    'name' => 'Event 3',
                    'campaignName' => 'Campaign 1',
                    'status' => 'inProgress', // inProgress, success, failure
                    'points' => 1000
                ),
                (object) array(
                    'id' => 4,
                    'name' => 'Event 4',
                    'campaignName' => 'Campaign 1',
                    'status' => 'inProgress', // inProgress, success, failure
                    'points' => 1000
                ),
            );
          ?>
          <?php foreach ($params['recent_events'] as $event) : ?>
            <tr>
                <td>
                    <div class="role <?php echo $event->status ?>"></div>
                </td>
                <td>
                    <?php echo $event->name ?>
                </td>
                <td>
                    <i>
                        <?php echo $event->campaignName ?>
                    </i>
                </td>
                <td><?php echo $event->points ?></td>
                <td><a href="<?php echo BASE_PATH . '/event/see/' . $event->id; ?>">Voir</a></td>
                <td><a href="<?php echo BASE_PATH . '/dashboard/edit-event/' . $event->id; ?>">Modifier</a></td>
            </tr>
          <?php endforeach ?>
        </tbody>
    </table>
    <a class="see-more" href="<?php echo Constants::getPublicPath(); ?>/dashboard/users">Voir tous les utilisateurs</a>
</div>
