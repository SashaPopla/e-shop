<?php

namespace app\controllers;

use app\models\Category;
use app\models\Product;
use app\models\ProductLang;
use Yii;
use yii\data\ActiveDataProvider;
use yii\data\Pagination;
//use yii\db\Query;
use yii\web\HttpException;

class ShopController extends AppController{
    public function  actionView()
    {

        $query = Product::find();

        /*$query = (new yii\db\Query())
            ->select(['product.id', 'product.price', 'product.img', 'product.hit',
                'product.new', 'product.sale', 'product_lang.title', 'product_lang.description'])
            ->from('product')
            ->join('INNER JOIN', 'product_lang', 'product_lang.id = product.id')
            ->join('INNER JOIN', 'category', 'category.id = product.category_id')
            ->where(['product_lang.lang' => Yii::$app->language, 'product.category_id' => $id])
            ->all();*/

        /* 
            SELECT category.name AS 'Бренд', COUNT(product.name) FROM `category` 
            INNER JOIN `product` ON product.category_id = category.id 
            WHERE category.parent_id = 1 OR category.parent_id = 2 OR category.parent_id = 3 
            GROUP BY category.name; 
        */
        $countBrands = (new yii\db\Query())
            ->select(['category.id', 'category.name', 'COUNT(product.name)'])
            ->from('category')
            ->join('INNER JOIN', 'product', 'product.category_id = category.id')
            ->where(
                ['category.parent_id' => [1, 2, 3]]
            )
            ->groupBy(['category.name'])
            ->all();

        $pages = new Pagination([
            'totalCount' => $query->count(),
            'pageSize' => 12,
            'forcePageParam' => false,
            'pageSizeParam' => false
        ]);


        $products = $query->offset($pages->offset)->limit($pages->limit)->all();

        $this->setMeta('E-SHOPPER | ');

        return $this->render('view', compact('products', 'countBrands' ,'pages'));
    }
}