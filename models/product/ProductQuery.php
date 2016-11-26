<?php
namespace pistol88\microshop\models\product;

use pistol88\microshop\models\Category;
use yii\db\ActiveQuery;

class ProductQuery extends ActiveQuery
{
    function behaviors()
    {
       return [
           'filter' => [
               'class' => 'pistol88\filter\behaviors\Filtered',
           ],
       ];
    }
    
    public function available()
    {
         return $this->andwhere("`available` = 'yes'");
    }
    
    public function category($childCategoriesIds)
    {
         return $this->andwhere(['category_id' => $childCategoriesIds]);
    }
    
    public function getTotalPrice()
    {
        return $this->sum("price*amount");
    }
    
    public function getTotalAmount()
    {
        return $this->sum("amount");
    }
}