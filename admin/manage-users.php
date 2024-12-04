<!DOCTYPE html>
<html lang="en">

<?php
include('../partials/head.php');

$permission = 'admin';
include('partials/permission.php');

// fetch users from db not us 
$current_admin_id = $_SESSION['user-id'];

$query = "SELECT * FROM users WHERE NOT id=$current_admin_id";
$users = mysqli_query($connection, $query);

?>

<body>
    <?php
    include('../partials/header.php');
    ?>
    <div class="website-wrapper">
        <main class="main-content section-wrapper">
            <div class="section-content-wide">
                <?php
                include('partials/messages-users.php');
                ?>
                <section class="dashboard">
                    <div class="container dashboard__container">
                        <?php
                        include('partials/side-menu.php');
                        ?>
                        <div class="dashboard-main">
                            <h2>Manage Users</h2>
                            <?php if (mysqli_num_rows($users) > 0): ?>
                                <table>
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Username</th>
                                            <th>Edit</th>
                                            <th>Delete</th>
                                            <th>Type</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php while ($user = mysqli_fetch_assoc($users)): ?>
                                            <tr>
                                                <td><?= "{$user['firstname']} {$user['lastname']}" ?></td>
                                                <td><?= $user['username'] ?></td>
                                                <td><a href="<?= WEBSITE_URL ?>admin/edit-user.php?id=<?= $user['id'] ?>"
                                                        class="btn sm">Edit</a></td>
                                                <td><a href="<?= WEBSITE_URL ?>admin/delete-user.php?id=<?= $user['id'] ?>"
                                                        class="btn sm danger">Delete</a></td>
                                                <?php if ($user['user_type'] == 2): ?>
                                                    <td>Admin</td>
                                                <?php elseif ($user['user_type'] == 1): ?>
                                                    <td>Author</td>
                                                <?php else: ?>
                                                    <td>User</td>
                                                <?php endif ?>
                                            </tr>
                                        <?php endwhile ?>
                                    </tbody>
                                </table>
                            <?php else: ?>
                                <div class="alert-msg error">No users found</div>
                            <?php endif ?>
                        </div>
                    </div>
                </section>
            </div>
        </main>
    </div>

    <?php
    include('../partials/scripts.php');
    ?>
</body>

</html>