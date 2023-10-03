<?php
include_once "functions_controllers.php";

function getReportChart($myChart, $data, $listLabels, $listDatasets, $typeChart)
{
?><script>
        const <?= $myChart ?> = document.getElementById('<?= $myChart ?>');

        new Chart(<?= $myChart ?>, {
            type: '<?= $typeChart ?>',
            data: {
                labels: [<?= $listLabels ?>],
                datasets: [{
                    label: '<?= $data ?>',
                    data: [<?= $listDatasets ?>],
                    backgroundColor: [
                        '#A144FF',
                        '#376FFF',
                        'rgb(71, 221, 255)',
                        '#c800ff',
                        'rgb(54, 162, 235)'
                    ],
                    borderWidth: 1,
                    fill: true,
                    borderColor: 'rgb(75, 192, 192)',
                    tension: 0.1
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
<?php
}
function getReportTasks($myChart)
{
    $data = [];
    $allPurchases = getAllItems("purchases");
    while ($purchase = $allPurchases->fetch_object()) {
        $id = $purchase->id_developer;
        //Si no lo encunetra en la lista (clave=>valor) lo inserta con valor 1, de lo contrario solamente le suma 1
        if (!array_key_exists($id, $data)) $data[$id] = 1;
        else $data[$id]++;
    }
    $listLabels = "";
    $listDatasets = "";
    foreach ($data as $key => $value) {
        $listLabels = $listLabels. " 'Developer #$key', ";
        $listDatasets = $listDatasets . " $value, ";
    }
    getReportChart($myChart, "Number of tasks", $listLabels, $listDatasets, "pie");
}
function getReportDoneTasks($myChart)
{
    $data = [];
    $allPurchases = getAllItems("purchases");
    while ($purchase = $allPurchases->fetch_object()) {
        if ($purchase->status !== "Done") continue; //SI(Tarea no esta completada) Continue con la siguiente tarea
        $id = $purchase->id_developer;
        if (!array_key_exists($id, $data)) $data[$id] = 1;
        else $data[$id]++;
    }
    $listLabels = "";
    $listDatasets = "";
    foreach ($data as $key => $value) {
        $listLabels = $listLabels . " 'Developer #$key', ";
        $listDatasets = $listDatasets . " $value, ";
    }
    getReportChart($myChart, "Number of tasks", $listLabels, $listDatasets, "pie");
}

function getReportPurchases($myChart)
{
    $data = [];
    $allPurchases = getAllItems("purchases");
    while ($purchase = $allPurchases->fetch_object()) {
        $id = $purchase->id_developer;
        //Si no lo encunetra en la lista (clave=>valor) lo inserta con valor 1, de lo contrario solamente le suma 1
        if (!array_key_exists($id, $data)) $data[$id] = 1;
        else $data[$id]++;
    }
    $listLabels = "";
    $listDatasets = "";
    foreach ($data as $key => $value) {
        $listLabels = $listLabels . " 'Developer #$key', ";
        $listDatasets = $listDatasets . " $value, ";
    }
    getReportChart($myChart, "Number of tasks", $listLabels, $listDatasets, "line");
}
?>