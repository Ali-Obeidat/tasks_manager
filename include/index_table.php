<div class="row search_container mt-2">
    <form action="" class="search col-lg-12" method="get">
        <div class="col-lg-3">
            <div class="mb-3">
                <label class="form-label">Task to find:</label>
                <input type="text" class="form-control" name="task">
            </div>
        </div>
        <div class="col-lg-3">
            <label class="form-label">Project</label>
            <select class="form-select" name="project" aria-label="Default select example">
                <option value="0">Please select object..</option>
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
            </select>
        </div>
        <div class="col-lg-2">
            <label for="exampleFormControlInput1" class="form-label">Add by:</label>
            <select class="form-select" name="user" aria-label="Default select example">
                <option value="0">Please select User..</option>
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

            </select>
        </div>
        <div class="col-lg-2" class="Completed_box">
            <label for="exampleFormControlInput1" class="form-label">Completed:</label>
            <div class="radio">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="complete" id="exampleRadios1" value="">
                    <label class="form-check-label" for="inlineRadio1">All</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="complete" id="exampleRadios1" value="1">
                    <label class="form-check-label" for="inlineRadio1">Yes</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="complete" id="exampleRadios1" value="0">
                    <label class="form-check-label" for="inlineRadio1">No</label>
                </div>
            </div>
        </div>
        <div class="col-lg-2">
            <br>
            <a href="index.php?Search=Search"><button class="btn btn-primary" value="Search" type="submit" name="Search">Search<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                        <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                    </svg></button></a>
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
                $query = "SELECT tasks.id, tasks.task, tasks.added_date,
            tasks.completed, projects.project_name,
            users.first_name, users.last_name
          FROM tasks
          JOIN users ON users.id = tasks.added_by
          JOIN projects ON projects.id = tasks.project_id ORDER BY tasks.id ASC;";
                $result = mysqli_query($connection, $query);
                while ($row = mysqli_fetch_assoc($result)) {
                ?>
                    <tr>
                        <td><?php echo $row['id'] ?></td>
                        <td><?php echo $row['task'] ?></td>
                        <td><?php echo $row['added_date'] ?></td>
                        <td><?php echo ($row['completed']) ?  "yes" :  "No" ?></td>
                        <td><?php echo $row['project_name'] ?></td>
                        <td><?php echo $row['first_name'] . " " . $row['last_name']  ?></td>
                        <td>
                            <input type="checkbox" value="<?php echo $row['id'] ?>" name="task_completed[]" <?php echo ($row['completed'] == 1) ? "disabled" :  "" ?> id="">
                        </td>
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