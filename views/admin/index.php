<?php
/* @var $this yii\web\View
 * @var $usersList [] app\models\User
 */

use yii\helpers\Url;

?>

<h1>Users</h1>

<br>

<a href="<?php echo Url::to(['admin/create']); ?>" class="btn btn-success">Create new user</a>

<br><br>

<table class="table table-condensed">
    <tr>
        <th>ID</th>
        <th>Login</th>
        <th>Password</th>
        <th>Edit</th>
        <th>Delete</th>
    </tr>
    <?php foreach ($usersList as $user) : ?>
        <tr>
            <td><?php echo $user->id; ?></td>
            <td><?php echo $user->login; ?></td>
            <td><?php echo $user->password; ?></td>
            <td><a href="<?php echo Url::to(['admin/update', 'id' => $user->id]); ?>">Edit</a></td>
            <td><a href="<?php echo Url::to(['admin/delete', 'id' => $user->id]); ?>">Delete</a></td>
        </tr>
    <?php endforeach; ?>
</table>