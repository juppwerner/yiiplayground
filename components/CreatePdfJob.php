<?php
namespace app\components;

use Yii;
use yii\base\BaseObject;
use kartik\mpdf\Pdf;

class CreatePdfJob extends BaseObject implements \yii\queue\JobInterface
{
    public $data;
    public $file;
    
    public function execute($queue)
    {
        $pdf = Yii::$app->pdf; // or new Pdf();
        $mpdf = $pdf->api; // fetches mpdf api
        $mpdf->SetHeader('Jo Header'); // call methods or set any properties
        $mpdf->WriteHtml('<h1>Ueberschrift</h1><p>Absatz bla...</p>'); // call mpdf write html
        echo $mpdf->Output(Yii::getAlias('@data').'/'.$this->file, \Mpdf\Output\Destination::FILE); // call the mpdf api output as needed
    }

}
