<?php

namespace app\controllers;

use app\models\Product;
use app\models\Cart;
use Yii;

/*
 *Массив корзины
Array
(
    [1] => Array
    (
        [qty] => QTY // количество
        [name] => NAME // имя
        [price] => PRICE //цена
        [img] => IMG // картинка
    )
    ...
    [10] => Array
    (
        [qty] => QTY // количество
        [name] => NAME // имя
        [price] => PRICE //цена
        [img] => IMG // картинка
    )
    ...
)
        [qty] => QTY // количество
        [sum] => SUM // сумма
);
 */

class CartController extends AppController
{
    public function actionAdd() // добовление в корзину
    {
        $id = Yii::$app->request->get('id');
        $qty = (int)Yii::$app->request->get('qty');

        $qty = !$qty ? 1 : $qty;
        //debug($id);
        $product = Product::findOne($id);

        if(empty($product))
            return false;
        //debug($product);
        $session = Yii::$app->session;
        $session->open();

        $cart = new Cart();

        $cart->addToCart($product, $qty);

        //debug($session['cart']);
        //debug($session['cart.qty']);
        //debug($session['cart.sum']);

        $this->layout = false;
        return $this->render('cart-model', compact('session'));
    }

    public function actionClear() // очистка корзины
    {
        $session = Yii::$app->session;
        $session->open();
        $session->remove('cart');
        $session->remove('cart.qty');
        $session->remove('cart.sum');

        $this->layout = false;
        return $this->render('cart-model', compact('session'));
    }

    public function actionDelItem() // удаление товара с корзины
    {
        $id = Yii::$app->request->get('id');

        $session = Yii::$app->session;
        $session->open();

        $cart = new Cart();
        $cart->recalc($id);

        $this->layout = false;
        return $this->render('cart-model', compact('session'));
    }

    public function actionShow()
    {
        $session = Yii::$app->session;
        $session->open();

        $this->layout = false;
        return $this->render('cart-model', compact('session'));
    }
}