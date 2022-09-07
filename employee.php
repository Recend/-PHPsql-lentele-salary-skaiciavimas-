<?php

include('database.php');

$sql = "SELECT * FROM employees";

$pstm = $pdo->prepare($sql);

$pstm->execute();
$darbuotojai = $pstm->fetchAll(PDO::FETCH_ASSOC);




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
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header text-center">Darbuotojai</div>
                    <table class="table table-light table-striped">
                        <thead>
                            <tr>
                                <th>Eil.nr</th>
                                <th>Vardas</th>
                                <th>Pavardė</th>
                                <th>Išsilavinimas</th>
                                <th>Bazinis atlyginimas</th>
                                <th>Apie darbuotoją</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($darbuotojai as $darbuotojas) { ?>
                                <tr>
                                    <td><?= $darbuotojas['id'] ?></td>
                                    <td><?= $darbuotojas['name'] ?></td>
                                    <td><?= $darbuotojas['surname'] ?></td>
                                    <td><?= $darbuotojas['education'] ?></td>
                                    <td><?= $darbuotojas['salary'] ?></td>
                                    <td><a class="btn btn-primary" href="darbuotojas.php?id=<?= $darbuotojas['id'] ?>">Plačiau</a></td>
                                <?php } ?>
                                </tr>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</body>

</html>