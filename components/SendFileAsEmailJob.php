<?php
namespace app\components;

use Yii;
use yii\base\BaseObject;

/**
 * @author Joachim Werner <joachim.werner@diggin-data.de> 
 */
class SendFileAsEmailJob extends BaseJob implements \yii\queue\JobInterface
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
        // attach files from local file system
        if(is_array($this->attachmentPaths)) {
            foreach($this->attachmentPaths as $attachment) {
                if(is_file($attachment))
                    $message->attach($attachment);        
            }
        }
        $message->send();    

    }

}
