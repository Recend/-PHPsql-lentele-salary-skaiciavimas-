<?php

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}



if ($_SERVER["REQUEST_METHOD"] == "POST") {
}
include("database.php");
$error = [];
if (isset($_POST['action']) && $_POST['action'] == 'insert') {
    $name = test_input($_POST["name"]);
    $surname = test_input($_POST["surname"]);
    // $gender = test_input($_POST["gender"]);
    $phone = test_input($_POST["phone"]);
    $birthday = test_input($_POST["birthday"]);
    $education = test_input($_POST["education"]);
    $salary = test_input($_POST["salary"]);
    if (empty($name)) {
        $error['vardas'] = "Vardo įvedimas privalomas";
    } else {
        if (strlen($name) < 3) {
            $error['vardas'] = "Jūsų vardas per trumpas";
        }
    }

    if (empty($surname)) {
        $error['pavarde'] = "Pavardės įvedimas privalomas";
    } else {
        if (strlen($surname) < 3) {
            $error['pavarde'] = "Jūsų pavardė per trumpa";
        }
    }

    if (empty($phone)) {
        $phone = null;
    }
    if (empty($birthday)) {
        $phone = null;
    }
    if (empty($education)) {
        $phone = null;
    }
    if (empty($salary)) {
        $phone = null;
    }




    if (empty($error)) {
        $sql = "INSERT INTO employees (name, surname, gender, phone, birthday, education, salary) VALUES (?, ?, ?, ?, ?, ? ,?)";
        $stm = $pdo->prepare($sql);
        $stm->execute([$_POST['name'], $_POST['surname'], $_POST['gender'], $phone, $birthday, $education, $salary]);
        header("location:employee.php");
        die();
    }
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
                    <div class="card-header">Prideti nauja sali</div>
                    <div class="card-body">
                        <form action="" method="POST">
                            <input type="hidden" name="action" value="insert">
                            <div class="mb-3">
                                <label for="" class="form-label">Vardas</label>
                                <input name="name" type="text" class="form-control">
                                <span><?php if (isset($error['vardas'])) {
                                            echo  $error['vardas'];
                                        } ?></span>
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Pavardė</label>
                                <input name="surname" type="text" class="form-control">
                                <span><?php if (isset($error['pavarde'])) {
                                            echo  $error['pavarde'];
                                        } ?></span>
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
                                <input name="phone" type="number" class="form-control" maxlength="12">

                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Gimimo Data</label>
                                <input name="birthday" type="date" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Išsilavinimas</label>
                                <input name="education" type="text" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Alga centais</label>
                                <input name="salary" type="number" class="form-control">
                            </div>
                            <button class="btn btn-primary">Prideti</button>
                            <a href="employee.php" class="btn btn-primary">Atgal</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>