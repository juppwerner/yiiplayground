<?php
namespace app\components;

use Yii;
use yii\base\BaseObject;

/**
 * @author Joachim Werner <joachim.werner@diggin-data.de> 
 */
class BaseJob extends BaseObject implements \yii\queue\JobInterface
{
    public $nextJob;
    public $attachmentPaths;
    
    public function execute($queue)
    {
    }

    public function runNextJob()
    {
        if(is_array($this->nextJob)) {
            // Get class for next job
            $cfg = ['class' => $this->nextJob['__class__']];
            unset($this->nextJob['__class__']);
            // Was a delay specified for the next job?
            $delay = 0;
            if(isset($this->nextJob['__delay__'])) {
                $delay = $this->nextJob['__delay__'];
                unset($this->nextJob['__delay__']);
            }
            // Add all other data to cfg array
            foreach($this->nextJob as $k=>$v)
                $cfg[$k] = $v;
            // Add attachment?
            // if($cfg['class']=='\app\components\SendFileAsEmailJob')
            //     $cfg['attachments'] = $this->attachmentPaths;

            $object = Yii::createObject($cfg);
            // Create new job to send file as email attachment
            if($delay==0)
                $result = Yii::$app->queue->push($object);
            else
                $result = Yii::$app->queue->delay($delay)->push($object);
        }

    }
}
