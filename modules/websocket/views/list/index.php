<?php
/**
 * @var $this yii\web\View
 */
use app\modules\websocket\assets\WebsocketAsset;
WebsocketAsset::register($this);
$this->title = 'List of metrics';
$this->params['breadcrumbs'][] = $this->title;
?>

<h1>List of metrics</h1>
<br>
<label>
    <input type="text" name="message">
</label>

<ul id="messages">

</ul>