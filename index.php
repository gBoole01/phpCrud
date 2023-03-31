<?php
require 'inc/connect.php';

$statement = "SELECT * FROM students";
$result = mysqli_query($conn, $statement);

include 'inc/header.php'
    ?>
<h1>PHP Crud</h1>
<a href="create.php">Ajouter un étudiant</a>
<div class="table-responsive">

    <table class="table">
        <thead>
            <tr>

                <th scope="col">ID</th>
                <th scope="col">Name</th>
                <th scope="col">Age</th>
                <th scope="col">School</th>
                <th scope="col">&nbsp;</th>
                <th scope="col">Actions</th>
                <th scope="col">&nbsp;</th>
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
                    <td><a href="/phpCrud/view.php?id=<?= $row['id'] ?>">Voir</a></td>
                    <td><a href="/phpCrud/edit.php?id=<?= $row['id'] ?>">Modifier</a></td>
                    <td><a href="/phpCrud/delete.php?id=<?= $row['id'] ?>">Supprimer</a></td>
                </tr>
                <?php
            }
            ?>
        </tbody>
    </table>
</div>

<?php include('inc/footer.php'); ?>