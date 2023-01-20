<?php
namespace app\models;
use yii\base\Model;

class CommentForm extends Model{
    public $comment;
    public $name;

    public function rules()
    {
        return [
            [['comment','name'],'required'],
            [['comment'],'string','length'=>[2,255]],
            [['name'],'string','length'=>[2,20]]
        ];
    }
    public function saveComment($article_id)
    {
        $comment = new Comment;
        $comment->text = $this->comment;
        $comment->user_id = $this->name;
        $comment->article_id = $article_id;
        $comment->date = date('Y-m-d');
        return $comment->save();

    }
}