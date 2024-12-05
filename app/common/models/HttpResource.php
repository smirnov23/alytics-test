<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;


class HttpResource extends ActiveRecord
{
    public function getAttempts()
    {
        return $this->hasMany(Attempt::class, ['http_resource_id' => 'id']);
    }
}