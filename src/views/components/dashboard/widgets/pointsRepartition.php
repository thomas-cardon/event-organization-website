<?php
    View::addScript('chart.js', 'https://cdn.jsdelivr.net/npm/chart.js@3.6.2/dist/chart.min.js', true, 'head', true, 'text/javascript', 'sha384-4OMvxyBTgFvMJK0tWjIk57FbleRvzmamjg6m+ERG0/p0rV83S6PHHUcLu84Gt+SF', 'anonymous');
?>
<div class="card-chart">
    <canvas id="pointsRepartition"></canvas>
</div>
<script>
    window.addEventListener("DOMContentLoaded", e => {
        let ctx = document.getElementById("pointsRepartition");
        const style = getComputedStyle(document.querySelector('main.dashboard'));
        const c0 = style.getPropertyValue('--chart-color-0');
        const c1 = style.getPropertyValue('--chart-color-1');
        const c2 = style.getPropertyValue('--chart-color-2');
        const c3 = style.getPropertyValue('--chart-color-3');
        const c4 = style.getPropertyValue('--chart-color-4');
        const c5 = style.getPropertyValue('--chart-color-5');

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

        new Chart(ctx, {
            type: 'doughnut',
            data: {
                datasets: [{
                    data,
                    backgroundColor: [
                        c0, c1, c2, c3, c4, c5
                    ],
                    borderWidth: 0
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
                            weight: '200'
                        },
                        padding: {
                            top: 0,
                            bottom: 20
                        }
                    },
                    legend: {
                        display: false
                    },
                    tooltip: {
                        callbacks: {
                            label: function(tooltipItem, data) {
                                return `${labels[tooltipItem.dataIndex]} : ${tooltipItem.dataset.data[tooltipItem.dataIndex]} points`;
                            }
                        },
                        enabled: true
                    }
                }
            }
        });
    });
</script>