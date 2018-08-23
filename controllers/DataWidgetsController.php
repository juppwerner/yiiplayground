<?php
// YOUR_APP/controllers/ListController.php

/* change namespace in your app */
namespace app\controllers;

use Yii;
use app\components\BaseController;
use yii\data\ArrayDataProvider;

class DataWidgetsController extends BaseController
{
    public function actionListView()
    {
        $provider = new ArrayDataProvider([
            'allModels' => $this->getFakedModels(),
            'pagination' => [
                'pageSize' => 5
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
                'image' => 'http://placehold.it/300x200'
            ];

            $fakedModels[] = $fakedItem;
        }

        return $fakedModels;
    }
}
?>
