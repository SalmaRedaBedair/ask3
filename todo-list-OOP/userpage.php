<?php include_once('partials/menu.php');
require_once('submit.php');
$user_id = $_SESSION['id'];
$data = $conn->getById('user', $user_id);
$rows = $conn->getData('task', 'start_date', "user_id=$user_id"); // print_r($rows); // die(); ?>

<body>
    <div class="menu text-center">
        <div class="wrapper"> <a href="index.php" class="home-icon"> <i class="fas fa-home"></i> </a> </div>
    </div>

    <div class="main-content">
        <div class="wrapper">
            <h1>Welcome <?= ucwords($data['name']) ?> ❤️</h1>
            <br>
            <br>
            <a href="add_task.php" class="btn btn-primary">Add Task</a>
            <br>
            <br>
            <h2><u>My tasks:</u></h2>
            <form id='my-form' action="" method="post">
                <table>

                    <?php
                    foreach ($rows as $row) {
                        ?>
                        <div class="task">
                            <tr>
                                <td>
                                    <input type="hidden" name="id-<?= $row['id'] ?>" value="<?= $row['id'] ?>">
                                    <input class="status" type="hidden" name="status-<?= $row['id'] ?>" value="<?= $row['status'] ?>">
                                    <input class="checkbox" type="checkbox" id="checkbox-<?= $row['id'] ?>" data-task-id="<?= $row['id'] ?>" <?php
                                      if ($row['status'] == 'done')
                                          echo 'checked' ?>>

                                </td>
                                <td>
                                    <label for="checkbox-<?= $row['id'] ?>" class="<?php
                                      if ($row['status'] == 'done')
                                          echo 'deleted-text';
                                      else if ($row['status'] == 'not started')
                                          echo 'not-started';
                                      else if ($row['status'] == 'time out')
                                          echo 'time-out';
                                      ?>"> <?= $row['name'] ?></label>
                                </td>
                                <td>
                                    <a href="delete.php?id=<?= $row['id'] ?>" class="btn btn-danger">Delete</a>
                                    <a href="update.php?id=<?= $row['id'] ?>" class="btn btn-primary">Update</a>
                                </td>
                            </tr>
                            <br>
                        </div>
                        <?php
                    }
                    ?>

                </table>
                <input type="submit" class='btn btn-secondary' value='save' name='submit'>
            </form>
        </div>
    </div>

    <?php
    include_once('partials/footer.php');
    if (isset($_POST['submit'])) {
        print_r($_POST);
        die;
        foreach ($_POST as $key => $value) {
            if ($key[0] == 'i' && $key[1] == 'd') {
                $data = array('id' => $value, 'status' => $_POST["status-$value"]);
                $conn->updateTask($data);
            }
        }
    }
    ?>