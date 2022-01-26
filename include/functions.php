<?php
//function to check confirmQuery
function confirmQuery($result)
{
    global $connection;
    if (!$result) {
        die("QUERY FAILED ." . mysqli_error($connection));
    }
}
//function to check if the user logged in or not
function checkUserLogin()
{
    if (!isset($_SESSION['userLogin'])) {
        header("location: login.php");
    }
}
//function to check if the username or email and password are correct
function LoginFunction()
{
    global $connection, $errors;
    if (isset($_POST['loginSubmit'])) {
        $user = $_POST['nameOrEmail'];
        $password = $_POST['password'];
        $hashedPass = hash('sha256', $password);
        // var_dump($hashedPass);
        // die();
        if (trim($_POST['nameOrEmail']) == "" || trim($_POST['password'] == "")) {
            $errors = "Please Enter yor Email/user name and password ";
        } else {
            // For Users
            $query  = "SELECT * FROM users where (email = '{$user}' Or username= '{$user}') AND password = '{$hashedPass}'";
            $result = mysqli_query($connection, $query);
            confirmQuery($result);
            $row    = mysqli_fetch_assoc($result);
            $count = mysqli_num_rows($result);
            if ($count == 1) {
                $sql = "UPDATE users SET last_login = NOW() where id = '{$row["id"]}' ";
                mysqli_query($connection, $sql);
                $_SESSION['userLogin'] = $row['id'];
                header("location:index.php");
                die();
            }
            $errors = "The email or password is not correct";
        }
    }
}
// to update completed from No to Yes
function saveAsCompleted()
{
    global $connection;
    if (isset($_POST['Save_as_completed'])) {
        $values = implode("','", $_POST['task_completed']);
        $sql = "UPDATE tasks SET completed ='1' WHERE id IN ('" . $values . "') ";
        $result =    mysqli_query($connection, $sql);
        confirmQuery($result);
    }
}

function logOut()
{
    if (isset($_GET['status']) && $_GET['status'] == 'logout') {
        unset($_SESSION['userLogin']);
        header("Location: index.php");
    }
}
