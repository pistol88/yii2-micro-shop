<?php
namespace pistol88\microshop\models\category;

use yii\db\ActiveQuery;

class CategoryQuery extends ActiveQuery
{
    public function popular()
    {
         return $this->andWhere(['is_popular' => 'yes']);
    }
}