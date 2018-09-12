<?php

namespace app\controllers;

use Yii;
use app\components\BaseController;
use app\components\CreatePdfJob;

class QueueController extends BaseController
{
    public function actionIndex()
    {
        return $this->render('index');

    }
    
    public function actionPush() 
    {
        $result = Yii::$app->queue->push(new CreatePdfJob([
            'file' => date('Y-m-d_His').'.pdf',
        ]));
        Yii::$app->session->addFlash('success', 'New job CreatePdfJob pushed to queue'.'<br>Job ID: '.\yii\helpers\VarDumper::dumpAsString($result, 10, true));
        $this->redirect(['index', 'lastJobId'=>$result]);
    }

    public function actionPushDelayed() 
    {
        // To push a job into the queue that should run after 1 minutes:
        $result = Yii::$app->queue->delay(1 * 60)->push(new CreatePdfJob([
            'file' => date('Y-m-d_His').'.pdf',
        ]));
        Yii::$app->session->addFlash('success', 'New job CreatePdfJob pushed to queue'.'<br>Job ID: '.\yii\helpers\VarDumper::dumpAsString($result, 10, true));
        $this->redirect(['index', 'lastJobId'=>$result]);
    }

    public function actionCheck($lastJobId) {
        return $this->render('check', ['lastJobId'=>$lastJobId]);
    }
}
