<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Visits */

$this->title = 'Завершить визит '.$model->id;
$this->params['breadcrumbs'][] = ['label' => 'Visits', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>



<div class="visit">
	<h1>160р</h1>
	<div class="discont">Скидка <input type="text" name=""></div>
	<h2>Иванов Иван Николаевич</h2>
	<div class="row">
		<p class="col-xs-12 col-sm-2">id 105</p>
		<p class="col-xs-12 col-sm-2">VIP Резидент</p>
		<p class="col-xs-12 col-sm-2">1.05.1980</p>
		<p class="col-xs-12 col-sm-2">ivanov@mail.ru</p>
		<p class="col-xs-12 col-sm-2">+79118787654</p>
		<p class="col-xs-12 col-sm-2">мужчина 25 лет</p>
	</div>

	<div class="line"></div>


	<div class="row">
		<div class="col-xs-12 col-sm-4">
			<p class="big"><span>с</span> 12:20</p>
		</div>
		<div class="col-xs-12 col-sm-4">
			<p class="big"><span>по</span> 14:40</p>
		</div>
		<div class="col-xs-12 col-sm-4">
			<p class="big">2 <span>часа</span> 20 <span>минут</span></p>
		</div>     
	</div>

	<div class="line"></div>

	<h2>Покупки</h2>
	<div class="row">
		<div class="col-xs-12 col-sm-3">
			<p>Наименование</p>
		</div>
		<div class="col-xs-12 col-sm-3">
			<p>Кол-во</p>
		</div> 
		<div class="col-xs-12 col-sm-3">
			<p>Цена</p>
		</div> 
		<div class="col-xs-12 col-sm-3">
			<p>Сумма</p>
		</div>     
	</div>

	<div class="line"></div>

	<h2>До-продажа</h2>
	<div class="row">
		<div class="col-xs-12 col-sm-3"><p>Наименование</p></div>
		<div class="col-xs-12 col-sm-3"><p>Кол-во</p></div> 
		<div class="col-xs-12 col-sm-3"><p>Цена</p></div> 
		<div class="col-xs-12 col-sm-3"><p>Сумма</p></div>     
	</div>
	
	<div class="row">
		<div class="col-xs-12 col-sm-3">
			<select placeholder="Наименование">
				<option>Чай в пакетике</option>
				<option>Чай заворной</option>
				<option>ЧКофе латте</option>
			</select>
		</div>
		<div class="col-xs-12 col-sm-3"><input type="text" name="" placeholder="Кол-во" /></div> 
		<div class="col-xs-12 col-sm-3"></div> 
		<div class="col-xs-12 col-sm-3"></div>     
	</div>
	
	<div class="row">
		<div class="col-xs-12 col-sm-3"><input type="text" name="" placeholder="Наименование" /></div>
		<div class="col-xs-12 col-sm-3"><input type="text" name="" placeholder="Кол-во" /></div> 
		<div class="col-xs-12 col-sm-3"><input type="text" name="" placeholder="Цена" /></div> 
		<div class="col-xs-12 col-sm-3"><input type="text" name="" placeholder="Сумма" /></div>     
	</div>




	<div class="mt50"></div>

	<div class="row">
		<div class="col-xs-12 col-sm-3"> <a href="" class="btn btn_grey">Ой, ничего не делать</a></div>
		<div class="col-xs-12 col-sm-3"> <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn_grey']) ?></div> 
		<div class="col-xs-12 col-sm-3"> <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
			'class' => 'btn btn-danger',
			'data' => [
			'confirm' => 'Are you sure you want to delete this item?',
			'method' => 'post',
			],
			]) ?></div> 
		<div class="col-xs-12 col-sm-3"> <a href="" class="btn btn-primary">Да, завершить визит</a></div>   
	</div>




</div>




<!--div class="visits-view">

	<h1><?= Html::encode($this->title) ?></h1>


		<?= DetailView::widget([
			'model' => $model,
			'attributes' => [
			'id',
			'user_id',
			'start',
			'end',
			'money',
			],
			]) ?>

</div-->
