<?php

namespace pistol88\microshop\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use pistol88\microshop\models\Incoming;
use pistol88\microshop\models\Product;

class IncomingController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => $this->module->adminRoles,
                    ]
                ]
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                    'edittable' => ['post'],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        $model = new Incoming;

        if ($post = Yii::$app->request->post()) {
            
            $productModel = new Product;
            
            foreach($post['element'] as $id => $count) {
                $model = new Incoming;
                $model->date = time();
                $model->amount = $count;
                
                if($product = $productModel::findOne($id)) {
                    $product->plusAmount($count);
                    $model->product_id = $id;
                }
                
                if($price = $post['price'][$id]) {
                    $product->setPrice($price);
                    $model->price = $price;
                }
                
                if($model->save()) {
                    \Yii::$app->session->setFlash('success', 'Поступление успешно добавлено.');
                }
            }

            return $this->redirect(['index', 'id' => $model->id]);
        } else {
            return $this->render('index', [
                'model' => $model,
            ]);
        }
    }
}
