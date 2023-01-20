<?php
use yii\helpers\Url;
?>
<div class="main-content">
    <div class="container">
        <div class="row">
            <div class="col-md-7">




                <?php
                foreach ($articles as $article):?>

                    <article class="post">
                    <div class="post-thumb">
                        <a href="<?=   Url::toRoute(['site/post','id'=>$article->id]);?>"><img src="<?= $article->getImage();?>" alt=""></a>

                        <a href="<?=  Url::toRoute(['site/post','id'=>$article->id]);?>" class="post-thumb-overlay text-center">
                            <div class="text-uppercase text-center">View Post</div>
                        </a>
                    </div>
                    <div class="post-content">
                        <header class="entry-header text-center text-uppercase">


                            <h1 class="entry-title"><a href="<?=  Url::toRoute(['site/post','id'=>$article->id]);?>"><?= $article->title; ?></a></h1>


                        </header>
                        <div class="entry-content">
                            <p><?= $article->description; ?>
                            </p>


                        </div>
                        <div class="social-share">
                            <span class="social-share-title pull-left text-capitalize">On <?= $article->date; ?></span>
                            <ul class="text-center pull-right">
                                <h6>Category: <a href="#"> <?= $article->category->title; ?></a></h6>
                            </ul>
                        </div>
                    </div>
                </article>
                <?php endforeach?>
   <?php

   use yii\widgets\LinkPager;
                echo LinkPager::widget([
                'pagination' => $pagination,
                ]);?>
            </div>
        <?=
        $this->render('bar',['categories'=>$categories,'tags'=>$tags]);
        ?>
        </div>
    </div>
</div>
