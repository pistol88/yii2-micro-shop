<?php
use yii\helpers\Html;

$this->title = 'Добавить товар';
$this->params['breadcrumbs'][] = ['label' => 'Товары', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\pistol88\microshop\assets\BackendAsset::register($this);
?>
<div class="product-create">
    
    <?= $this->render('_form', [
        'model' => $model,
        'priceTypes' => $priceTypes,
        'priceModel' => $priceModel,
    ]) ?>

</div>
