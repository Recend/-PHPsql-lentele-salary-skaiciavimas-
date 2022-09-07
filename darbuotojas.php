<?php

include('database.php');
$darbuotojaiID = $_GET['id'];


$sql = "SELECT * FROM employees WHERE id = $darbuotojaiID";

$pstm = $pdo->prepare($sql);

$pstm->execute();
$darbuotojas = $pstm->fetchAll(PDO::FETCH_ASSOC);

$alga = $darbuotojas[0]['salary'] / 100;

if ($alga <= 1704) {
    $npd = 540 - 0.34 * ($alga - 730);
} elseif ($alga > 1704) {
    $npd = 400 - 0.18 * ($alga - 642);
}

$gpm = ($alga - $npd) * 0.2;
$psd = $alga * 0.0698;
$soc = $alga * 0.1252;
$rankas = $alga - $gpm - $psd - $soc;
$darbdavyioSanaudos = $alga * 0.0177;
$garantinisFondas = $alga * 0.0016;
$sodra = $psd + $soc + $darbdavyioSanaudos;
$viso = $gpm + $sodra;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
    <title>Document</title>
</head>

<body>
    <div class="container col-5">
        <div class="card">
            <div class="card-header">
                Darbuotojo atlyginimo išrašas
            </div>
            <div class="card-body">
                <h5 class="card-title">Darbuotojas: <?= $darbuotojas[0]['name'] . ' ' . $darbuotojas[0]['surname'] ?></h5>
                <p class="mt-3"> Taikytinas NPD (Pritaikytas NPD): <strong><?= $npd ?></strong> EUR</p>
                <p> Gyventojų pajamų mokėstis GPM - 20.00% : <strong><?= $gpm ?></strong> EUR</p>
                <p> Privalomasis sveikatos draudimas PSD - 6.98% : <strong><?= $psd ?></strong> EUR</p>
                <p> Valstybinis socialinis draudimas VSD - 12.52% : <strong><?= $soc ?></strong> EUR</p>
                <p> Atlyginimas į rankas : <strong><?= $rankas ?></strong> EUR</p>
                <p> Darbdavio mokesčiai - Viso : <strong><?= $darbdavyioSanaudos ?></strong> EUR</p>
                <p> Sodrai. Įmokos kodas - 252 : <strong><?= $sodra ?></strong> EUR</p>
                <p> Įmoka į Garantinį fondą : <strong><?= $garantinisFondas ?></strong> EUR</p>
                <p> VISO MOKĖSČIŲ : <strong><?= $viso ?></strong> EUR</p>
                <a href="employee.php" class="btn btn-primary">Atgal</a>
            </div>
        </div>
    </div>

</body>

</html>