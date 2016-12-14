<?php
namespace pistol88\microshop\models;

use Yii;
use yii\helpers\Url;
use pistol88\microshop\models\product\ProductQuery;
use yii\db\ActiveQuery;

class Product extends \yii\db\ActiveRecord implements \pistol88\relations\interfaces\Torelate, \pistol88\cart\interfaces\CartElement
{
    function behaviors()
    {
        return [
            'images' => [
                'class' => 'pistol88\gallery\behaviors\AttachImages',
                'mode' => 'gallery',
            ],
        ];
    }
    
    public static function tableName()
    {
        return '{{%shop_product}}';
    }
    
    public static function Find()
    {
        $return = new ProductQuery(get_called_class());
        $return = $return->with('category');
        
        return $return;
    }
    
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['category_id', 'sort', 'amount'], 'integer'],
            [['price'], 'double'],
            [['text', 'available', 'code', 'is_new', 'is_promo', 'is_popular'], 'string'],
            [['name'], 'string', 'max' => 200],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'code' => 'Код (актикул)',
            'category_id' => 'Главная категория',
            'name' => 'Название',
            'amount' => 'Остаток',
            'price' => 'Цена',
            'text' => 'Текст',
            'images' => 'Картинка',
            'available' => 'В наличии',
            'is_new' => 'Новинка',
            'is_popular' => 'Популярное',
            'is_promo' => 'Акция',
            'sort' => 'Сортировка',
        ];
    }
    
    public function getId()
    {
        return $this->id;
    }
    
    public function setPrice($price)
    {
        $this->price = $price;
        $this->save(false);
        
        return $this;
    }
    
    public function minusAmount($count)
    {
        $this->amount = $this->amount-$count;
        $this->save(false);
        
        return $this;
    }
    
    public function plusAmount($count)
    {
        $this->amount = $this->amount+$count;
        $this->save(false);
        
        return $this;
    }
    
    public function getProduct()
    {
        return $this;
    }
    
    public function getCartId()
    {
        return $this->id;
    }
    
    public function getCartName()
    {
        return $this->name;
    }
    
    public function getCartPrice()
    {
        return $this->price;
    }

    public function getPrice()
    {
        return $this->price;
    }
    
    public function getCartOptions()
    {
        $options = [];

        return $options;
    }
    
    public function getName()
    {
        return $this->name;
    }
    
    public function getSellModel()
    {
        return $this;
    }

    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }
}
