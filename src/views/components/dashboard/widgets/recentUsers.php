<div class="flex card transparent">
    <header>
        <h4 class="font-thin">
        <?php if ($params['hide_all_users_button']): ?>
            Tous les utilisateurs
        <?php else: ?>
            Utilisateurs récents
        <?php endif; ?>
        </h4>
        <a class="btn" href="<?= BASE_PATH; ?>/dashboard/create-user">
            <svg fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path d="M8 9a3 3 0 100-6 3 3 0 000 6zM8 11a6 6 0 016 6H2a6 6 0 016-6zM16 7a1 1 0 10-2 0v1h-1a1 1 0 100 2h1v1a1 1 0 102 0v-1h1a1 1 0 100-2h-1V7z"></path>
            </svg>
            Créer
        </a>
    </header>
    <?php if (is_array($params['data'])): ?>
        <table id="recentUsers" class="table table-striped table-bordered" style="width:100% table-layout: fixed;">
            <tbody>
            <?php foreach ($params['data'] as $user) : ?>
                <tr>
                    <td width="5%">
                        <div class="role <?= $user->getRole(); ?>"></div>
                    </td>
                    <td class="xs" width="12%">
                        <?= $user->getName(); ?>
                    </td>
                    <td class="xs" width="12%"><?= $user->getEmail(); ?></td>
                    <td width="9.5%">
                        <?= $user->getPoints(); ?>$</td>
                    <td class="xs" width="12%"><?= $user->getCreatedAt()->format('d/m/Y'); ?></td>
                    <td width="42%">

                        <a class="xs" href="<?= BASE_PATH; ?>/dashboard/edit-user/<?= $user->getId(); ?>"/>
                            Modifier
                        </a>
                        
                        <span> | </span>

                        <a class="xs" href="<?= BASE_PATH; ?>/dashboard/add-points/<?= $user->getId(); ?>"/>
                            Ajouter points
                        </a>
                    </td>
                </tr>
            <?php endforeach ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>Une erreur est survenue lors de l'affichage des utilisateurs.</p>
    <?php endif ?>
    <?php if (!$params['hide_all_users_button']): ?>
        <a class="see-more" href="<?= BASE_PATH; ?>/dashboard/users">Voir tous les utilisateurs</a>
    <?php endif ?>
</div>
