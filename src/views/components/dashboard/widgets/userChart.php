<?php
    View::addScript('chart.js', 'https://cdn.jsdelivr.net/npm/chart.js@3.6.2/dist/chart.min.js', true, 'head', true, 'text/javascript', 'sha384-4OMvxyBTgFvMJK0tWjIk57FbleRvzmamjg6m+ERG0/p0rV83S6PHHUcLu84Gt+SF', 'anonymous');
?>
<canvas id="userChart"></canvas>
<script>
    window.addEventListener("DOMContentLoaded", e => {
        Chart.defaults.color = 'white';
        let ctx = document.getElementById("userChart");
        const style = getComputedStyle(document.querySelector('main.dashboard'));
        const c0 = style.getPropertyValue('--chart-color-0');
        const c1 = style.getPropertyValue('--chart-color-1');
        const c2 = style.getPropertyValue('--chart-color-2');
        const c3 = style.getPropertyValue('--chart-color-3');

        new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: ['Administrateur', 'Organisateur', 'Jury', 'Participant'],
                    datasets: [{
                        data: [12, 19, 3, 5],
                        backgroundColor: [c0, c1, c2, c3],
                        borderWidth: 0
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        },
                        title: {
                            display: true,
                            text: 'Répartition des utilisateurs',
                            font: {
                                size: 20,
                                weight: '200'
                            },
                            padding: {
                                top: 0,
                                bottom: 20
                            }
                        }
                    }
                }
        });
    });
</script>