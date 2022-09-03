<!-- Mini-Project Todo Lists using Crud operations -->
<?php include '_dbconnect.php'; ?>
<?php
// defining delete, update and insert false at initial
$insert = false;
$update = false;
$delete = false;
// delete data from inotes and database
if (isset($_GET['userid'])) {
    $id = $_GET['userid'];
    $delete = true;
    $sql = "DELETE FROM `notes`  WHERE `notes_id`= '$id'";
    $result = mysqli_query($conn, $sql);
}




// add note to database
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['snoEdit'])) {
        // Update the record;
        $title = $_POST["titleEdit"];
        $id = $_POST["snoEdit"];
        $description = $_POST["descriptionEdit"];

        // Sql query to be executed
        $sql = "UPDATE `notes` SET `notes_title` = '$title', `notes_desc` = '$description' WHERE `notes`.`notes_id` = '$id'";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            $update = true;
        }
    } else {
        $id = $_GET['userid'];
        // fetch data from form
        $title = $_POST['title'];
        $desc = $_POST['desc'];
        // add data to database
        $sql = "INSERT INTO `notes` (`notes_title`, `notes_desc`, `user_id`, `date`) VALUES ('$title', '$desc', '$id', current_timestamp())";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            $insert = true;
        }
    }
}



?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>iNotes</title>
    <link rel="stylesheet" href="//cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
    <script src="jquery-3.6.0.min.js"></script>
    <script src="//cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>

</head>

<body>


    <?php include '_navbar.php';

    if ($insert) {
        echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
        <strong>Success!</strong> Your response has been recorded successfully.
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
      </div>";
    }
    ?>

    <?php
    if ($update) {
        echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                <strong>Success!</strong> Your response has been updated successfully.
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
              </div>";
    }

    ?>
    <?php
    if ($delete) {
        echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                <strong>Success!</strong> Your response has been deleted successfully.
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
              </div>";
    }
    ?>
    <!-- Edit Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Note</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="index.php?userid=<?php echo $_GET['userid']; ?>" method="post">
                    <div class="modal-body">
                        <input type="hidden" name="snoEdit" id="snoEdit">
                        <h2>Update Note</h2>
                        <div class="mb-3">
                            <label for="title" class="form-label">Note Title</label>
                            <input type="text" class="form-control" id="titleEdit" name="titleEdit" aria-describedby="emailHelp">

                        </div>

                        <div class="mb-3">
                            <label for="desc" class="form-label">Description</label>
                            <textarea class="form-control" id="descriptionEdit" name="descriptionEdit" rows="3"></textarea>
                        </div>

                    </div>

                    <div class="modal-footer d-block mr-auto">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Update Note</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?php
    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
        echo '<!-- Add a note -->
    <div class="container my-4">
        <form action="index.php?userid=' . $_GET['userid'] . '" method="post">
            <h2>Add a Note</h2>
            <div class="mb-3">
                <label for="title" class="form-label">Note Title</label>
                <input type="text" class="form-control" id="title" name="title" aria-describedby="emailHelp">

            </div>

            <div class="mb-3">
                <label for="desc" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="desc" rows="3"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Add Note</button>
        </form>
    </div>';

        echo '
    <!-- View Notes -->
    <div class="container my-4">
        <table class="table " id="myTable">
            <thead>
                <tr>
                    <th scope="col">Sno.</th>
                    <th scope="col">Title</th>
                    <th scope="col" >Descriptions</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>';
        // view from notes database
        $id = $_GET['userid'];
        $sql = "SELECT * FROM `notes` WHERE `user_id` = '$id' ";
        $result = mysqli_query($conn, $sql);
        $sno = 0;
        while ($rows = mysqli_fetch_assoc($result)) {
            $sno++;
            echo
            "<tr>
                <th scope='row'>" . $sno . "</th>
                <td>" . $rows['notes_title'] . "</td>
                <td>" . $rows['notes_desc'] . "</td>
                <td><button class='edit btn btn-sm btn-primary' id=" . $rows['notes_id'] . "> Edit </button> <button class='delete btn btn-sm btn-primary' id=d" . $rows['notes_id'] . ">Delete</button></td>
            </tr>";
        }
        echo '</tbody>
        </table>
    </div>
    <hr>';
    } else {
        echo '<div class="jumbotron my-4 mx-4">
        <h1 class="display-4">!!Login!!</h1>
        <hr class="my-4">
        <p class="lead">Please login to write and view notes.</p>
        <button class="btn btn-primary btn-lg my-4" data-bs-toggle="modal"
        data-bs-target="#loginModal">Login</button>
        &nbsp;-OR-&nbsp;
        <button class="btn btn-primary btn-lg my-4 " data-bs-toggle="modal"
        data-bs-target="#signupModal">Register</button>
      </div>';
    }
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
    <script>
        $(document).ready(function() {
            $('#myTable').DataTable();
        });
    </script>
    <script>
        edits = document.getElementsByClassName('edit');
        Array.from(edits).forEach((element) => {
            element.addEventListener("click", (e) => {
                console.log("edit");
                tr = e.target.parentNode.parentNode;
                title = tr.getElementsByTagName("td")[0].innerText;
                description = tr.getElementsByTagName("td")[1].innerText;
                console.log(title, description);
                descriptionEdit.value = description;
                titleEdit.value = title;
                snoEdit.value = e.target.id;
                console.log(e.target.id);
                $('#editModal').modal('toggle');
            });
        });

        deletes = document.getElementsByClassName('delete');
        Array.from(deletes).forEach((element) => {
            element.addEventListener("click", (e) => {
                console.log("delete");
                sno = e.target.id.substr(1);



                if (confirm("Do You Really Want to delete Your Note?")) {
                    console.log("Yes");
                    window.location = `index.php?userid=${<?php echo $id;?>}&deleteId=${sno}`;

                    // TODO: create a from and use post request to submit a form 
                } else {
                    console.log("No");
                }

            });
        });
    </script>
</body>

</html>