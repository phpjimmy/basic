<?php
namespace app\controllers;
use Yii;
class UploadController extends \yii\web\Controller {
    
    public function actionUpload(){
        
        $model = new \app\models\Upload();
        if(Yii::$app->request->getIsPost()){
            
           $model->imgurl = \yii\web\UploadedFile::getInstance($model, 'imgurl');
           //var_dump($model->imgurl);  
           //var_dump($_FILES);   //原生的
           
           $filename = "upload/".date("Y-m-d");
           if(!file_exists($filename)){
               mkdir($filename, 777);
           }
           //str_pad — 使用另一个字符串填充字符串为指定长度 
           $name = time().str_pad(rand(1,999),5,0,STR_PAD_RIGHT);
           //echo $name.'<br>';
           //strrchr — 查找指定字符在字符串中的最后一次出现 
           $set = strrchr($model->imgurl->name,".");
           //echo $set;
           //$model->validate()   //验证model中的rules规则
           if($model->imgurl->saveAs($filename."/".$name.$set)){   //saveAs()存储图片信息
               //echo "上传成功";
               echo "<script>alert('上传成功');</script>";
           }else{
               //echo "上传失败";
               echo "<script>alert('上传失败');</script>";
           }
           
        }
        
        return $this->render('upload',['model'=>$model]);
    }
    
}
