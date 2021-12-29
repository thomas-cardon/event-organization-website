<?php
    View::addScript('chart.js', 'https://cdn.jsdelivr.net/npm/chart.js@3.6.2/dist/chart.min.js', 'sha384-4OMvxyBTgFvMJK0tWjIk57FbleRvzmamjg6m+ERG0/p0rV83S6PHHUcLu84Gt+SF', 'anonymous', true, 'text/javascript', 'head', true);
?>
<canvas id="pointsSpent"></canvas>
<script>
    const style = getComputedStyle(document.querySelector('main.dashboard'));
    const color = style.getPropertyValue('--primary');
    
    window.addEventListener("DOMContentLoaded", e => {
        let ctx = document.getElementById("pointsSpent");
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Janvier', 'Février', 'Mars'],
                datasets: [{
                    label: 'Dépense des points',
                    data: [65, 59, 80, 81, 56, 55, 40],
                    fill: false,
                    borderColor: color,
                    tension: 0.4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    title: {
                        display: true,
                        text: 'Répartition des points',
                        font: {
                            size: 20,
                            color: 'white',
                            weight: '200'
                        },
                        padding: {
                            top: 0,
                            bottom: 20
                        }
                    },
                    legend: {
                        display: false
                    }
                }
            }
        });
    });
</script>