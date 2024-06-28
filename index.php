<?php
global $pdo;
include_once $_SERVER["DOCUMENT_ROOT"]."/connection_db.php";
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
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
</head>
<body>
    <div class="container">



        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Author</th>
                <th scope="col">Duration</th>
                <th scope="col">Year</th>
            </tr>
            </thead>
            <tbody>
            <?php
                $sql = "select * from tracks";
                foreach($pdo->query($sql) as $row)
                {
                    $id = $row['id'];
                    $name = $row['name'];
                    $author = $row['author'];
                    $duration = $row['duration'];
                    $year = $row['year'];

                    echo "
                    <tr>
                <th scope='row'>$id</th>
                <td>$name</td>
                <td>$author</td>
                <td>$duration</td>
                <td>$year</td>
                <td>
                    <button class='btn btn-danger' data-delete='${id}' >Delete</button>
                    <button class='btn btn-info' data-edit='${id}'>Edit</button>
                </td>
            </tr>
                ";
                }
            ?>
            </tbody>
        </table>
        <a class="btn btn-success" href="/create.php">Add</a>
    </div>
        <div class="modal" id="dialogDelete" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Accept</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Are you really going to remove this track fron list??</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-danger" id="dialogDeleteYes">Delete</button>
                    </div>
                </div>
            </div>
        </div>


        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const dialogDelete = new bootstrap.Modal("#dialogDelete");
                const dialogDeleteYes = document.getElementById("dialogDeleteYes");
                let deleteId=0;
                dialogDeleteYes.addEventListener("click", function () {
                    //console.log("Підтвердили видалення елемента", deleteId);
                    const headers = {
                        'Content-Type': 'multipart/form-data', // This header is set automatically by Axios when using FormData
                    };
                    axios.post("/delete.php", {
                        id: deleteId
                    }, { headers })
                        .then(resp => {
                            console.log("Delete is good");
                            window.location.reload(); // якщо запит успішний перегружаємо сторінку і запис зникне із таблиці
                        });
                    //dialogDelete.hide();
                });

                // Select all elements with the data-delete attribute
                const deleteButtons = document.querySelectorAll('[data-delete]');


                // Attach a click event listener to each button
                deleteButtons.forEach(button => {
                    button.addEventListener('click', function(event) {
                        // Get the value of the data-delete attribute
                        const deleteValue = event.target.getAttribute('data-delete');
                        console.log(`Delete item with ID: ${deleteValue}`);
                        deleteId = deleteValue;
                        dialogDelete.show();
                        // Add your delete logic here
                    });
                });
            });
        </script>


</body>
</html>