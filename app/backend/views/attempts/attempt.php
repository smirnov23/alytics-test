<?php

/** @var yii\web\View $this */

use yii\helpers\Html;

$this->title = Yii::t('app','Attempt');
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
                    <td><?=$attempt->id?></td>
                </tr>
                <tr>
                    <td><?=Yii::t('app','URL')?></td>
                    <td><?= Html::a($attempt->httpResource->url, $attempt->httpResource->url, ['target' => '_blank']) ?></td>
                </tr>
                <tr>
                    <td><?=Yii::t('app','HTTP Code')?></td>
                    <td><?=$attempt->http_code?></td>
                </tr>
                <tr>
                    <td><?=Yii::t('app','Response')?></td>
                    <td><?=Html::encode($attempt->response)?></td>
                </tr>
                <tr>
                    <td><?=Yii::t('app','Number')?></td>
                    <td><?=$attempt->number?></td>
                </tr>
                <tr>
                    <td><?=Yii::t('app','Attempted At')?></td>
                    <td><?=$attempt->created_at?></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
