<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;


class Attempt extends ActiveRecord
{
    public function getHttpResource()
    {
        return $this->hasOne(HttpResource::class, ['id' => 'http_resource_id']);
    }
}