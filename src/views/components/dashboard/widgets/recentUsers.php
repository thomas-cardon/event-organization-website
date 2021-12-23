<div class="flex card card-transparent">
    <header>
        <h2>Utilisateurs récents</h2>
        <a class="btn" href="<?php echo BASE_PATH; ?>/dashboard/create-user">
            <svg fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path d="M8 9a3 3 0 100-6 3 3 0 000 6zM8 11a6 6 0 016 6H2a6 6 0 016-6zM16 7a1 1 0 10-2 0v1h-1a1 1 0 100 2h1v1a1 1 0 102 0v-1h1a1 1 0 100-2h-1V7z"></path>
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
