<?php
session_start();
include_once "../controllers/controller_session.php";
checkSessionAndRedirect($requiredRole = "Admin");

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
            include "../models/connection.php";
            include "../controllers/controller_reports.php";

            ?> <br><br> <br><br> <br><br> <br><br>

            <h2>Reports with developers all tasks</h2>
            <div class="canvas">
                <canvas id="allTaskDevelopersChart"></canvas>
            </div><br><br> <br><br>

            <h2>Reports with developers all tasks Done</h2>
            <div class="canvas">
                <canvas id="allDoneTaskDevelopersChart"></canvas>
            </div><br><br> <br><br>

            <h2>Reports with developers all purchases</h2>
            <div class="canvas">
                <canvas id="allPurchasesChart"></canvas>
            </div><br><br> <br><br>


        </div>

        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <?= getReportTasks("allTaskDevelopersChart"); ?>
        <?= getReportDoneTasks("allDoneTaskDevelopersChart"); ?>
        <?= getReportPurchases("allPurchasesChart"); ?>
        <br><br> <br><br> <br><br> <br><br>


        <footer>
            <p>Derechos Reservados &copy; DigitCol</p>
        </footer>
    </div>
    <script src="script.js"></script>
</body>

</html>