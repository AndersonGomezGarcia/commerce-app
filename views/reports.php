<?php
session_start();
if (empty($_SESSION["id"])) {
}
?>
<html lang="en">

<head>
    <?php include "../controllers/controller_html.php";
    head("Home");

    ?>

</head>

<body>
    <div id="blur">
        <header>
            <?php nav(); ?>
        </header>
        <div class="products catalogue">
            <text class="tittlep">
                <h1>Info about of performance</h1>
                <h2>Options to manage it</h2>
            </text>
            <?php
            include "../controllers/controller_reports.php";
            ?>
            <div class="canvas">
                <canvas id="myChart"></canvas>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

        <script>
            const ctx = document.getElementById('myChart');

            new Chart(ctx, {
                type: 'polarArea',
                
                data: {
                    labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
                    datasets: [{
                        label: '# of Votes',
                        data: [12, 19, 3, 5, 2, 3],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        </script>

        <footer>
            <p>Derechos Reservados &copy; DigitCol</p>
        </footer>
    </div>
    <script src="script.js"></script>
</body>

</html>