<?php
use yii\helpers\Url;
?>
<div class="col-md-3" data-sticky_column>
    <div class="primary-sidebar">



        <aside class="widget border pos-padding">
            <h3 class="widget-title text-uppercase text-center">Categories</h3>
            <ul>
                <?php foreach ($categories as $category):?>
                    <li>
                        <a href="<?= Url::toRoute(['site/category','id'=>$category->id]);?>"><?= $category->title?></a>
                        <span class="post-count pull-right"> <?= $category->getArticles()->count()?></span>
                    </li>
                <?php endforeach?>
            </ul>
        </aside>
        <aside class="widget border pos-padding">
            <h3 class="widget-title text-uppercase text-center">Tags</h3>

                <?php foreach ($tags as $tag):?>
                    <a href="<?= Url::toRoute(['site/tag','id'=>$tag->id]);?>" class="btn btn-default"><?= $tag->title ?></a>
                <?php endforeach ?>

        </aside>
    </div>
</div>