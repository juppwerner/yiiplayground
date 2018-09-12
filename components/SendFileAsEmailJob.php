<?php
namespace app\components;

use Yii;
use yii\base\BaseObject;
use kartik\mpdf\Pdf;

class SendFileAsEmailJob extends BaseObject implements \yii\queue\JobInterface
{
    public $from;
    public $to;
    public $subject;
    public $textBody;
    public $htmlBody;
    public $attachment;
    
    public function execute($queue)
    {
        $message = Yii::$app->mailer->compose();
        $message->setFrom($this->from);
        $message->setTo($this->to);
        $message->setSubject($this->subject);
        if(!is_null($this->textBody))
            $message->setTextBody($this->textBody);
        if(!is_null($this->htmlBody))
            $message->setHtmlBody($this->htmlBody);
        // attach file from local file system
        if(!is_null($this->attachment)) {
            if(is_file($this->attachment))
                $message->attach($this->attachment);        
        }
        $message->send();    
    }

}
