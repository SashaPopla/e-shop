<?php

/** @var yii\web\View $this */

use yii\helpers\Html;
?>

<section id="slider"><!--slider-->
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div id="slider-carousel" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#slider-carousel" data-slide-to="0" class="active"></li>
                        <li data-target="#slider-carousel" data-slide-to="1"></li>
                        <li data-target="#slider-carousel" data-slide-to="2"></li>
                    </ol>

                    <div class="carousel-inner">
                        <div class="item active">
                            <div class="col-sm-6">
                                <h1><span>E</span>-SHOPPER</h1>
                                <h2>Free E-Commerce Template</h2>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </p>
                                <button type="button" class="btn btn-default get">Get it now</button>
                            </div>
                            <div class="col-sm-6">
                                <?= Html::img("@web/images/home/girl1.jpg", ['alt' => '', 'class'=>'girl img-responsive']) ?>
                                <?= Html::img("@web/images/home/pricing.png", ['alt' => '', 'class'=>'pricing']) ?>
                            </div>
                        </div>
                        <div class="item">
                            <div class="col-sm-6">
                                <h1><span>E</span>-SHOPPER</h1>
                                <h2>100% Responsive Design</h2>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </p>
                                <button type="button" class="btn btn-default get">Get it now</button>
                            </div>
                            <div class="col-sm-6">
                                <?= Html::img("@web/images/home/girl2.jpg", ['alt' => '', 'class'=>'girl img-responsive']) ?>
                                <?= Html::img("@web/images/home/pricing.png", ['alt' => '', 'class'=>'pricing']) ?>
                            </div>
                        </div>

                        <div class="item">
                            <div class="col-sm-6">
                                <h1><span>E</span>-SHOPPER</h1>
                                <h2>Free Ecommerce Template</h2>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </p>
                                <button type="button" class="btn btn-default get">Get it now</button>
                            </div>
                            <div class="col-sm-6">
                                <?= Html::img("@web/images/home/girl3.jpg", ['alt' => '', 'class'=>'girl img-responsive']) ?>
                                <?= Html::img("@web/images/home/pricing.png", ['alt' => '', 'class'=>'pricing']) ?>
                            </div>
                        </div>

                    </div>

                    <a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
                        <i class="fa fa-angle-left"></i>
                    </a>
                    <a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
                        <i class="fa fa-angle-right"></i>
                    </a>
                </div>

            </div>
        </div>
    </div>
</section><!--/slider-->

