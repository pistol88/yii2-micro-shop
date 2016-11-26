Yii2-shop
==========
Модуль представляет из себя бекенд для очень маленького Интернет-магазина.

Установка
---------------------------------

```
php composer require pistol88/yii2-shop
```

Миграция:

```
php yii migrate --migrationPath=vendor/pistol88/yii2-micro-shop/migrations
```

Настройка
---------------------------------
//ALTER TABLE  `shop_product` ADD  `price` DECIMAL( 11, 2 ) NULL ;
//ALTER TABLE  `shop_incoming` ADD  `price` DECIMAL( 11, 2 ) NULL ,
ADD  `product_id` INT( 11 ) NULL ,
ADD  `amount` INT( 11 ) NULL ;

В конфиг (скорее всего, bootstrap.php) добавить:

```
Yii::setAlias('@storageUrl','/frontend/web/images');
```

В секцию modules конфига добавить:

```
    'modules' => [
        //..
        'shop' => [
            'class' => 'pistol88\microshop\Module',
            'adminRoles' => ['administrator'],
        ],
        'gallery' => [
            'class' => 'pistol88\gallery\Module',
            'imagesStorePath' => dirname(dirname(__DIR__)).'/storage/web/images/store',
            'imagesCachePath' => dirname(dirname(__DIR__)).'/storage/web/images/cache',
            'graphicsLibrary' => 'GD',
            'placeHolderPath' => dirname(dirname(__DIR__)).'/storage/web/images/placeHolder.png',
        ],
        //..
    ]
```

В секцию components:

```
    'components' => [
        //..
        'fileStorage' => [
            'class' => '\trntv\filekit\Storage',
            'baseUrl' => '@storageUrl/source',
            'filesystem'=> function() {
                $adapter = new \League\Flysystem\Adapter\Local(dirname(dirname(__DIR__)).'/frontend/web/images/source');
                return new League\Flysystem\Filesystem($adapter);
            },
        ],
        //..
    ]
```