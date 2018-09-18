<?php
namespace app\components;

use Yii;
use yii\base\BaseObject;
use kartik\mpdf\Pdf;

/**
 * @author Joachim Werner <joachim.werner@diggin-data.de> 
 */
class CreatePdfJob extends BaseJob implements \yii\queue\JobInterface
{
    public $file;
    
    public function execute($queue)
    {
        $pdf = Yii::$app->pdf; // or new Pdf();
        $mpdf = $pdf->api; // fetches mpdf api
        $mpdf->SetHeader('Jo Header'); // call methods or set any properties
        $mpdf->WriteHtml('<h1>Ueberschrift</h1><p>Absatz bla...</p>'); // call mpdf write html
        $path = Yii::getAlias('@data').'/'.$this->file;
        $mpdf->Output($path, \Mpdf\Output\Destination::FILE); // call the mpdf api output as needed

        if(!is_null($this->nextJob)) {
            if($this->nextJob['__class__']=='\app\components\SendFileAsEmailJob') {
                $this->nextJob['attachmentPaths'] = [ $path ];
            }
        }
        $this->runNextJob();
    }

}
