<?php

/** @var yii\web\View $this */

use yii\helpers\Html;
use yii\widgets\LinkPager;

$this->title = Yii::t('app','Attempts');
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
                    <th scope="col"><?=Yii::t('app','HTTP Code')?></th>
                    <th scope="col"><?=Yii::t('app','Number')?></th>
                    <th scope="col"><?=Yii::t('app','Attempted At')?></th>
                </tr>
            </thead>
            <tbody>
            <?foreach($attempts as $attempt):?>
                <tr>
                    <td><?= Html::a($attempt->id, ['attempts/attempt', 'id' => $attempt->id]) ?></td>
                    <td><?= Html::a($attempt->httpResource->url, $attempt->httpResource->url, ['target' => '_blank']) ?></td>
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