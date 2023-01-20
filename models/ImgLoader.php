<?php
namespace app\models;
use Yii;
use yii\base\Model;
use yii\debug\models\router\CurrentRoute;
use yii\web\UploadedFile;

class ImgLoader extends Model{
    public $image;

    public function rules()
    {
        return [
            [['image'],'required'],
            [['image'],'file','extensions'=>'png,jpg']
        ];
    }

    public function upload(UploadedFile $file,$currentImg)
    {
        $this->image=$file;
        if($this->validate()) {
            if ($this->isExists($currentImg))
            unlink($this->getDirectory(). $currentImg);
            $filename = md5(uniqid($file->baseName)) . '.' . $file->extension;
            $file->saveAs($this->getDirectory() . $filename);
            return $filename;
        }
    }
    public function isExists($image)
    {
        if($image!=null) return file_exists($this->getDirectory(). $image);
    }
    public function getDirectory()
    {
            return Yii::getAlias('@web') . 'images/';
    }
    public function delete($image)
    {
        if($this->isExists($image))
        unlink($this->getDirectory(). $image);
    }

}