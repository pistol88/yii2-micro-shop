<?php
use yii\bootstrap\Nav;
?>
<div class="shop-menu">
    <?= Nav::widget([
        'items' => [
            [
                'label' => 'Товары',
                'url' => ['/shop/product/index'],
            ],
            [
                'label' => 'Категории',
                'url' => ['/shop/category/index'],
            ],
            [
                'label' => 'Поступление',
                'url' => ['/shop/incoming/index'],
            ]
        ],
        'options' => ['class' =>'nav-pills'],
    ]); ?>
</div>