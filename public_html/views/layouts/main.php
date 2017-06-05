<?php

/* @var $this \yii\web\View */
/* @var $content string */

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
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
	<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=latin,cyrillic' rel='stylesheet' type='text/css'>
</head>
<body>
<?php $this->beginBody()?>

<div class="wrap">
	<?php
	NavBar::begin([
		'brandLabel' => '',
		'brandUrl' => Yii::$app->homeUrl,
		'options' => [
			'class' => 'navbar navbar-fixed-top',
		],
	]);
	echo Nav::widget([
		'options' => ['class' => 'navbar-nav navbar-right'],
		'items' => [
			['label' => 'Главная', 'url' => ['/persons/index']],
			['label' => 'Гости', 'url' => ['/persons/allpersons']],
			['label' => 'Визиты', 'url' => ['/visits/index']],
			['label' => 'Абонементы', 'url' => ['/abonements/index']],
			['label' => 'Билеты', 'url' => ['/tickets/index']],
			['label' => 'Продажи', 'url' => ['/sells/index']],
			['label' => 'События', 'url' => ['product/index'], 'items' => [
				['label' => 'Даты', 'url' => ['/events/index']],
				['label' => 'События', 'url' => ['/biblioevents/index']],
				['label' => 'Категории', 'url' => ['/categoryevents/index']],
			]],
			['label' => 'Склад', 'url' => ['product/index'], 'items' => [
	            ['label' => 'Товары', 'url' => ['goods/index']],
	            // ['label' => 'Ингрeдиенты', 'url' => ['items/index']],
				['label' => 'Склад', 'url' => ['/buys/index']],
	        ]],
			['label' => 'Статистика', 'url' => ['/persons/statistics']],
			Yii::$app->user->isGuest ? (
				['label' => 'Login', 'url' => ['/site/login']]
			) : (
				'<li>'
				. Html::beginForm(['/site/logout'], 'post')
				. Html::submitButton(
					'Logout (' . Yii::$app->user->identity->username . ')',
					['class' => 'btn btn-link logout']
				)
				. Html::endForm()
				. '</li>'
			)
		],
	]);
	NavBar::end();
	?>

	<div class="container">
		<?= Breadcrumbs::widget([
			'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
		]) ?>
		<?= $content ?>
	</div>
</div>

<footer class="footer">
	<div class="container">
		<p class="pull-left">&copy; CRM GoodRepublic <?= date('Y') ?></p>

		<p class="pull-right"><a href="http://studiobaraban.ru/" target="_blank">Разработано в StudioBaraban</a></p>
	</div>
</footer>

<?php $this->endBody() ?>
<script src="/js/main.js"></script>
<script src="/js/stacktable.js"></script>

</body>
</html>
<?php $this->endPage() ?>
