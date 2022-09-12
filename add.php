 <?php
    include('database.php');



    if (isset($_POST['action'])) {
        $sql = "INSERT INTO bendra (employee_id, project_id) VALUES (?, ?)";
        $stm = $pdo->prepare($sql);
        $stm->execute([$_GET['id'], $_POST['project_id']]);
        header('location:employee.php');
        die();
    }


    if (isset($_GET['id'])) {
        $sql = "SELECT * FROM projects";
        $stm = $pdo->prepare($sql);
        $stm->execute([]);
        $projects = $stm->fetchAll(PDO::FETCH_ASSOC);
    } else {
        header('location:employee.php');
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
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous">
     </script>
     <title>Document</title>

 </head>

 <body>
    <div class="container">
        <div class="card col-5 mx-auto mt-5 ">
     <form action="" method="post">
         <input type="hidden" name="action" value="update">
         <div class="mb-3">
             <label for="" class="form-label">Projektas</label>
             <select class="form-control" name="project_id" id="">
                 <?php foreach ($projects as $project) { ?>
                     <option value="<?= $project['id'] ?>"><?= $project['name'] ?></option>
                 <?php } ?>
             </select>
             <button class="btn btn-success mt-3">Prideti</button>
             <a href="employee.php" class="btn btn-success float-end mt-3">Atgal</a>
         </div>
     </form>
     </div>
     </div>
 </body>

 </html>