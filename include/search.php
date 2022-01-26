<?php
if (isset($_GET['Search'])) {
    // filter_has_var(INPUT_GET, 'complete')
    ($_GET['task']) ? $task = $_GET['task'] : $task = "";
    ($_GET['project']) ? $project_search_id = "AND projects.id = '{$_GET['project']}'"  : $project_search_id = "";
    ($_GET['user']) ? $user_search_id = "AND users.id = '{$_GET['user']}'" : $user_search_id = "";

    // echo $_GET['complete'];
    if (@(!empty($_GET['complete']) || $_GET['complete'] == '0')) {
        echo $_GET['complete'];
        if ($_GET['complete'] == 1) {
            echo $_GET['complete'];
            $complete = "AND tasks.completed = '{$_GET['complete']}'";
            // echo $complete;
        } elseif ($_GET['complete'] == 0) {
            echo $_GET['complete'];
            $complete = "AND tasks.completed = '{$_GET['complete']}'";
        } else {
            $complete = "";
        }

        echo $complete;
    } else {
        $complete = "";
    }
}
?>
<div class="row search_container mt-2">
    <form action="" class="search" method="get">
        <div class="col">
            <div class="mb-3">
                <label class="form-label">Task to find:</label>
                <input type="text" class="form-control" value="<?php echo $task ?>" name="task">
            </div>
        </div>
        <div class="col">
            <label class="form-label">Project</label>
            <select class="form-select" name="project" aria-label="Default select example">
                <?php
                if (!empty($project_search_id)) {
                    $query = "SELECT * FROM projects WHERE id = '{$_GET['project']}'";
                    $select_project = mysqli_query($connection, $query);
                    $row_project = mysqli_fetch_assoc($select_project);
                ?>
                    <option value="<?php echo $row_project['id'] ?>"><?php echo $row_project['project_name'] ?></option>
                    <option value="0">Please select object..</option>
                    <?php
                    $query = "SELECT * FROM projects ";
                    $result = mysqli_query($connection, $query);
                    while ($row = mysqli_fetch_assoc($result)) {
                        $project_id = $row['id'];
                        $project_name = $row['project_name'];
                        if ($project_id == $_GET['project']) {
                            continue;
                        }
                    ?>
                        <option value="<?php echo $project_id  ?>"> <?php echo $project_name ?></option>
                    <?php
                    }
                } else { ?>
                    <option value="">Please select object..</option>
                    <?php
                    $query = "SELECT * FROM projects ";
                    $select_categories = mysqli_query($connection, $query);
                    while ($row = mysqli_fetch_assoc($select_categories)) {
                        $project_id = $row['id'];
                        $project_name = $row['project_name'];
                    ?>
                        <option value="<?php echo $project_id  ?>"> <?php echo $project_name ?></option>
                    <?php
                    }
                    ?>
                <?php }
                ?>

            </select>
        </div>
        <div class="col">
            <label for="exampleFormControlInput1" class="form-label">Add by:</label>
            <select class="form-select" name="user" aria-label="Default select example">

                <?php
                if (!empty($user_search_id)) {
                    $query = "SELECT * FROM users WHERE id = '{$_GET['user']}'";
                    $select_user = mysqli_query($connection, $query);
                    $row_user = mysqli_fetch_assoc($select_user);
                ?>
                    <option value="<?php echo $row_user['id'] ?>"> <?php echo $row_user['first_name'] . " " . $row_user['last_name'] ?></option>
                    <option value="">Please select user..</option>
                    <?php
                    $query = "SELECT * FROM users ";
                    $select_categories = mysqli_query($connection, $query);
                    while ($data = mysqli_fetch_assoc($select_categories)) {
                        $user_id = $data['id'];
                        $user_name = $data['first_name'] . " " . $data['last_name'];
                        if ($user_id == $_GET['user']) {
                            continue;
                        }
                    ?>

                        <option value="<?php echo $user_id  ?>"> <?php echo $user_name ?></option>
                    <?php
                    }
                } else {
                    ?>
                    <option value="">Please select User..</option>
                    <?php
                    $query = "SELECT * FROM users ";
                    $result = mysqli_query($connection, $query);
                    while ($row = mysqli_fetch_assoc($result)) {
                        $user_id = $row['id'];
                        $user_name = $row['first_name'] . " " . $row['last_name'];
                    ?>
                        <option value="<?php echo $user_id  ?>"> <?php echo $user_name ?></option>
                    <?php
                    }
                    ?>
                <?php
                }
                ?>


            </select>
        </div>
        <div class="col" class="Completed_box">
            <label for="exampleFormControlInput1" class="form-label">Completed:</label>
            <div class="radio">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" <?php echo (empty($_GET['complete'])) ? "checked" : "" ?> type="radio" name="complete" id="exampleRadios1" value="">
                    <label class="form-check-label" for="inlineRadio1">All</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" <?php echo (isset($_GET['complete']) && $_GET['complete'] == 1) ? "checked" : "" ?> type="radio" name="complete" id="exampleRadios1" value="1">
                    <label class="form-check-label" for="inlineRadio1">Yes</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" <?php echo (isset($_GET['complete']) && $_GET['complete'] == 0) ? "checked" : "" ?> type="radio" name="complete" id="exampleRadios1" value="0">
                    <label class="form-check-label" for="inlineRadio1">No</label>
                </div>
            </div>
        </div>
        <div class="col">
            <br>
            <button class="btn btn-primary" value="Search" type="submit" name="Search">Search<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                </svg></button>
            <a href="index.php?status=logout"> <button type="button" class="btn btn-dark">LogOut</button> </></a>
        </div>
    </form>
</div>
<div>
    <form action="" method="post">
        <table id="example" class="table table-striped" style="width:100%">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Task</th>
                    <th>Add Date</th>
                    <th>completed</th>
                    <th>Project Name</th>
                    <th>Add by </th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php
                $query = "SELECT tasks.id , tasks.task, tasks.added_date,
            tasks.completed, projects.project_name,
            users.first_name, users.last_name FROM tasks
          JOIN users ON users.id = tasks.added_by
          JOIN projects ON projects.id = tasks.project_id  WHERE tasks.task LIKE '%$task%'
         {$project_search_id} {$user_search_id} {$complete} ORDER BY tasks.id ASC ;";
                $result = mysqli_query($connection, $query);
                confirmQuery($result);
                while ($row_search = mysqli_fetch_assoc($result)) {

                ?>
                    <tr>
                        <td><?php echo $row_search['id'] ?></td>
                        <td><?php echo $row_search['task'] ?></td>
                        <td><?php echo $row_search['added_date'] ?></td>
                        <td><?php echo ($row_search['completed']) ?  "yes" :  "No" ?></td>
                        <td><?php echo $row_search['project_name'] ?></td>
                        <td><?php echo $row_search['first_name'] . " " . $row_search['last_name']  ?></td>
                        <td> <input value="<?php echo $row_search['id'] ?>" type="checkbox" name="task_completed[]" <?php echo ($row_search['completed'] == 1) ? "disabled" :  "" ?>> </td>
                    </tr>
                <?php } ?>
            </tbody>
            <tfoot>
                <tr>
                    <th>ID</th>
                    <th>Task</th>
                    <th>Add Date</th>
                    <th>completed</th>
                    <th>Project Name</th>
                    <th>Add by </th>
                    <th></th>
                </tr>
            </tfoot>
        </table>

        <button type="submit" name="Save_as_completed" class="btn btn-primary btn-block mt-2">Save as completed</button>
    </form>
</div>