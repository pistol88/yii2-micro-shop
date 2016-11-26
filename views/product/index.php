<?php
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use pistol88\microshop\models\ProductOption;
use pistol88\microshop\models\Category;
use pistol88\microshop\models\Producer;
use pistol88\microshop\models\Price;
use kartik\export\ExportMenu;

$this->title = 'Товары';
$this->params['breadcrumbs'][] = $this->title;

\pistol88\microshop\assets\BackendAsset::register($this);
?>
<div class="product-index">
    <div class="row">
        <div class="col-md-2">
            <?= Html::a('Добавить товар', ['create'], ['class' => 'btn btn-success']) ?>
        </div>
        <div class="col-md-10">
            <?=$this->render('../parts/menu');?>
        </div>
    </div>
    
    <?php if($amount) { ?>
        <div class="summary">
            Всего товаров:
            <?=$amount;?>
            на сумму
            <?=$totalPrice;?> руб.
        </div>
    <?php } ?>
    
    <br style="clear: both;"></div>
    <?php
    echo \kartik\grid\GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            ['attribute' => 'id', 'filter' => false, 'options' => ['style' => 'width: 55px;']],
            'name',
            'code',
            [
                'label' => 'Остаток',
                'content' => function($model) {
                    return "<p>{$model->amount} (".($model->amount*$model->price).")</p>";
                }
            ],
            [
                'attribute' => 'images',
                'format' => 'images',
                'filter' => false,
                'content' => function ($image) {
                    if($image = $image->getImage()->getUrl('50x50')) {
                        return "<img src=\"{$image}\" class=\"thumb\" />";
                    }
                }
            ],
            [
                'label' => 'Цена',
                'value' => 'price'
            ],
            [
                'attribute' => 'available',
                'filter' => Html::activeDropDownList(
                    $searchModel,
                    'available',
                    ['no' => 'Нет', 'yes' => 'Да'],
                    ['class' => 'form-control', 'prompt' => 'Наличие']
                ),
            ],
            [
                'attribute' => 'category_id',
                'filter' => Html::activeDropDownList(
                    $searchModel,
                    'category_id',
                    ArrayHelper::map(Category::find()->all(), 'id', 'name'),
                    ['class' => 'form-control', 'prompt' => 'Категория']
                ),
                'value' => 'category.name'
            ],
            ['class' => 'yii\grid\ActionColumn', 'template' => '{update} {delete}',  'buttonOptions' => ['class' => 'btn btn-default'], 'options' => ['style' => 'width: 125px;']],
        ],
    ]); ?>

</div>
