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

class CategoryController extends AppController
{
    public function actionIndex(){
        //$hits = Product::find()->with()->where(['hit' => 1])->limit(6)->all();

        $hits = (new yii\db\Query())
            ->select(['product.id', 'product.price', 'product.img', 'product.hit', 'product.new', 'product.sale', 'product_lang.title', 'product_lang.description'])
            ->from('product')
            ->join('INNER JOIN', 'product_lang', 'product_lang.id = product.id')
            ->where(['product_lang.lang' => Yii::$app->language, 'product.hit' => 1])
            ->orderBy('RAND()')->limit(3)
            ->all();

        $news = (new yii\db\Query())
            ->select(['product.id', 'product.price', 'product.img', 'product.hit', 'product.new', 'product.sale', 'product_lang.title', 'product_lang.description'])
            ->from('product')
            ->join('INNER JOIN', 'product_lang', 'product_lang.id = product.id')
            ->where(['product_lang.lang' => Yii::$app->language, 'product.new' => 1])
            ->limit(6)
            ->all();

        $kids = (new yii\db\Query())
            ->select(['product.id', 'product.price', 'product.img', 'product.hit', 'product.new', 'product.sale', 'product_lang.title', 'product_lang.description'])
            ->from('product')
            ->join('INNER JOIN', 'product_lang', 'product_lang.id = product.id')
            ->where(['product_lang.lang' => Yii::$app->language, 'product.category_id' => 24])
            ->limit(4)
            ->all();

        $this->setMeta('E-SHOPPER |');

        return $this->render('index', compact('hits', 'news', 'kids'));
    }

    public function  actionView($id)
    {
        $id = Yii::$app->request->get('id');

        $category = Category::findOne($id);

        if(empty($category))
        {
            throw new HttpException(404, 'Такой категории нету');
        }

        $query = Product::find()->joinWith('productLang')->where(['product.category_id' => $id]);

        /*$query = (new yii\db\Query())
            ->select(['product.id', 'product.price', 'product.img', 'product.hit',
                'product.new', 'product.sale', 'product_lang.title', 'product_lang.description'])
            ->from('product')
            ->join('INNER JOIN', 'product_lang', 'product_lang.id = product.id')
            ->join('INNER JOIN', 'category', 'category.id = product.category_id')
            ->where(['product_lang.lang' => Yii::$app->language, 'product.category_id' => $id])
            ->all();*/

        $pages = new Pagination([
            'totalCount' => $query->count(),
            'pageSize' => 12,
            'forcePageParam' => false,
            'pageSizeParam' => false
        ]);

        $products = $query->offset($pages->offset)->limit($pages->limit)->all();

        $this->setMeta('E-SHOPPER | '.$category->name, $category->keywords, $category->description);

        return $this->render('view', compact('products', 'pages', 'category'));
        //return $this->render('view', compact('query', 'pages', 'category'));
    }

    public function actionSearch()
    {
        $search = trim(Yii::$app->request->get('q'));

        $this->setMeta('E-SHOPPER | Search: '.$search);

        if(!$search){
            return $this->render('search');
        }

        $query = Product::find()->where(['like', 'name', $search]);

        $pages = new Pagination([
            'totalCount' => $query->count(),
            'pageSize' => 6,
            'forcePageParam' => false,
            'pageSizeParam' => false
        ]);

        $products = $query->offset($pages->offset)->limit($pages->limit)->all();

        return $this->render('search', compact('products', 'pages', 'search'));
    }
}