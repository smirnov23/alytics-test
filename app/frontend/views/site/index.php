<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var \frontend\models\HttpResourceForm $model */

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;

$this->title = Yii::t('app','Create HTTP resource');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-index">
    <h1><?= Html::encode($this->title) ?></h1>

    <div class="body-content">

        <div class="row">
            <div class="col-lg-5">
            <?php $form = ActiveForm::begin() ?>
                <?= $form->field($model, 'url')->textInput(['autofocus' => true, 'required' => true]) ?>
                <?= $form->field($model, 'attempt_frequency')->dropDownList(['1' => Yii::t('app','every minute'), '5' => Yii::t('app','every 5 minutes'), '10' => Yii::t('app','every 10 minutes')]) ?>
                <?= $form->field($model, 'fail_limit')->textInput(['type' => 'number', 'required' => true, 'value' => 0]) ?>
                <?= $form->field($model, 'fail_delay')->textInput(['type' => 'number', 'required' => true, 'value' => 1]) ?>
                <div class="form-group">
                    <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
                </div>
            <?php ActiveForm::end(); ?>
            </div>
        </div>

    </div>
</div>
