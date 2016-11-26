<?php
namespace pistol88\microshop\models;

use Yii;

class Incoming extends \yii\db\ActiveRecord
{
    
    public static function tableName()
    {
        return '{{%shop_incoming}}';
    }

    public function rules()
    {
        return [
            [['content'], 'string'],
            [['price'], 'double'],
            [['product_id', 'amount'], 'integer'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'date' => 'Дата',
            'product_id' => 'Товар',
            'amount' => 'Кол-во',
            'price' => 'Цена',
        ];
    }
}
