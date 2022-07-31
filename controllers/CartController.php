<?php

namespace app\controllers;

use app\models\Product;
use app\models\Cart;
use app\models\Order;
use app\models\OrderItems;
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

    public function actionView()
    {
        $this->setMeta('E-SHOPPER | Order');

        $session = Yii::$app->session;
        $session->open();

        $order = new Order();

        if($order->load(Yii::$app->request->post()))
        {
            $order->qty = $session['cart.qty'];
            $order->sum = $session['cart.sum'];

            if($order->save())
            {
                $this->saveOrderItems($session['cart'], $order->id);

                Yii::$app->session->setFlash('success', 'Ваш заказ принят. Наш менеджер скоро свяжится с Вами');
                // почта
                Yii::$app->mailer->compose('order', compact('session'))
                ->setFrom(['test@gmail.com' => 'E-SHOPPER'])
                    ->setTo($order->email)
                    ->setSubject('Заказ от сайта E-SHOPPER')
                    ->send();
                //
                $session->remove('cart');
                $session->remove('cart.qty');
                $session->remove('cart.sum');
            }
            else
                Yii::$app->session->setFlash('error', 'Ошибка при оформлении заказа');
        }
        return $this->render('view', compact('session', 'order'));
    }

    protected function saveOrderItems($items, $order_id)
    {
        foreach ($items as $id=>$item)
        {
            $order_items = new OrderItems();
            $order_items->order_id = $order_id;
            $order_items->product_id = $id;
            $order_items->name = $item['name'];
            $order_items->price = $item['price'];
            $order_items->qty_item = $item['qty'];
            $order_items->sum_item = $item['price'] * $item['qty'];
            $order_items->save();
        }
    }
}