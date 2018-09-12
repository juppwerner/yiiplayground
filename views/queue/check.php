<?php
use yii\helpers\Html;

$this->title = 'Check / '.$lastJobId;
$this->params['breadcrumbs'] = ['Queue', $this->title];
$this->params['guideUrl'] = 'https://github.com/yiisoft/yii2-queue';
?>

<h1><?= Html::encode($this->title); ?></h1>

<article class="example-row">
<ul>
<li>Check whether the job is waiting for execution:&nbsp;
<?php echo (Yii::$app->queue->isWaiting($lastJobId)) ? 'yes' : 'no' ; ?></li>

<li>Check whether a worker got the job from the queue and executes it:&nbsp;
<?php echo Yii::$app->queue->isReserved($lastJobId) ? 'yes' : 'no'; ?></li>

<li>Check whether a worker has executed the job:&nbsp;
<?php echo Yii::$app->queue->isDone($lastJobId) ? 'yes' : 'no'; ?></li>

</ul>
</article>
