<?php

namespace app\controllers;

use app\models\Article;
use app\models\ArticleTag;
use app\models\Category;
use app\models\Tag;
use app\models\CommentForm;
use Yii;
use yii\data\Pagination;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */

    public function actionIndex()
    {
        // build a DB query to get all articles
        $query = Article::find();
// get the total number of articles (but do not fetch the article data yet)
        $count = $query->count();
// create a pagination object with the total count
        $pagination = new Pagination(['totalCount' => $count,'pageSize'=>5]);
// limit the query using the pagination and retrieve the articles
        $articles = $query->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();
        return $this->render('index',['articles'=>$articles,'pagination'=>$pagination,'categories'=>Category::find()->all(),'tags'=>Tag::find()->all()]);
    }
    public function actionCategory($id)
    {
        $query = Article::find()->where(['category_id'=>$id]);
        $count = $query->count();
        $pagination = new Pagination(['totalCount' => $count,'pageSize'=>5]);
        $articles = $query->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();
        return $this->render('index',['articles'=>$articles,'pagination'=>$pagination,'categories'=>Category::find()->all(),'tags'=>Tag::find()->all()]);
    }
    public function actionTag($id)
    {
        $query = Tag::findOne($id)->getArticles();
        /*$query = ArticleTag::find()->where(['tag_id'=>$id])->all();
        $query = Article::find()->where(['category_id'=>$id]);*/
        $count = $query->count();

        $pagination = new Pagination(['totalCount' => $count,'pageSize'=>3]);
        $articles = $query->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();
        return $this->render('index',['articles'=>$articles,'pagination'=>$pagination,'categories'=>Category::find()->all(),'tags'=>Tag::find()->all()]);
    }
    /**
     * Login action.
     *
     * @return Response|string
     */


    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }
    public function actionPost($id)
    {
        $article=Article::findOne($id);
        $comments= $article->comments;
        $commentForm = new CommentForm();
        return $this->render('post',[
            'article'=>$article,
            'categories'=>Category::find()->all(),
            'tags'=>Tag::find()->all(),
            'comments'=>$comments,
            'commentForm'=>$commentForm]);
    }
    public function actionComment($id)
    {
        $model = new CommentForm();

        if(Yii::$app->request->isPost)
        {
            $model->load(Yii::$app->request->post());
            if($model->saveComment($id))
            {
                return $this->redirect(['site/post','id'=>$id]);
            }
        }
        return $this->redirect(['site/error','id'=>$id]);
    }

}
