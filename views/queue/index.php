<?php
use yii\helpers\Html;

$this->title = 'Queue';
$this->params['breadcrumbs'] = ['Overview', $this->title];
$this->params['guideUrl'] = 'https://github.com/yiisoft/yii2-queue';
?>

<h1><?= Html::encode($this->title); ?></h1>

<article class="example-row">

    <h2>List View</h2>
    <div class="demo_box">
    
        <div class="row">

            <ul>
            <li><?= Html::a('Push CreatePdfJob', ['push']) ?></li>
            <li><?= Html::a('Push Delayed CreatePdfJob', ['push-delayed']) ?></li>
            <li><?= Html::a('Push CreatePdfJob, followed by SendFileAsEmailJob', ['push-with-next']) ?></li>
            <?php if(isset($_GET['lastJobId'])) : ?>
            <?php $lastJobId = $_GET['lastJobId']; ?>
            <li><?= Html::a('Check Job:  #'.$lastJobId, ['check', 'lastJobId'=>$lastJobId]) ?></li>
            <?php endif; ?>
            </ul>
        </div>
    </div>

    <h2>Configuration</h2>
    <?php Yii::$app->sc->collect('php', Yii::$app->sc->getSnippetFromFile(
        '\'aliases\' => [', '// end aliases', 
        Yii::getAlias('@app/config/console.php'), 4
        ), false, false
    ); ?>
    <?php Yii::$app->sc->collect('php', Yii::$app->sc->getSnippetFromFile(
        '// Krajee Pdf component:', '// end pdf', 
        Yii::getAlias('@app/config/console.php'), 8
        ), false, false
    ); ?>
    <?php Yii::$app->sc->collect('php', Yii::$app->sc->getSnippetFromFile(
        '// Queue component:', '// end queue', 
        Yii::getAlias('@app/config/console.php'), 8
        ), false, false
    ); ?>
    <?php Yii::$app->sc->renderSourceBox(); ?>

    <h2>Job Definition and Execution</h2>
    <?php Yii::$app->sc->collect('php', Yii::$app->sc->getSourceFromFile(
            Yii::getAlias('@app/components/CreatePdfJob.php')
        ), false, false
    ); ?>
    <?php Yii::$app->sc->collect('php', Yii::$app->sc->getFunctionFromFile(
            '    public function actionPush',
            Yii::getAlias('@app/controllers/QueueController.php')
        ), false, false
    ); ?>
    <?php Yii::$app->sc->renderSourceBox(); ?>

</article>
