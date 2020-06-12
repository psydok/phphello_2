<?php

/* @var $this \yii\web\View */
/* @var $content string*/

use app\modules\websocket\assets\VueAsset;
use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use app\assets\AppAsset;
use yii\widgets\Breadcrumbs;

AppAsset::register($this);
VueAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => Yii::$app->name,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    $menuItem = [
        ['label' => 'Home', 'url' => ['/site/index']],
//        ['label' => 'About', 'url' => ['/site/about']],
//        ['label' => 'Contact', 'url' => ['/site/contact']],
        ['label' => 'List telemetries', 'url' => ['/metric/show/list']],
        ['label' => 'WebSocket', 'url' => ['/websocket/list/index']],
    ];

    if (!Yii::$app->user->isGuest){
        $menuItem[] = ['label' => 'Users', 'url' => ['/admin/admin/index']];
        $menuItem[] = ['label' => 'API XML ', 'url' => ['/api/metrics']];
        $menuItem[] = '<li>'
            . Html::beginForm(['/user/user/logout'], 'post')
            . Html::submitButton(
                'Logout (' . Yii::$app->user->identity->login . ')',
                ['class' => 'btn btn-link logout']
            )
            . Html::endForm()
            . '</li>';
    }

    if (Yii::$app->user->isGuest){
        $menuItem[] = ['label' => 'Login', 'url' => ['/user/user/login']];
        $menuItem[] = ['label' => 'Signup', 'url' => ['/user/user/signup']];
    }

    echo Nav::widget([
             'options' => ['class' => 'navbar-nav navbar-right'],
             'items' => $menuItem,
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <div id="app">
            Загрузка...
        </div>
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>

    </div>
</div>
<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; My Company <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
