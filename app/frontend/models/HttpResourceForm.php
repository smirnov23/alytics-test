<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use common\models\HttpResource;

/**
 * HttpResource form
 */
class HttpResourceForm extends Model
{
    public $url;
    public $attempt_frequency;
    public $attempt_limit;
    public $delay;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['url', 'trim'],
            ['url', 'required'],
            ['url', 'url'],
            ['url', 'unique', 'targetClass' => '\common\models\HttpResource', 'message' => Yii::t('app', 'This URL has already been taken.')],
            ['url', 'string', 'min' => 4, 'max' => 255],

            ['attempt_frequency', 'required'],
            ['attempt_frequency', 'number', 'min' => 0, 'max' => 10],

            ['attempt_limit', 'required'],
            ['attempt_limit', 'number', 'min' => 0, 'max' => PHP_INT_MAX],

            ['delay', 'required'],
            ['delay', 'number', 'min' => 1, 'max' => 255],
        ];
    }

    /**
     * Signs user up.
     *
     * @return bool whether the creating new account was successful and email was sent
     */
    public function save()
    {
        if (!$this->validate()) {
            return null;
        }
        
        $httpResource = new HttpResource();
        $httpResource->url = $this->url;
        $httpResource->attempt_frequency = $this->attempt_frequency;
        $httpResource->attempt_limit = $this->attempt_limit;
        $httpResource->delay = $this->delay;
        $httpResource->created_at = time();
        $httpResource->updated_at = $httpResource->created_at;

        return $httpResource->save();
    }
}
