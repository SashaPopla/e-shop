<?php

namespace app\models;

use yii\db\ActiveRecord;

class Wishlist extends ActiveRecord
{
    public function addToWishlist($product, $qty = 1)
    {
        // если такой товар есть, то должны его удалить
        if(isset($_SESSION['wishlist'] [$product->id]))
        {
            unset($_SESSION['wishlist'] [$product->id]);
        }
        else{ // если товара нету, то создаём его
            $_SESSION['wishlist'] [$product->id] = [
                'name' => $product->name,
                'price' => $product->price,
                'img' => $product->img
            ];
        }
    }

    public function recalc($id)
    {
        if(!isset($_SESSION['wishlist'] [$id]))
            return false;

        unset($_SESSION['wishlist'] [$id]); // удаление текущего товара
    }
}