<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
                <div class="left-sidebar">
                    <h2>Category</h2>

                    <ul class="catalog category-products">
                            <?= \app\components\MenuWidget::widget(['tpl' => 'menu'])?>
                    </ul>

                    <div class="shipping text-center"><!--shipping-->
                        <?= Html::img("@web/images/home/shipping.jpg", ['alt' => '']) ?>
                    </div><!--/shipping-->

                </div>
            </div>

            <div class="col-sm-9 padding-right">

                <?php if( !empty($hits)): ?>
                <div class="features_items"><!--features_items-->
                    <h2 class="title text-center">Features Items</h2>
                    <?php foreach ($hits as $hit) : ?>
                        <div class="col-sm-4">
                            <div class="product-image-wrapper">
                                <div class="single-products">
                                    <div class="productinfo text-center">
                                        <?= Html::img("@web/images/products/{$hit['img']}", ['alt' => $hit['description']]) ?>
                                        <h2>$ <?= $hit['price'] ?></h2>
                                        <p><a href="<?= \yii\helpers\Url::to(['product/view', 'id' => $hit['id']]) ?>"> <?= $hit['title'] ?> </a></p>
                                        <a href="<?=\yii\helpers\Url::to(['cart/add', 'id'=>$hit['id']])?>" data-id="<?=$hit['id']?>" class="btn btn-default add-to-cart">
                                            <i class="fa fa-shopping-cart"></i>
                                            Add to cart
                                        </a>
                                    </div>

                                    <?php if($hit['new']): ?>
                                        <?= Html::img("@web/images/home/new.png", ['alt'=> 'New', 'class' => 'new'])?>
                                    <?php endif; ?>

                                    <?php if($hit['sale']): ?>
                                        <?= Html::img("@web/images/home/sale.png", ['alt'=> 'Sale', 'class' => 'new'])?>
                                    <?php endif; ?>
                                </div>
                                <div class="choose">
                                    <ul class="nav nav-pills nav-justified">
                                        <li>
                                            <a href="<?= \yii\helpers\Url::to(['wishlist/add', 'id'=>$hit['id']]) ?>">
                                                <i class="fa fa-plus-square add-wishlist"></i>
                                                Add to wishlist
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#"><i class="fa fa-plus-square"></i>Add to compare</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>

                </div><!--features_items-->
                <?php endif; ?>

                <div class="category-tab"><!--category-tab-->
                    <div class="col-sm-12">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#tshirt" data-toggle="tab">T-Shirt</a></li>
                            <li><a href="#blazers" data-toggle="tab">Blazers</a></li>
                            <li><a href="#sunglass" data-toggle="tab">Sunglass</a></li>
                            <li><a href="#kids" data-toggle="tab">Kids</a></li>
                        </ul>
                    </div>
                    <div class="tab-content">
                        <div class="tab-pane fade active in" id="tshirt" >
                            <div class="col-sm-3">
                                <div class="product-image-wrapper">
                                    <div class="single-products">
                                        <div class="productinfo text-center">
                                            <?= Html::img("@web/images/home/gallery1.jpg", ['alt' => '']) ?>
                                            <h2>$56</h2>
                                            <p>Easy Polo Black Edition</p>
                                            <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="product-image-wrapper">
                                    <div class="single-products">
                                        <div class="productinfo text-center">
                                            <?= Html::img("@web/images/home/gallery2.jpg", ['alt' => '']) ?>
                                            <h2>$56</h2>
                                            <p>Easy Polo Black Edition</p>
                                            <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="product-image-wrapper">
                                    <div class="single-products">
                                        <div class="productinfo text-center">
                                            <?= Html::img("@web/images/home/gallery3.jpg", ['alt' => '']) ?>
                                            <h2>$56</h2>
                                            <p>Easy Polo Black Edition</p>
                                            <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="product-image-wrapper">
                                    <div class="single-products">
                                        <div class="productinfo text-center">
                                            <?= Html::img("@web/images/home/gallery4.jpg", ['alt' => '']) ?>
                                            <h2>$56</h2>
                                            <p>Easy Polo Black Edition</p>
                                            <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="blazers" >
                            <div class="col-sm-3">
                                <div class="product-image-wrapper">
                                    <div class="single-products">
                                        <div class="productinfo text-center">
                                            <?= Html::img("@web/images/home/gallery4.jpg", ['alt' => '']) ?>
                                            <h2>$56</h2>
                                            <p>Easy Polo Black Edition</p>
                                            <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="product-image-wrapper">
                                    <div class="single-products">
                                        <div class="productinfo text-center">
                                            <?= Html::img("@web/images/home/gallery3.jpg", ['alt' => '']) ?>
                                            <h2>$56</h2>
                                            <p>Easy Polo Black Edition</p>
                                            <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="product-image-wrapper">
                                    <div class="single-products">
                                        <div class="productinfo text-center">
                                            <?= Html::img("@web/images/home/gallery2.jpg", ['alt' => '']) ?>
                                            <h2>$56</h2>
                                            <p>Easy Polo Black Edition</p>
                                            <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="product-image-wrapper">
                                    <div class="single-products">
                                        <div class="productinfo text-center">
                                            <?= Html::img("@web/images/home/gallery1.jpg", ['alt' => '']) ?>
                                            <h2>$56</h2>
                                            <p>Easy Polo Black Edition</p>
                                            <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="sunglass" >
                            <div class="col-sm-3">
                                <div class="product-image-wrapper">
                                    <div class="single-products">
                                        <div class="productinfo text-center">
                                            <?= Html::img("@web/images/home/gallery3.jpg", ['alt' => '']) ?>
                                            <h2>$56</h2>
                                            <p>Easy Polo Black Edition</p>
                                            <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="product-image-wrapper">
                                    <div class="single-products">
                                        <div class="productinfo text-center">
                                            <?= Html::img("@web/images/home/gallery4.jpg", ['alt' => '']) ?>
                                            <h2>$56</h2>
                                            <p>Easy Polo Black Edition</p>
                                            <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="product-image-wrapper">
                                    <div class="single-products">
                                        <div class="productinfo text-center">
                                            <?= Html::img("@web/images/home/gallery1.jpg", ['alt' => '']) ?>
                                            <h2>$56</h2>
                                            <p>Easy Polo Black Edition</p>
                                            <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="product-image-wrapper">
                                    <div class="single-products">
                                        <div class="productinfo text-center">
                                            <?= Html::img("@web/images/home/gallery2.jpg", ['alt' => '']) ?>
                                            <h2>$56</h2>
                                            <p>Easy Polo Black Edition</p>
                                            <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <?php if( !empty($kids)): ?>
                        <div class="tab-pane fade" id="kids" >
                            <?php foreach($kids as $kid): ?>
                                    <div class="col-sm-3">
                                        <div class="product-image-wrapper">
                                            <div class="single-products">
                                                <div class="productinfo text-center">
                                                    <?= Html::img("@web/images/products/{$kid['img']}", ['alt' => $kid['description']]) ?>
                                                    <h2>$ <?= $kid['price'] ?> </h2>
                                                    <p><a href="<?= \yii\helpers\Url::to(['product/view', 'id' => $kid['id']]) ?>"> <?= $kid['title']?> </a></p>
                                                    <a href="<?=\yii\helpers\Url::to(['cart/add', 'id'=>$kid['id']])?>" data-id="<?=$kid['id']?>" class="btn btn-default add-to-cart">
                                                        <i class="fa fa-shopping-cart"></i>
                                                        Add to cart
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            <?php endforeach; ?>
                        </div>
                        <?php endif; ?>
                    </div>
                </div><!--/category-tab-->

                <div class="recommended_items"><!--recommended_items-->
                    <h2 class="title text-center">recommended items</h2>
                    <div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">
                            <?php $count = count($news); $i = 0; foreach ($news as $new): ?>
                                <?php if($i % 3 === 0): ?>
                                <div class="item <?php if($i == 0 ) echo 'active' ?>">
                                <?php endif; ?>

                                        <div class="col-sm-4">
                                            <div class="product-image-wrapper">
                                                <div class="single-products">
                                                    <div class="productinfo text-center">
                                                    <?= Html::img("@web/images/products/{$new['img']}", ['alt'=> $new['description']]) ?>
                                                        <h2>$<?= $new['price'] ?></h2>
                                                        <p><a href="<?= \yii\helpers\Url::to(['product/view', 'id' => $new['id']]) ?>"> <?= $new['title']?> </a></p>
                                                        <a href="<?=\yii\helpers\Url::to(['cart/add', 'id'=>$new['id']])?>" data-id="<?=$new['id']?>" class="btn btn-default add-to-cart">
                                                            <i class="fa fa-shopping-cart"></i>
                                                            Add to cart
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                <?php $i++; if($i % 3 === 0 || $i == $count): ?>
                                </div>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </div>
                        <a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
                            <i class="fa fa-angle-left"></i>
                        </a>
                        <a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
                            <i class="fa fa-angle-right"></i>
                        </a>
                    </div>
                </div><!--/recommended_items-->

            </div>
        </div>
    </div>
