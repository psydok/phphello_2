<?php
/* @var $this yii\web\View
 * @var $dataProvider \yii\data\ActiveDataProvider
 */

use yii\grid\GridView;

$this->title = 'API Telemetries';
$this->params['breadcrumbs'][] = $this->title;
?>
<h1>API Telemetries</h1>
<br>
<?php echo GridView::widget([
    'dataProvider' => $dataProvider,
]);
?>
