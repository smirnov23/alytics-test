<?php

/** @var yii\web\View $this */

use yii\helpers\Html;
use yii\widgets\LinkPager;

$this->title = Yii::t('app','HTTP resource');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-index">
    <h1><?= Html::encode($this->title) ?></h1>

    <div class="body-content">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col"><?=Yii::t('app','Field Name')?></th>
                    <th scope="col"><?=Yii::t('app','Field Value')?></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><?=Yii::t('app','id')?></td>
                    <td><?=$httpResource->id?></td>
                </tr>
                <tr>
                    <td><?=Yii::t('app','URL')?></td>
                    <td><?= Html::a($httpResource->url, $httpResource->url, ['target' => '_blank']) ?></td>
                </tr>
                <tr>
                    <td><?=Yii::t('app','Attempt Frequency')?></td>
                    <td><?=$httpResource->attempt_frequency?></td>
                </tr>
                <tr>
                    <td><?=Yii::t('app','Attempt Limit')?></td>
                    <td><?=$httpResource->attempt_limit?></td>
                </tr>
                <tr>
                    <td><?=Yii::t('app','Delay')?></td>
                    <td><?=$httpResource->delay?></td>
                </tr>
                <tr>
                    <td><?=Yii::t('app','Created At')?></td>
                    <td><?=date('Y-m-d H:i:s', $httpResource->created_at)?></td>
                </tr>
                <tr>
                    <td><?=Yii::t('app','Updated At')?></td>
                    <td><?=date('Y-m-d H:i:s', $httpResource->updated_at)?></td>
                </tr>
            </tbody>
        </table>
        <h2><?=Yii::t('app','Attempts')?></h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col"><?=Yii::t('app','id')?></th>
                    <th scope="col"><?=Yii::t('app','HTTP Code')?></th>
                    <th scope="col"><?=Yii::t('app','Number')?></th>
                    <th scope="col"><?=Yii::t('app','Attempted At')?></th>
                </tr>
            </thead>
            <tbody>
            <?foreach($attempts as $attempt):?>
                <tr>
                    <td><?= Html::a($attempt->id, ['attempts/attempt', 'id' => $attempt->id]) ?></td>
                    <td class="text-end"><?=$attempt->http_code?></td>
                    <td class="text-end"><?=$attempt->number?></td>
                    <td><?=date('Y-m-d H:i:s', $attempt->created_at)?></td>
                </tr>
            <?endforeach;?>
            </tbody>
        </table>
        <?=LinkPager::widget([
            'pagination' => $pagination, 
            'linkContainerOptions' => ['class' => 'page-item'],
            'linkOptions' => ['class' => 'page-link'],
            'disabledListItemSubTagOptions' => ['class' => 'page-link'],
        ])?>
    </div>
</div>
