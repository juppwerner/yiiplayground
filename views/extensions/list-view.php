<?php
// YOUR_APP/views/list/index.php

use yii\helpers\Html;
use yii\widgets\ListView;

$this->title = 'Extensions/ ListView with Infintite Scroll';
$this->params['breadcrumbs'] = ['Extensions', 'ListView with Infinite Scroll'];
$this->params['guideUrl'] = 'https://www.yiiframework.com/extension/yii2-infinite-scroll';
?>

<h1><?= Html::encode($this->title); ?></h1>

<article class="example-row">

<?php Yii::$app->sc->setStart(__LINE__); ?>
    <h2>List View</h2>

    <p>This example shows how to implement the <code>yii2-infinite-scroll</code> widget.<br />
    It contains a controller action, a controller method to generate some fake data
    and two template files.</p>

    <div class="demo_box" style="padding:1em;">
    
        <div class="list-group">
            <?= ListView::widget([
                'id' => 'list-view-1',
                'options' => [
                    'tag' => 'div',
                ],
                'dataProvider' => $listDataProvider,
                'itemView' => function ($model, $key, $index, $widget) {
                    /* if you just want to display the list item only: */
                    return $this->render('_list_item',['model' => $model]);
                },
                'itemOptions' => [
                    'tag' => false,
                ],
                
                /* do not display {summary} */
                'layout' => "{summary}\n<div class=\"items\">{items}</div>\n{pager}",

                'pager' => [
                    'class' => nirvana\infinitescroll\InfiniteScrollPager::className(),
                    'widgetId' => 'list-view-1',
                    'itemsCssClass' => 'items',
                    'linkOptions' => [
                        'class' => 'btn btn-lg btn-block',
                    ],
                    'pluginOptions' => [
                        'loading' => [
                            'msgText' => "<em>Loading next set of items...</em>",
                            'finishedMsg' => "<em>No more items to load</em>",
                        ],
                        'behavior' => nirvana\infinitescroll\InfiniteScrollPager::BEHAVIOR_TWITTER,
                    ],
                ],                

            ]);
            ?>
        </div>

        <?php Yii::$app->sc->collect('php', Yii::$app->sc->getSourceToLine(__LINE__, __FILE__)); ?>

        <?php Yii::$app->sc->collect('php', Yii::$app->sc->getFunctionFromFile(
				'    public function actionListView', Yii::getAlias('@app/controllers/DataWidgetsController.php')
			), false, false
        ); ?>
        
        <?php Yii::$app->sc->collect('php', Yii::$app->sc->getFunctionFromFile(
			   '    private function getFakedModels', Yii::getAlias('@app/controllers/DataWidgetsController.php')
			), false, false
        ); ?>
        
        <?php Yii::$app->sc->collect('php', Yii::$app->sc->getSourceFromFile(
				Yii::getAlias('@app/views/data-widgets/_list_item.php')
			), false, false
        ); ?>

    </div>

    <?php Yii::$app->sc->renderSourceBox(); ?>

</article>
