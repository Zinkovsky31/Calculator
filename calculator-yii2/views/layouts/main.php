<?php

/** @var yii\web\View $this */
/** @var string $content */

use app\assets\AppAsset;
use app\widgets\Alert;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;

AppAsset::register($this);

$this->registerCsrfMetaTags();
$this->registerMetaTag(['charset' => Yii::$app->charset], 'charset');
$this->registerMetaTag(['name' => 'viewport', 'content' => 'width=device-width, initial-scale=1, shrink-to-fit=no']);
$this->registerMetaTag(['name' => 'description', 'content' => $this->params['meta_description'] ?? '']);
$this->registerMetaTag(['name' => 'keywords', 'content' => $this->params['meta_keywords'] ?? '']);
$this->registerLinkTag(['rel' => 'icon', 'type' => 'image/x-icon', 'href' => Yii::getAlias('@web/favicon.ico')]);


$menuItems = [];
?>

<?php $this->beginPage() ?>

<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
<head>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>

    <?php
    $js = <<<JS
    $(document).on('click', '.alert .close', function () {
        $(this).parent().fadeOut('slow');
        $.ajax({
            url: 'actionHideNotification',
            type: 'post',
            data: {hideNotification: true},
            success: function(response) {
            }
        });
    });
    JS;
    $this->registerJs($js);
    ?>
</head>
<body class="d-flex flex-column h-100">

<?php if (!Yii::$app->user->isGuest): ?>
    <?php $username = Yii::$app->session->getFlash('user-name'); ?>
    <?php if ($username): ?>
        
    <?php endif; ?>
<?php endif; ?>



<?php if (Yii::$app->session->hasFlash('show-notification') && !Yii::$app->session->hasFlash('hide-notification')): ?>

<?php
$username = Yii::$app->session->getFlash('user-name');
$notificationMessage = "Здравствуйте, $username, вы авторизовались в системе расчета стоимости доставки. Теперь все ваши расчеты будут сохранены для последующего просмотра в журнале расчетов.";
?>
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <?= $notificationMessage ?>
    <a href="<?= Yii::$app->urlManager->createUrl(['history/index']) ?>" class="alert-link">Просмотреть журнал расчетов</a>.
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<?php endif; ?>
<?php $this->beginBody() ?>

<header id="header">
    <?php
    NavBar::begin([ 
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar navbar-expand-lg navbar-dark bg-dark', 
        ],
        
    ]);
   

    $menuItems = [];

    if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => 'Войти в систему', 'url' => ['/user/login']];
        
    } else {
        $user = Yii::$app->user->identity; 
        
    
        if ($user && $user->name) {
            $menuItems[] = [
                'label' => $user->name,
                'items' => [
                    ['label' => 'Профиль', 'url' => ['/user/profile']],
                    ['label' => 'История расчетов', 'url' => ['/history/index']],
                    ['label' => 'Пользователи', 'url' => ['/user/admin']],
                    ['label' => 'Калькулятор', 'url' => ['/site/index']],
                    
                    [
                        'label' => 'Выход',
                        'url' => ['/user/logout'],
                        'linkOptions' => ['data-method' => 'post'],
                    ],
                ],
            ];
        } else {
            $menuItems[] = [
                'label' => 'Войти в систему', 'url' => ['/user/login'],
                'label' => 'Калькулятор', 'url' => ['/site/index']
            ];
        }
    }
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav ml-auto'],
        'items' => $menuItems,
    ]);
    
    NavBar::end();
    ?>
</header>

<main id="main" class="flex-shrink-0" role="main">
    <div class="container">
        <?php if (!empty($this->params['breadcrumbs'])): ?>
            <?= Breadcrumbs::widget(['links' => $this->params['breadcrumbs']]) ?>
        <?php endif ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</main>

<footer id="footer" class="mt-auto py-3 bg-light">
    <div class="container">
        <div class="row text-muted">
            <div class="col-md-6 text-center text-md-start">&copy; ЭФКО Стартер <?= date('Y') ?></div>
            
    <div class="container">
        <div class="col-md-6 text-center text-md-start">
             <a href="https://t.me/Aleksandrowwicz">Telegram</a> 
        </div>
        <div class="col-md-6 text-center text-md-start">
             <a href="https://github.com/Zinkovsky31?tab=repositories">GitHub</a>
        </div> 

    </div>

        </div>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>



