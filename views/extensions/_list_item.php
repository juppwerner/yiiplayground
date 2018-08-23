<?php
// Script to display a single list item
use yii\helpers\Html;
?>

<a href="#" class="list-group-item" data-key="<?= $model['id'] ?>">
    <span class="badge btn-success"><?= $model['count'] ?></span>
    <h4 class="list-group-item-heading"><?= Html::encode($model['title']); ?></h4>
    <p class="list-group-item-text">
        <?= Html::encode($model['txtBody']); ?>
    </p>
</a>
