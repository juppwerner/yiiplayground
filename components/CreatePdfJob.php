<?php
namespace app\components;

use Yii;
use yii\base\BaseObject;
use kartik\mpdf\Pdf;

class CreatePdfJob extends BaseObject implements \yii\queue\JobInterface
{
    public $data;
    public $file;
    public $nextJob;
    
    public function execute($queue)
    {
        $pdf = Yii::$app->pdf; // or new Pdf();
        $mpdf = $pdf->api; // fetches mpdf api
        $mpdf->SetHeader('Jo Header'); // call methods or set any properties
        $mpdf->WriteHtml('<h1>Ueberschrift</h1><p>Absatz bla...</p>'); // call mpdf write html
        $path = Yii::getAlias('@data').'/'.$this->file;
        $mpdf->Output($path, \Mpdf\Output\Destination::FILE); // call the mpdf api output as needed

        if(is_array($this->nextJob)) {
            $delay = 0;
            $cfg = ['class' => $this->nextJob['__class__']];
            unset($this->nextJob['__class__']);

            // Was a delay specified?
            if(isset($this->nextJob['__delay__'])) {
                $delay = $this->nextJob['__delay__'];
                unset($this->nextJob['__delay__']);
            }
            foreach($this->nextJob as $k=>$v)
                $cfg[$k] = $v;
            if($cfg['class']=='\app\components\SendFileAsEmailJob')
                $cfg['attachment'] = $path;
            $object = Yii::createObject($cfg);
            // Create new job to send file as email attachment
            $result = Yii::$app->queue->delay($delay)->push($object);
        }

    }

}
