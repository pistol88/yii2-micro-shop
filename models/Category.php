<?php
namespace pistol88\microshop\models;

use Yii;
use pistol88\microshop\models\category\CategoryQuery;
use yii\helpers\Url;

class Category extends \yii\db\ActiveRecord
{
    function behaviors()
    {
        return [
            'images' => [
                'class' => 'pistol88\gallery\behaviors\AttachImages',
                'mode' => 'single',
            ],
        ];
    }
    
    public static function tableName()
    {
        return '{{%shop_category}}';
    }
    
    static function find()
    {
        return new CategoryQuery(get_called_class());
    }

    public function rules()
    {
        return [
            [['sort'], 'integer'],
            [['name'], 'required'],
            [['text', 'code'], 'string'],
            [['name', 'code'], 'string', 'max' => 55],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Имя категории',
            'text' => 'Описание',
            'image' => 'Картинка',
            'sort' => 'Сортировка',
            'description' => 'Описание',
        ];
    }

    public function getProducts()
    {
        return $this->hasMany(Product::className(), ['category_id' => 'id']);
    }
}
