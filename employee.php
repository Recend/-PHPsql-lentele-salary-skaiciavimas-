<?php


include('database.php');

if (isset($_GET['action']) && $_GET['action'] == 'delete') {
    $sql = "DELETE FROM employees WHERE id=?";
    $pstm = $pdo->prepare($sql);
    $pstm->execute([$_GET['id']]);
}

$sql = "SELECT employees.*, positions.name as position_name FROM employees LEFT JOIN positions ON employees.position_id=positions.id";
$pstm = $pdo->prepare($sql);
$pstm->execute();
$darbuotojai = $pstm->fetchAll(PDO::FETCH_ASSOC);





// echo "lytis". $_POST['gender'];



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
                    <div>
                        <table class="table table-light table-striped">

                            <thead>
                                <tr>
                                    <th>Eil.nr</th>
                                    <th>Vardas</th>
                                    <th>Pavardė</th>
                                    <th>Išsilavinimas</th>
                                    <th>Bazinis atlyginimas</th>
                                    <th>Pareigos</th>
                                    <th>Apie darbuotoją</th>
                                    <th></th>
                                    <th></th>
                                    <th><a href="new.php" class="btn btn-success">Prideti naują darbuotoją</a></th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($darbuotojai as $darbuotojas) { ?>
                                    <tr>
                                        <td><?= $darbuotojas['id'] ?></td>
                                        <td><?= $darbuotojas['name'] ?></td>
                                        <td><?= $darbuotojas['surname'] ?></td>
                                        <td><?= $darbuotojas['education'] ?></td>
                                        <td><?= $darbuotojas['salary'] / 100  ?> EUR</td>
                                        <td><?= $darbuotojas['position_name'] ?></td>
                                        <td><a class="btn btn-primary" href="darbuotojas.php?id=<?= $darbuotojas['id'] ?>">Plačiau</a></td>
                                        <td><a href="redaguoti.php?id=<?= $darbuotojas['id'] ?>" class="btn btn-info">Redaguoti</a></td>
                                        <td><a href="employee.php?action=delete&id=<?= $darbuotojas['id'] ?>" class="btn btn-danger">Ištrinti</a></td>
                                        <td><a href="add.php?id=<?= $darbuotojas['id'] ?>" class="btn btn-secondary">Prideti projekta</a></td>
                                    <?php } ?>
                                    </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>