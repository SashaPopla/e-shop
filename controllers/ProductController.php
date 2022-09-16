<?php

namespace app\controllers;

use app\models\Category;
use app\models\Product;
use app\models\ProductLang;
use Yii;
use yii\db\Query;
use yii\web\HttpException;

class ProductController extends AppController
{
    public function actionView($id)
    {
        $productId = Product::findOne($id); //линивая загрузка
        //$product = Product::find()->with('category')->where(['id' => $id])->limit(1)->one(); // жатая загрузка

        if(empty($productId))
        {
            throw new HttpException(404,'Такого товара нету');
        }

        $product = (new Query())
            ->select(['category.name AS categoryName', 'category.id AS categoryId','product.id', 'product.price', 'product.img', 'product.hit',
                'product.new', 'product.sale', 'product_lang.title', 'product_lang.description'])
            ->from('product')
            ->join('INNER JOIN', 'product_lang', 'product_lang.id = product.id')
            ->join('INNER JOIN', 'category', 'category.id = product.category_id')
            ->where(['product_lang.lang' => Yii::$app->language, 'product_lang.id' => $productId->id])
            ->all();

        //$hits = Product::find()->where(['hit'=>1])->limit(6)->all();
        $hits = (new Query())
            ->select(['product.id', 'product.price', 'product.img', 'product.hit', 'product.new', 'product.sale', 'product_lang.title', 'product_lang.description'])
            ->from('product')
            ->join('INNER JOIN', 'product_lang', 'product_lang.id = product.id')
            ->where(['product_lang.lang' => Yii::$app->language, 'product.hit' => 1])
            ->limit(6)
            ->all();

        $this->setMeta('E-SHOPPER | '.$product[0]['title'], $productId->keywords, $productId->description);

        return $this->render('view', compact('product', 'hits'));
    }
}