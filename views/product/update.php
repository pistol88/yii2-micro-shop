<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use dosamigos\grid\EditableColumn;

$this->title = Html::encode($model->name);
$this->params['breadcrumbs'][] = ['label' => 'Товар', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Обновить';
\pistol88\microshop\assets\BackendAsset::register($this);
?>

<div class="product-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
    
    <div>
        <h3>Доп. поля</h3>
        <?=\pistol88\field\widgets\Choice::widget(['model' => $model]);?>
    </div>
</div>
