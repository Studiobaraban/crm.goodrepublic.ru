<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use app\models\Goods;
use app\models\Items;

/* @var $this yii\web\View */
/* @var $model app\models\Ingredients */

// $this->title = 'Update Ingredients: ' . $model->id;
// $this->params['breadcrumbs'][] = ['label' => 'Ingredients', 'url' => ['index']];
// $this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
// $this->params['breadcrumbs'][] = 'Update';
?>


<h1>Обновить</h1>



<?php
$form = ActiveForm::begin();

$goods = Goods::find()->all();
$good = ArrayHelper::map($goods,'id','name');
$params = [
'prompt' => 'Выберите...'
];
echo $form->field($model, 'good_id')->dropDownList($good,$params);


$items = Items::find()->all();
$item = ArrayHelper::map($items,'id','name');
$params = [
'prompt' => 'Выберите...'
];
echo $form->field($model, 'item_id')->dropDownList($item,$params);


echo $form->field($model, 'count')->textInput();

echo $form->field($model, 'info')->textarea(['rows' => 6]) ?>

<div class="form-group">
	<?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
</div>

<?php ActiveForm::end(); ?>

