<?php
include("database.php");

if (isset($_POST['action']) && $_POST['action'] == 'update') {
    $sql = "UPDATE employees SET name=?, surname=?, gender=?,  phone=?, birthday=?, education=?, salary=?, position_id=?, project_id=? WHERE id=?";
    $stm = $pdo->prepare($sql);
    $stm->execute([$_POST['name'], $_POST['surname'], $_POST['gender'],  $_POST['phone'], $_POST['birthday'], $_POST['education'], $_POST['salary'], $_POST['position_id'], $_POST['project_id'], $_POST['id']]);
    header("location:employee.php");
    die();
}
$employee = [];
$position = [];
$projects = [];
if (isset($_GET['id'])) {
    $sql = "SELECT * FROM employees WHERE id=?";
    $stm = $pdo->prepare($sql);
    $stm->execute([$_GET['id']]);
    $employee = $stm->fetch(PDO::FETCH_ASSOC);

    $sql = "SELECT * FROM positions";
    $stm = $pdo->prepare($sql);
    $stm->execute([]);
    $position = $stm->fetchAll(PDO::FETCH_ASSOC);

    $sql = "SELECT * FROM projects";
    $stm = $pdo->prepare($sql);
    $stm->execute([]);
    $projects = $stm->fetchAll(PDO::FETCH_ASSOC);
   

    
} else {
    header("location:employee.php");
    die();
}

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
                    <div class="card-header">Redaguoti duomenis</div>

                    <div class="card-body">
                        <form action="" method="POST">
                            <input type="hidden" name="action" value="update">
                            <input type="hidden" name="id" value="<?= $employee['id'] ?>">
                            <div class="mb-3">
                                <label for="" class="form-label">Vardas</label>
                                <input name="name" type="text" class="form-control" value="<?= $employee['name'] ?>">
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Pavardė</label>
                                <input name="surname" type="text" class="form-control" value="<?= $employee['surname'] ?>">
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Lytis:</label><br>
                                <label for="vyras" class="form-label">Vyras</label>
                                <input name="gender" id="vyras" type="radio" value="Vyras"><br>
                                <label for="moteris" class="form-label">Moteris</label>
                                <input name="gender" id="moteris" type="radio" value="Moteris">
                            </div>

                            <div class="mb-3">
                                <label for="" class="form-label">Telefono nr.</label>
                                <input name="phone" type="number" class="form-control" value="<?= $employee['phone'] ?>" maxlength="12">
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Gimimo data</label>
                                <input name="birthday" type="date" class="form-control" value="<?= $employee['birthday'] ?>">
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Išsilavinimas</label>
                                <input name="education" type="text" class="form-control" value="<?= $employee['education'] ?>">
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Alga centais</label>
                                <input name="salary" type="number" class="form-control" value="<?= $employee['salary'] ?>">
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Pareigos</label>
                                <select class="form-control" name="position_id" id="">
                                    <?php foreach ($position as $pos) { ?>
                                        <option value="<?= $pos['id'] ?>"><?= $pos['name'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                      
                            <button class="btn btn-primary">Atnaujinti</button>
                            <a href="employee.php" class="btn btn-primary">Atgal</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>