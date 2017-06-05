<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

?>


<h1>Иванов Иван Николаевич <span><?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn_lite']) ?></span></h1>


<div class="row">
	<div class="col-xs-12 col-sm-6 col-lg-4">
		<img src="/images/guest.png" class="img-responsive user">
	</div>
	<div class="col-xs-12 col-sm-6 col-lg-4">
		<div class="blocks">
			<h2>Инфо <span>105</span></h2>
			<p><b>Статус</b> VIP Резидент</p>
			<p><b>Дата рождения</b> 1.05.1980</p>
			<p><b>E-mail</b> ivanov@mail.ru</p>
			<p><b>Телефон</b> +79118787654</p>
			<p>мужчина 25 лет</p>
			<p>Группы: джаз, кино</p>
		</div>
	</div>
	<div class="col-xs-12 col-sm-6 col-lg-4">
		<div class="blocks">
			<h2>Пожелания</h2>
			<p>Хочу шоколада и мармелада и маленьких утят</p>
			<p>И все из анкеты........</p>
		</div>
	</div>

	<div class="clear"></div>

	<div class="col-xs-12 col-sm-6 ">
		<div class="blocks">
			<h2>Визиты <span>5 визитов,</span><span>на 4:20</span></h2>
			<p>12.10 '16 в 12:36   120 минут</p>
			<p>12.10 '16 в 12:36   120 минут</p>
			<p>12.10 '16 в 12:36   120 минут</p>
			<p>12.10 '16 в 12:36   120 минут</p>
			<p>12.10 '16 в 12:36   120 минут</p>
			<p>12.10 '16 в 12:36   120 минут</p>
			<p>12.10 '16 в 12:36   120 минут</p>
			<p>12.10 '16 в 12:36   120 минут</p>
			<p>12.10 '16 в 12:36   120 минут</p>
			<p>12.10 '16 в 12:36   120 минут</p>
			<p>12.10 '16 в 12:36   120 минут</p>
			<p>12.10 '16 в 12:36   120 минут</p>
			<p>12.10 '16 в 12:36   120 минут</p>
			<p>12.10 '16 в 12:36   120 минут</p>
			<p>12.10 '16 в 12:36   120 минут</p>
			<p>12.10 '16 в 12:36   120 минут</p>
			<p>12.10 '16 в 12:36   120 минут</p>
			<p>12.10 '16 в 12:36   120 минут</p>
			<p>12.10 '16 в 12:36   120 минут</p>
			<p>12.10 '16 в 12:36   120 минут</p>
			<p>12.10 '16 в 12:36   120 минут</p>
			<p>12.10 '16 в 12:36   120 минут</p>
		</div>
	</div>
	<div class="col-xs-12 col-sm-6">
		<div class="blocks">
			<h2>Покупки <span>12шт,</span><span>на 650р</span></h2>
			<p>12.10 '16 чай 1шт 80р</p>
			<p>12.10 '16 чай 1шт 80р</p>
			<p>12.10 '16 чай 1шт 80р</p>
		</div>
	</div>
</div>











<!--div class="persons-view">

	<h1><?= Html::encode($this->title) ?></h1>

	<p>
		<?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
		<?= Html::a('Delete', ['delete', 'id' => $model->id], [
			'class' => 'btn btn-danger',
			'data' => [
				'confirm' => 'Are you sure you want to delete this item?',
				'method' => 'post',
			],
		]) ?>
	</p>

	<?= DetailView::widget([
		'model' => $model,
		'attributes' => [
			'id',
			'name',
			'second_name',
			'middle_name',
			'mail',
			'phone',
			'status',
			'inside',
		],
	]) ?>

</div-->



