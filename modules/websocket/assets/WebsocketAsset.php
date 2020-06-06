<?php

namespace app\modules\websocket\assets;

use yii\web\AssetBundle;

class WebsocketAsset extends AssetBundle
{
    public $sourcePath = '@app/modules/websocket/assets/';
    public $js = [
        'listListener.js'
    ];
    public $css = [
        'listListener.css'
    ];
}