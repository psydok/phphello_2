<?php


namespace app\modules\websocket\assets;


use yii\web\AssetBundle;

class VueAsset extends AssetBundle
{
    public $publishOptions = ['forceCopy' => true];
    public $sourcePath = '@app/vue/js';
    public $baseUrl = '@web';

    public function init()
    {
        parent::init();

        $this->js[] = YII_ENV === 'dev' ? 'app.js' : 'app.min.js';
    }

}