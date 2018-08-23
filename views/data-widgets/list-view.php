<?php
// YOUR_APP/views/list/index.php

use yii\helpers\Html;
use yii\widgets\ListView;

$this->title = 'Data Widgets / ListView';
$this->params['breadcrumbs'] = ['Data Widgets', 'ListView'];
$this->params['guideUrl'] = 'https://www.yiiframework.com/doc/guide/2.0/en/output-data-widgets#list-view';
?>

<h1><?= Html::encode($this->title); ?></h1>

<article class="example-row">

<?php Yii::$app->sc->setStart(__LINE__); ?>
    <h2>List View</h2>

    <p>This example shows how to implement the <code>ListView</code> widget.<br />
    It contains a controlelr action, a controller method to generate some fake data
    and three template files.</p>

    <div class="demo_box">
    
        <div class="row">
            <?= ListView::widget([
                'options' => [
                    'tag' => 'div',
                ],
                'dataProvider' => $listDataProvider,
                'itemView' => function ($model, $key, $index, $widget) {
                    $itemContent = $this->render('_list_item',['model' => $model]);

                    /* Display an Advertisement after the first list item */
                    if ($index == 0) {
                        $adContent = $this->render('_list_ad');
                        $itemContent .= $adContent;
                    }

                    return $itemContent;

                    /* Or if you just want to display the list item only: */
                    // return $this->render('_list_item',['model' => $model]);
                },
                'itemOptions' => [
                    'tag' => false,
                ],
                'summary' => '',
                
                /* do not display {summary} */
                'layout' => '{items}{pager}',

                'pager' => [
                    'firstPageLabel' => 'First',
                    'lastPageLabel' => 'Last',
                    'maxButtonCount' => 4,
                    'options' => [
                        'class' => 'pagination col-xs-12'
                    ]
                ],

            ]);
            ?>
        </div>

        <?php Yii::$app->sc->collect('php', Yii::$app->sc->getSourceToLine(__LINE__, __FILE__)); ?>

        <?php Yii::$app->sc->collect('php', Yii::$app->sc->getFunctionFromFile(
				'public function actionListView', Yii::getAlias('@app/controllers/DataWidgetsController.php')
			), false, false
        ); ?>
        
        <?php Yii::$app->sc->collect('php', Yii::$app->sc->getFunctionFromFile(
			   'private function getFakedModels', Yii::getAlias('@app/controllers/DataWidgetsController.php')
			), false, false
        ); ?>
        
        <?php Yii::$app->sc->collect('php', Yii::$app->sc->getSourceFromFile(
				Yii::getAlias('@app/views/data-widgets/_list_item.php')
			), false, false
        ); ?>

        <?php Yii::$app->sc->collect('php', Yii::$app->sc->getSourceFromFile(
				Yii::getAlias('@app/views/data-widgets/_list_ad.php')
			), false, false
        ); ?>
    </div>

    <?php Yii::$app->sc->renderSourceBox(); ?>

</article>
