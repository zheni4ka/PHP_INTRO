<?php
    if($_SERVER["REQUEST_METHOD"]=="POST") {
        include_once $_SERVER["DOCUMENT_ROOT"]."/connection_db.php";

        $name = $_POST['name'];
        $author = $_POST['author'];
        $duration = $_POST['duration'];
        $year = $_POST['year'];

        $sql = 'INSERT INTO tracks (name, author, duration, year) VALUES (:name, :author, :duration, :year)';
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['name' => $name, 'author' => $author, 'duration' => $duration, 'year' => $year]);
        header('Location: /');
        exit();
    }

    ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>
<body>
    <main>
        <div class="container">
            <form method="post">
            <input type="text" id="name" name="name" class="form-control" placeholder="Name" aria-label="Name" aria-describedby="basic-addon1">
            <input type="text" id="author" name="author" class="form-control" placeholder="Author" aria-label="Author" aria-describedby="basic-addon1">
            <input type="time" id="duration" name="duration" class="form-control">
            <input type="number" id="year" name="year" class="form-control">
            <div class="d-flex justify-content-center">
                <button type="submit" class="btn btn-success me-2">Create</button>
            </div>
            </form>
        </div>
    </main>
</body>
</html>