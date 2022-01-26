<?php include 'include/db_Connection.php' ?>
<?php include 'include/functions.php' ?>
<?php include 'include/header.php' ?>
<?php checkUserLogin(); ?>

<?php saveAsCompleted() ?>
<div class="container">
    <?php
    if (isset($_GET['Search'])) {
        $Search = $_GET['Search'];
    } else {
        $Search = "";
    }

    switch ($Search) {
        case "Search":
            include "include/search.php";
            break;
        default:

            include "include/index_table.php";
    } ?>
</div>
<?php include 'include/footer.php' ?>