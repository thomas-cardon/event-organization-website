<?php
    View::setTitle('Tableau de bord');
    View::addStyleSheet('/vendor/css/bourbon/dashboard.css');
?>

<main class="dashboard">
    <?php View::show('components/header', $params); ?>

    <nav class="buttons vertical">
        <a href="<?php echo Constants::getPublicPath() ?>/dashboard/events">
            ☰
        </a>
        <a href="<?php echo Constants::getPublicPath() ?>/dashboard/users">
            ☰
        </a>
        <a href="<?php echo Constants::getPublicPath() ?>/dashboard/settings">
            ☰
        </a>
    </nav>

    <section class="content">
        <div class="overview">
            <div class="card-chart">
                <canvas id="myChart"></canvas>
            </div>

            <div class="card-chart">
                <canvas id="pointsRepartition"></canvas>
            </div>

            <div>
                <div class="card-sm">
                    <div class="info">
                        <p>Evènements en attente</p>
                        <h2>
                            <?php echo $params['events_waiting'] ?? 0 ?>
                        </h2>
                    </div>
                    <div class="icon">
                        <svg fill="currentColor" viewBox="0 0 20 20" class="w-5 h-5">
                            <path
                                fill-rule="evenodd"
                                d="M18 5v8a2 2 0 01-2 2h-5l-5 4v-4H4a2 2 0 01-2-2V5a2 2 0 012-2h12a2 2 0 012 2zM7 8H5v2h2V8zm2 0h2v2H9V8zm6 0h-2v2h2V8z"
                                clip-rule="evenodd"
                            ></path>
                        </svg>
                    </div>
                </div>
                <div class="card-sm">
                    <div class="info">
                        <p>Tournois en cours</p>
                        <h2>
                            <?php echo $params['tournaments_ongoing'] ?? 0 ?>
                        </h2>
                    </div>
                    <div class="icon">
                        <svg fill="currentColor" viewBox="0 0 20 20" class="w-5 h-5">
                            <path
                                fill-rule="evenodd"
                                d="M18 5v8a2 2 0 01-2 2h-5l-5 4v-4H4a2 2 0 01-2-2V5a2 2 0 012-2h12a2 2 0 012 2zM7 8H5v2h2V8zm2 0h2v2H9V8zm6 0h-2v2h2V8z"
                                clip-rule="evenodd"
                            ></path>
                        </svg>
                    </div>
                </div>
                <div class="card-sm">
                    <div class="info">
                        <p>Nombre total de points en circulation</p>
                        <h2>
                            <?php echo $params['points_circulation'] ?? 0 ?>
                        </h2>
                    </div>
                    <div class="icon">
                        <svg fill="currentColor" viewBox="0 0 20 20" class="w-5 h-5">
                            <path
                                fill-rule="evenodd"
                                d="M18 5v8a2 2 0 01-2 2h-5l-5 4v-4H4a2 2 0 01-2-2V5a2 2 0 012-2h12a2 2 0 012 2zM7 8H5v2h2V8zm2 0h2v2H9V8zm6 0h-2v2h2V8z"
                                clip-rule="evenodd"
                            ></path>
                        </svg>
                    </div>
                    <!-- https://codepen.io/kevjose/pen/YzXrobv -->
                </div>
            </div>
        </div>

        <div class="main_cards">
            <?php View::show('components/dashboard/widgets/recentUsers', array( 'data' => $params['recent_users'] ?? null )); ?>
            <div class="card">
              
            </div>
            <div class="card card-transparent">
              <canvas id="pointsSpent"></canvas>
            </div>
        </div>
    </section>
    <?php View::show('components/footer', array( 'dashboard' => true )); ?>
</main>
    <script type="text/javascript">
      const menuIcon = document.querySelector('.menu-icon');
      const aside = document.querySelector('.aside');
      const asideClose = document.querySelector('.aside_close-icon');

      function toggle(el, className) {
        if (el.classList.contains(className)) {
          el.classList.remove(className);
        } else {
          el.classList.add(className);
        }
      }

      menuIcon.addEventListener('click', function() {
        toggle(aside, 'active');
      });

      asideClose.addEventListener('click', function() {
        toggle(aside, 'active');
      });
    </script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@3.6.2/dist/chart.min.js" integrity="sha384-4OMvxyBTgFvMJK0tWjIk57FbleRvzmamjg6m+ERG0/p0rV83S6PHHUcLu84Gt+SF" crossorigin="anonymous"></script>
<script>
    Chart.defaults.color = 'white';
    
    let ctx = document.getElementById("myChart");
    new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ['Administrateur', 'Organisateur', 'Jury', 'Participant'],
                datasets: [{
                label: '# of Tomatoes',
                data: [12, 19, 3, 5],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.5)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)'
                ],
                borderColor: [
                    'rgba(255,99,132,1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)'
                ],
                borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        align: 'left'
                    }
                }
            }
        });

        let points = [
            ['Jane', 10000],
            ['John', 8000],
            ['Peter', 6000],
            ['Mary', 4000],
            ['Susan', 2000],
            ['Julie', 1000]
        ];

        let labels = points.map(point => point[0]);
        let data = points.map(point => point[1]);

        ctx = document.getElementById("pointsRepartition");
        new Chart(ctx, {
            type: 'pie',
            data: {
                datasets: [{
                label: 'Répartition des points',
                data,
                backgroundColor: [
                    'rgba(255, 99, 132, 0.5)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)'
                ],
                borderColor: [
                    'rgba(255,99,132,1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)'
                ],
                borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        align: 'left'
                    }
                }
            }
        });

        ctx = document.getElementById("pointsSpent");
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Janvier', 'Février', 'Mars'],
                datasets: [{
                    label: 'Dépense des points',
                    data: [65, 59, 80, 81, 56, 55, 40],
                    fill: false,
                    borderColor: 'rgb(75, 192, 192)',
                    tension: 0.4
                }]
            }
        });


</script>
