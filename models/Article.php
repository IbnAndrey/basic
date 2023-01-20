<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "article".
 *
 * @property int $id
 * @property string|null $title
 * @property string|null $description
 * @property string|null $content
 * @property string|null $date
 * @property string|null $image
 * @property int|null $category_id
 *
 * @property ArticleTag[] $articleTags
 * @property Comment[] $comments
 */
class Article extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'article';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['title','description','content'], 'string'],
            [['date'], 'date', 'format'=>'php:Y-m-d'],
            [['date'], 'default', 'value' => date('Y-m-d')],
            [['title'], 'string', 'max' => 255],
            [['category_id'], 'number']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'description' => 'Description',
            'content' => 'Content',
            'date' => 'Date',
            'image' => 'Image',
            'category_id' => 'Category ID',
        ];
    }

    public function saveImage($filename)
    {
        $this->image=$filename;
        return $this->save(false);
    }
    public function deleteImage()
    {
        $imgUploadModel = new ImgLoader();
        $imgUploadModel->delete($this->image);
    }
    public function getImage()
    {
    if($this->image) return '/images/'.$this->image;
    return '/images/default.jpg';
    }
    public function beforeDelete()
    {
        $this->deleteImage();
        return parent::beforeDelete();
    }
    public function getCategory()
    {
        return $this->hasOne(Category::className(),['id'=>'category_id']);
    }
    public function saveCategory($categoryId)
    {
        $category=Category::findOne($categoryId);
        if($category!=null)
        {
            $this->link('category',$category);
            return true;
        }
    }
    public function getTags()
    {
        return $this->hasMany(Tag::class, ['id' => 'tag_id'])
            ->viaTable('article_tag', ['article_id' => 'id']);
    }
   public function getSelectedTags()
    {
       $selectedIds=$this->getTags()->select('id')->asArray()->all();
       return ArrayHelper::getColumn($selectedIds,'id');
    }
    public function saveTags($tags)
    {
        if(is_array($tags)) {
            ArticleTag::deleteAll(['article_id'=>$this->id]);
            foreach ($tags as $tagId)
                $this->link('tags', Tag::findOne($tagId));
        }
    }
    public function getComments()
    {
        return $this->hasMany(Comment::class,['article_id'=>'id']);
    }
}
