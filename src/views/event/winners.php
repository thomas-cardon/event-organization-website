<?php 
    View::setTitle('Grands gagnants');
?>

<section class="lead">
    <h1 class="font-hero slide-in-bottom-h1">Grands gagnants</h1>
    <div class="glass">
        <table>
            <thead>
                <tr>
                    <th>Nom de l'évènement</th>
                    <th>Description</th>
                    <th>Date de début</th>
                    <th>Date de fin</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($params['winners'] as $winner) { ?>
                <tr>
                    <td><?php echo $winner['name']; ?></td>
                    <td><?php echo $winner['description']; ?></td>
                    <td><?php echo $winner['start_date']; ?></td>
                    <td><?php echo $winner['end_date']; ?></td>
                    <td>
                        <a href="<?php echo BASE_PATH . '/event/winner/' . $winner['id']; ?>">
                            <i class="fas fa-eye"></i>
                        </a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</section>