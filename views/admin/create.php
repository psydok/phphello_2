<?php
/* @var $this yii\web\View
 * @var $model app\models\User
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>

<h1>Create new user</h1>
    <?php $form = ActiveForm::begin(); ?>
    <?php echo $form->field($model, 'login'); ?>
    <?php echo $form->field($model, 'password'); ?>

    <?php echo Html::submitButton('Save new user', [
        'class' => 'btn btn-primary'
    ]) ?>
<?php ActiveForm::end(); ?>
