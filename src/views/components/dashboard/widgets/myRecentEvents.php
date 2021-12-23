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
                <th>Rôle</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Email</th>
                <th>Date d'inscription</th>
            </tr>
        </thead>
        <tbody>
          <?php $params['recent_users'] = array(
                (object) array(
                    'firstName' => 'John',
                    'lastName' => 'Doe',
                    'email' => 'test.test@test.fr',
                    'role' => 'admin',
                    'createdAt' => '2020-01-01 00:00:00'
                ),
                (object) array(
                    'firstName' => 'John',
                    'lastName' => 'Doe',
                    'email' => 'test.test@test.fr',
                    'role' => 'organizer',
                    'createdAt' => '2020-01-01 00:00:00'
                ),
                (object) array(
                    'firstName' => 'John',
                    'lastName' => 'Doe',
                    'email' => 'test.test@test.fr',
                    'role' => 'admin',
                    'createdAt' => '2020-01-01 00:00:00'
                ),
                (object) array(
                    'firstName' => 'John',
                    'lastName' => 'Doe',
                    'email' => 'test.test@test.fr',
                    'role' => 'organizer',
                    'createdAt' => '2020-01-01 00:00:00'
                ),
                (object) array(
                    'firstName' => 'John',
                    'lastName' => 'Doe',
                    'email' => 'test.test@test.fr',
                    'role' => 'donor',
                    'createdAt' => '2020-01-01 00:00:00'
                )
            );
          ?>
          <?php foreach ($params['recent_users'] as $user) : ?>
            <tr>
                <td>
                    <div class="role <?php echo $user->role ?>"></div>
                </td>
                <td>
                    <?php echo $user->lastName ?>
                </td>
                <td><?php echo $user->firstName ?></td>
                <td><?php echo $user->email ?></td>
                <td><?php echo $user->createdAt ?></td>
            </tr>
          <?php endforeach ?>
        </tbody>
    </table>
    <a class="see-more" href="<?php echo Constants::getPublicPath(); ?>/dashboard/users">Voir tous les utilisateurs</a>
</div>
