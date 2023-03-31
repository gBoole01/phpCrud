<?php
require 'inc/connect.php';

$deleteResponseMessage = "";
if (isset($_GET['successDelete'])) {
    if ($_GET['successDelete'] == true) {
        $deleteResponseMessage = "L'étudiant a bien été supprimé";
    } else {
        $deleteResponseMessage = "Une erreur est survenue";
    }
}

$statement = "SELECT * FROM students";
$result = mysqli_query($conn, $statement);

include 'inc/header.php'
?>
<h1>Liste des étudiants</h1>
<div>
    <?= $deleteResponseMessage ?>
</div>
<div class="table-responsive">

    <table class="table">
        <thead>
            <tr>

                <th scope="col">ID</th>
                <th scope="col">Name</th>
                <th scope="col">Age</th>
                <th scope="col">School</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            while ($row = mysqli_fetch_assoc($result)) { ?>
                <tr>
                    <th scope="row">
                        <?= $row['id'] ?>
                    </th>
                    <td>
                        <?= $row['name'] ?>
                    </td>
                    <td>
                        <?= $row['age'] ?>
                    </td>
                    <td>
                        <?= $row['school'] ?>
                    </td>
                    <td>
                        <button class="btn btn-primary">
                            <a class="link-light text-decoration-none" href="/phpCrud/view.php?id=<?= $row['id'] ?>">Voir</a>
                        </button>
                        <button class="btn btn-warning">
                            <a class="link-light text-decoration-none" href="/phpCrud/edit.php?id=<?= $row['id'] ?>">Modifier</a>
                        </button>
                        <button class="btn btn-danger">
                            <a class="link-light text-decoration-none" href="/phpCrud/delete.php?id=<?= $row['id'] ?>">Supprimer</a>
                        </button>
                    </td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
</div>

<?php include('inc/footer.php'); ?>