<?php

/* @var $this \yii\web\View */
/* @var $content string */
use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="hold-transition skin-red sidebar-mini">
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => 'The Clothing Closet',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);

    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-left'],
        'items' => [
            (Yii::$app->user->isGuest || Yii::$app->user->identity->PrivilegeID == 3) ? (['label' => 'Men', 'url' => ['/users/men']]): '',
            (Yii::$app->user->isGuest || Yii::$app->user->identity->PrivilegeID == 3) ? (['label' => 'Women', 'url' => ['/users/women']]): '',
            (Yii::$app->user->isGuest || Yii::$app->user->identity->PrivilegeID == 3) ? (['label' => 'Kids', 'url' => ['/users/kids']]): '',
        ],
    ]);

    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [
            // ['label' => 'Home', 'url' => ['/site/index']],
            ['label' => 'About', 'url' => ['/site/about']],
            // ['label' => 'Contact', 'url' => ['/site/contact']],
            Yii::$app->user->isGuest ? (['label' => 'SignUp', 'url' => ['/site/signup']]) : '',
            Yii::$app->user->isGuest ? (
                ['label' => 'Login', 'url' => ['/site/login']]
            ) : (
                '<li>'
                . Html::beginForm(['/site/logout'], 'post', ['class' => 'navbar-form'])
                . Html::submitButton(
                    'Logout (' . Yii::$app->user->identity->UserName . ')',
                    ['class' => 'btn btn-link']
                )
                . Html::endForm()
                . '</li>'
            )
        ],
    ]);
    NavBar::end();
    ?>
    <?php if(Yii::$app->user->isGuest || Yii::$app->user->identity->PrivilegeID == 3): ?>
        <div class="container" style="max-width:1050px">
    <?php else: ?>
        <div class="container" style="margin-left:225px;max-width:1050px">
    <?php endif; ?>
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= $content ?>
    </div>
    <?= (!Yii::$app->user->isGuest && Yii::$app->user->identity->PrivilegeID != 3) ? $this->render('menu.php') : ''; ?>
</div>

<footer class="footer">
    <div class="container">
        <p style="margin-left:225px">&copy; Clothing Closet <?= date('Y'); ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
