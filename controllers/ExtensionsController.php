<?php
// YOUR_APP/controllers/ListController.php

/* change namespace in your app */
namespace app\controllers;

use Yii;
use app\components\BaseController;
use yii\data\ArrayDataProvider;

class ExtensionsController extends BaseController
{
    public function actionListViewInfiniteScroll()
    {
        $provider = new ArrayDataProvider([
            'allModels' => $this->getFakedModels(97),
            'pagination' => [
                'pageSize' => 10
            ],
            'sort' => [
                'attributes' => ['id'],
            ],
        ]);

        return $this->render('list-view', ['listDataProvider' => $provider]);
    }

    // function to generate faked models, don't care about this.
    private function getFakedModels($n=18)
    {
        $fakedModels = [];

        for ($i = 1; $i < $n; $i++) {
            $fakedItem = [
                'id' => $i,
                'title' => 'Title ' . $i,
                'txtBody' => 'This is really just some sample text.',
                'count' => rand(1, 20)
            ];

            $fakedModels[] = $fakedItem;
        }

        return $fakedModels;
    }
}
?>
