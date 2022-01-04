<?php
    View::setTitle('Tableau de bord');
    View::addStyleSheet('/assets/css/dashboard.css');
?>

<main class="dashboard">
  <?php View::show('components/header', $params); ?>
  <div class="main">
    <div class="content">
        <?php
        if (isset($params['content']))
            echo $params['content'];
        else if ($params['user']->getRole() === 'admin')
            View::show('components/dashboard/widgets/recentUsers', array( 'data' => $params['recent_users'] ?? null ));
        else if ($params['user']->getRole() === 'organizer') View::show('components/dashboard/widgets/myRecentEvents', array( 'data' => $params['my_recent_events'] ?? null ));
        ?>
    </div>

    <div class="numbers">
        <div class="card">
            <div class="info">
                <p>Evènements en attente de validation</p>
                <h2>
                    <?php echo $params['events_waiting'] ?? 0 ?>
                </h2>
            </div>
            <div class="icon">
                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M18 10c0 3.866-3.582 7-8 7a8.841 8.841 0 01-4.083-.98L2 17l1.338-3.123C2.493 12.767 2 11.434 2 10c0-3.866 3.582-7 8-7s8 3.134 8 7zM7 9H5v2h2V9zm8 0h-2v2h2V9zM9 9h2v2H9V9z" clip-rule="evenodd">
                    </path>
                </svg>
            </div>
        </div>
        <div class="card">
            <div class="info">
                <p>Campagnes réalisées</p>
                <h2>
                    <?php echo $params['campaigns_done'] ?? 0 ?>
                </h2>
                    </div>
            <div class="icon">
                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                </svg>
            </div>
        </div>
        <div class="card glow">
            <div class="info">
                <p>Points en circulation</p>
                <h2>
                    <?php echo $params['points_circulation'] ?? 0 ?>
                </h2>
            </div>
            <div class="icon">
                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path d="M8.433 7.418c.155-.103.346-.196.567-.267v1.698a2.305 2.305 0 01-.567-.267C8.07 8.34 8 8.114 8 8c0-.114.07-.34.433-.582zM11 12.849v-1.698c.22.071.412.164.567.267.364.243.433.468.433.582 0 .114-.07.34-.433.582a2.305 2.305 0 01-.567.267z"></path><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-13a1 1 0 10-2 0v.092a4.535 4.535 0 00-1.676.662C6.602 6.234 6 7.009 6 8c0 .99.602 1.765 1.324 2.246.48.32 1.054.545 1.676.662v1.941c-.391-.127-.68-.317-.843-.504a1 1 0 10-1.51 1.31c.562.649 1.413 1.076 2.353 1.253V15a1 1 0 102 0v-.092a4.535 4.535 0 001.676-.662C13.398 13.766 14 12.991 14 12c0-.99-.602-1.765-1.324-2.246A4.535 4.535 0 0011 9.092V7.151c.391.127.68.317.843.504a1 1 0 101.511-1.31c-.563-.649-1.413-1.076-2.354-1.253V5z" clip-rule="evenodd">
                    </path>
                </svg>
            </div>
        </div>
    </div>
    <div class="card chart chart-aside-1">
        <?php View::show('components/dashboard/widgets/pointsSpent', array( 'data' => $params['points_spent'] ?? null )); ?>
    </div>
    <div class="card chart chart-aside-2"></div>
    <div class="card chart chart-1">
        <?php View::show('components/dashboard/widgets/userChart', $params['recent_users'] ?? array()); ?>
    </div>
    <div class="card chart chart-2">
        <?php View::show('components/dashboard/widgets/pointsRepartition', $params['points_repartition'] ?? array()); ?>
    </div>

    <nav class="buttons vertical">
        <a href="<?php echo BASE_PATH ?>/dashboard">
            <svg fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path>
            </svg>
        </a>
        <a href="<?php echo BASE_PATH ?>/dashboard/create-user">
            <svg fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z"></path>
            </svg>
        </a>
        <a href="<?php echo BASE_PATH ?>/dashboard/create-campaign">
            <svg fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M5 2a1 1 0 011 1v1h1a1 1 0 010 2H6v1a1 1 0 01-2 0V6H3a1 1 0 010-2h1V3a1 1 0 011-1zm0 10a1 1 0 011 1v1h1a1 1 0 110 2H6v1a1 1 0 11-2 0v-1H3a1 1 0 110-2h1v-1a1 1 0 011-1zM12 2a1 1 0 01.967.744L14.146 7.2 17.5 9.134a1 1 0 010 1.732l-3.354 1.935-1.18 4.455a1 1 0 01-1.933 0L9.854 12.8 6.5 10.866a1 1 0 010-1.732l3.354-1.935 1.18-4.455A1 1 0 0112 2z" clip-rule="evenodd"></path>
            </svg>
        </a>
        <?php if ($params['user']->getRole() === 'admin' || $params['user']->getRole() === 'organizer'): ?>
            <a href="<?php echo BASE_PATH ?>/dashboard/create-event">
                <svg fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path>
                </svg>
            </a>
        <?php endif; ?>
    </nav>
  </div>
  <?php View::show('components/footer', $params); ?>
</div>