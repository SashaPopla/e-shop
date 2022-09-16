<?php

namespace app\widgets;

use Yii;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\base\Widget;
use app\models\Lang;

class LanguageSwitch extends Widget
{
    public $items = [];
    public $labelAttribute = 'icon';

    public function init()
    {
        $languages = Lang::find()->all();

        if (count($languages) <= 1) {
            return false;
        }

        foreach ($languages as $language) {
            $this->items[] =
                Html::a($language->name, Url::current(['language' => $language->url]), ['class' => Yii::$app->language == $language->name ? 'active_lang' : ''])
                . '<span class="special" style = "color: #fff;" >|</span >';
        }

        echo implode(' ', $this->items);
    }
}