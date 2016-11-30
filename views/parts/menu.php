<?php
use yii\bootstrap\Nav;
?>
<div class="shop-menu">
    <?= Nav::widget([
        'items' => [
            [
                'label' => 'Товары',
                'url' => ['/microshop/product/index'],
            ],
            [
                'label' => 'Категории',
                'url' => ['/microshop/category/index'],
            ],
            [
                'label' => 'Поступления',
                'url' => ['/microshop/incoming/index'],
            ]
        ],
        'options' => ['class' =>'nav-pills'],
    ]); ?>
</div>