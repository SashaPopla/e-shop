<?php

namespace app\controllers;

use app\models\Product;
use app\models\Category;
use app\models\Wishlist;
use Yii;

class WishlistController extends AppController
{
    public function actionAdd(){
        $id = Yii::$app->request->get('id');

        if($id === null)
            return $this->render('add-wishlist');

        $product = Product::findOne($id);

        if(empty($product))
            return false;

        $session = Yii::$app->session;
        $session->open();

        $wishlist = new Wishlist();
        $wishlist->addToWishlist($product);

        if(!Yii::$app->request->isAjax){
            return $this->redirect(Yii::$app->request->referrer);
        }

        return $this->render('add-wishlist', compact('session'));
    }

    public function actionAddWishlist(){
        $this->setMeta('E-SHOPPER | Wishlist');

        $session = Yii::$app->session;
        $session->open();

        return $this->render('add-wishlist', compact('session'));
    }

    public function actionDel()
    {
        $id = Yii::$app->request->get('id');
        //debug($id);
        $session = Yii::$app->session;
        $session->open();

        $wishlist = new Wishlist();
        $wishlist->recalc($id);

        return $this->redirect(Yii::$app->request->referrer);
    }
}