<?php

/** @var yii\web\View $this */

use yii\helpers\Html;
use yii\widgets\LinkPager;

$this->title = Yii::t('app','HTTP resources');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-index">
    <h1><?= Html::encode($this->title) ?></h1>

    <div class="body-content">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col"><?=Yii::t('app','id')?></th>
                    <th scope="col"><?=Yii::t('app','URL')?></th>
                    <th scope="col"><?=Yii::t('app','Attempt Frequency')?></th>
                    <th scope="col"><?=Yii::t('app','Fail Limit')?></th>
                    <th scope="col"><?=Yii::t('app','Fail Delay')?></th>
                    <th scope="col"><?=Yii::t('app','Fails')?></th>
                    <th scope="col"><?=Yii::t('app','Created At')?></th>
                    <th scope="col"><?=Yii::t('app','Updated At')?></th>
                </tr>
            </thead>
            <tbody>
            <?foreach($httpResources as $httpResource):?>
                <tr>
                    <td><?= Html::a($httpResource->id, ['httpresources/httpresource', 'id' => $httpResource->id]) ?></td>
                    <td><?= Html::a($httpResource->url, $httpResource->url, ['target' => '_blank']) ?></td>
                    <td class="text-end"><?=$httpResource->attempt_frequency?></td>
                    <td class="text-end"><?=$httpResource->fail_limit?></td>
                    <td class="text-end"><?=$httpResource->fail_delay?></td>
                    <td class="text-end"><?=$httpResource->fails?></td>
                    <td><?=$httpResource->created_at?></td>
                    <td><?=$httpResource->updated_at?></td>
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