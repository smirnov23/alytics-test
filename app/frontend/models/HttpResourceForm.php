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
    public $fail_limit;
    public $fail_delay;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['url', 'trim'],
            ['url', 'required'],
            ['url', 'url'],
            ['url', 'unique',
                'targetClass' => '\common\models\HttpResource',
                'message' => Yii::t('app', Yii::t('app', 'This URL has already been taken.'))
            ],
            ['url', 'string', 'min' => 4, 'max' => 255],

            ['attempt_frequency', 'required'],
            ['attempt_frequency', 'number'],
            ['attempt_frequency', 'in', 'range' => [1, 5, 10]],

            ['fail_limit', 'required'],
            ['fail_limit', 'number', 'min' => 0, 'max' => PHP_INT_MAX],

            ['fail_delay', 'required'],
            ['fail_delay', 'number', 'min' => 1, 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            "url" => Yii::t("app", "URL"),
            "attempt_frequency" => Yii::t("app", "Attempt Frequency"),
            "fail_limit" => Yii::t("app", "Fail Limit"),
            "fail_delay" => Yii::t("app", "Fail Delay"),
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
            return false;
        }
        
        $httpResource = new HttpResource();
        $httpResource->url = $this->url;
        $httpResource->attempt_frequency = $this->attempt_frequency;
        $httpResource->fail_limit = $this->fail_limit;
        $httpResource->fail_delay = $this->fail_delay;

        return $httpResource->save();
    }
}
