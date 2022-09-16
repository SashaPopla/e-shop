<?php

namespace app\components;

use Yii;
use codemix\localeurls\UrlManager as BaseUrlManager;
use app\models\Lang;

class UrlManager extends BaseUrlManager
{
    public $items = [];

    public function init()
    {
        $languages = Lang::find()->all();

        if( count($languages) < 1){
            return false;
        }

        foreach ($languages as $language){
            $this->items[] = $language->url;
        }

        $this->languages = $this->items;
        parent::init();
    }
}