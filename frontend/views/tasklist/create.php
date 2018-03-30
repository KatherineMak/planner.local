<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Tasklist */

$this->title = Yii::t('app', 'Create Tasklist');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tasklists'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tasklist-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