</section>

<?php
$script = <<<JS
    /*price range*/

 $('#sl2').slider();

 	$('.catalog').dcAccordion({
 	    speed: 300
 	});
          
	var RGBChange = function() {
	  $('#RGB').css('background', 'rgb('+r.getValue()+','+g.getValue()+','+b.getValue()+')')
	};	
		
/*scroll to top*/

$(document).ready(function(){
	$(function () {
		$.scrollUp({
	        scrollName: 'scrollUp', // Element ID
	        scrollDistance: 300, // Distance from top/bottom before showing element (px)
	        scrollFrom: 'top', // 'top' or 'bottom'
	        scrollSpeed: 300, // Speed back to top (ms)
	        easingType: 'linear', // Scroll to top easing (see http://easings.net/)
	        animation: 'fade', // Fade, slide, none
	        animationSpeed: 200, // Animation in speed (ms)
	        scrollTrigger: false, // Set a custom triggering element. Can be an HTML string or jQuery object
					//scrollTarget: false, // Set a custom target element for scrolling to the top
	        scrollText: '<i class="fa fa-angle-up"></i>', // Text for element, can contain HTML
	        scrollTitle: false, // Set a custom <a> title if required.
	        scrollImg: false, // Set true to use image
	        activeOverlay: false, // Set CSS color to display scrollUp active point, e.g '#00FFFF'
	        zIndex: 2147483647 // Z-Index for the overlay
		});
	});
});

JS;

$this->registerJs($script);
?>