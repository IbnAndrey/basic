<?php
use yii\helpers\Url;

?>
<div class="main-content">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <article class="post">
                    <div class="post-thumb">
                        <a href="#"><img src="<?= $article->getImage();?>" alt=""></a>
                    </div>
                    <div class="post-content">
                        <header class="entry-header text-center text-uppercase">
                            <h6><a> <?= $article->category->title; ?></a></h6>

                            <h1 class="entry-title"><a><?= $article->title; ?></a></h1>


                        </header>
                        <div class="entry-content">
                            <?= $article->content; ?>
                        </div>
                        <div class="decoration">
                            <?php foreach ($article->tags as $tag):?>
                            <a href="<?= Url::toRoute(['site/tag','id'=>$tag->id]);?>" class="btn btn-default"><?= $tag->title ?></a>
                            <?php endforeach ?>
                        </div>

                        <div class="social-share">
							<span
                                class="social-share-title pull-left text-capitalize">On <?= $article->date; ?></span>

                        </div>
                    </div>
                </article>
                <?php if(!empty($comments)):?>
                    <h4><?= count($comments)?> comments</h4>
                <?php foreach ($comments as $comment):?>
                    <div class="bottom-comment"><!--bottom comment-->


                        <div class="comment-text">
                            <h5><?= $comment->user_id?></h5>

                            <p class="comment-date">
                                <?= $comment->date?>
                            </p>


                            <p class="para"><?= $comment->text; ?></p>
                        </div>
                    </div>


                <?php endforeach ?>
                <?php endif?>


                <div class="leave-comment"><!--leave comment-->
                    <h4>Leave a comment</h4>
                    <?php $form = \yii\widgets\ActiveForm::begin([
                        'action'=>['site/comment', 'id'=>$article->id],
                        'options'=>['class'=>'form-horizontal contact-form', 'role'=>'form']])?>


                        <div class="form-group">
                            <div class="col-md-6">
                                <?= $form->field($commentForm, 'name')->textInput(['class'=>'form-control','placeholder'=>'Name'])->label(false)?>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12">
                                <?= $form->field($commentForm, 'comment')->textarea(['class'=>'form-control','placeholder'=>'Write Message'])->label(false)?>
                            </div>
                        </div>
                        <button type="submit" class="btn send-btn">Send</button>
                    <?php \yii\widgets\ActiveForm::end();?>
                </div><!--end leave comment-->
            </div>
            <?=
            $this->render('bar',['categories'=>$categories,'tags'=>$tags]);
            ?>
        </div>
    </div>
</div>