<?php

use pantera\media\models\Media;
use yii\web\View;

/* @var $this View */
/* @var $models Media[] */
/* @var $showThumbs bool */
?>
<div class="synced-carousel-main owl-carousel">
    <?php foreach ($models as $model): ?>
        <div class="item">
            <a data-fancybox="images" href="<?= $model->image() ?>">
                <div class="image">
                    <img src="<?= $model->image(730, 435, $this->context->cropImages) ?>" alt="">
                </div>
            </a>
        </div>
    <?php endforeach; ?>
</div>
<?php if ($showThumbs): ?>
    <div class="synced-carousel-thumbs owl-carousel">
        <?php foreach ($models as $model): ?>
            <div class="item">
                <div class="image">
                    <img src="<?= $model->image(150, 100, $this->context->cropThumbs) ?>" alt="">
                </div>
            </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>
