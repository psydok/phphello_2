<?php
/* @var $this yii\web\View
 * @var $model \app\modules\user\models\User
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>

<h1>Update user #ID: <?php echo $model->id; ?></h1>

<?php $form = ActiveForm::begin(); ?>
    <?php echo $form->field($model, 'login'); ?>
    <?php echo $form->field($model, 'accessToken'); ?>
    <?php echo Html::submitButton('Save', [
        'class' => 'btn btn-primary'
    ]) ?>
<?php ActiveForm::end(); ?>
