<?php

use common\modules\catalog\models\CatalogCategory;
use common\modules\shop\widgets\cart\miniCart\MiniCartWidget;
use frontend\themes\woodland\AppAsset;
use frontend\themes\woodland\widgets\megaMenu\MegaMenu;
use frontend\widgets\twigRender\TwigRender;
use pantera\leads\widgets\form\LeadForm;
use yii\helpers\Html;
use yii\helpers\Url;

if ((Yii::$app->controller->id === 'site' && Yii::$app->controller->action->id === 'error') === false) {
    $this->registerLinkTag([
        'rel' => 'canonical',
        // так было, вроде правильно, но выдавало
        // технические адреса, т.к. UrlManager
        // для наших модулей не в полной мере корректен..
        // 'href' => Url::canonical(),

        // так сделано сейчас
        // TODO: надо когда-нибудь сделать, чтобы Url::canonical() возвращал корректные url-ы
        'href' => Url::to([preg_replace('/\?.*$/', '', Yii::$app->request->url)], true),
    ]);
}
$this->registerLinkTag([
    'rel' => 'icon',
    'type' => 'icon',
    'href' => '/favicon.ico',
]);

AppAsset::register($this);
$this->beginPage();

/* @var $this \yii\web\View */
/* @var $content string */
?><!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#49d074">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <style>
        <?= Yii::$app->settings->get('css', 'default') ?>
    </style>
</head>
<body class="page-<?= $_SERVER['REQUEST_URI'] == '/' ? 'front' : str_replace('/', '-', trim($_SERVER['REQUEST_URI'], '/')) ?>">
<?php $this->beginBody() ?>
<?= $this->render('_header') ?>

<?= MegaMenu::widget() ?>

<nav id="mmenu-nav">
    <ul>
        <?php
        $catalogIsActive = preg_match('/catalog/', Yii::$app->request->pathInfo);
        $brandsIsActive = preg_match('/^brands/', Yii::$app->request->pathInfo);
        ?>
        <li class="<?= $catalogIsActive ? 'active' : '' ?>" id="main-menu-catalog">
            <a href="<?= Url::to(['/shop/catalog/index']) ?>">
                Проекты
            </a>
            <?php if (($catalogRoot = \common\modules\shop\models\ShopCategory::findOne(1)) && ($categories = $catalogRoot->getChildren()->active()->inMenu()->all())): ?>
                <ul>
                    <?php foreach ($categories as $category): ?>
                        <li>
                            <a href="<?=$category->present()->getUrl()?>"><?= $category->name ?></a>
                            <?php if ($lvl2cats = $category->getChildren()->active()->inMenu()->all()): ?>
                                <ul>
                                    <?php foreach ($lvl2cats as $lvl2cat): ?>
                                        <li>
                                            <a href="<?= $lvl2cat->present()->getUrl() ?>"><?= $lvl2cat->name ?></a>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            <?php endif; ?>
                        </li>
                    <?php endforeach;?>
                </ul>
            <?php endif; ?>
        </li>

        <?php if ($parent = CatalogCategory::findOne(241)) : ?>
            <li class="<?= Yii::$app->request->pathInfo === $parent->slug ? 'active' : '' ?>">
                <a href="<?= $parent->present()->getUrl() ?>">
                    <?= Html::encode($parent->name) ?>
                </a>
                <?php if ($childs = $parent->getChildren()->isInMenu()->isActive()->all()) : ?>
                    <ul>
                        <?php foreach ($childs as $child): ?>
                            <li>
                                <?= Html::a($child->name, $child->present()->getUrl()) ?>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
            </li>
        <?php endif; ?>

        <?php if ($parent = CatalogCategory::findOne(235)) : ?>
            <li class="<?= Yii::$app->request->pathInfo === $parent->slug ? 'active' : '' ?>">
                <a href="<?= $parent->present()->getUrl() ?>">
                    <?= Html::encode($parent->name) ?>
                </a>
                <?php if ($childs = $parent->getChildren()->isInMenu()->isActive()->all()) : ?>
                    <ul>
                        <?php foreach ($childs as $child): ?>
                            <li>
                                <?= Html::a($child->name, $child->present()->getUrl()) ?>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
            </li>
        <?php endif; ?>

        <?php if ($parent = CatalogCategory::findOne(237)) : ?>
            <li class="<?= Yii::$app->request->pathInfo === $parent->slug ? 'active' : '' ?>">
                <a href="<?= $parent->present()->getUrl() ?>">
                    <?= Html::encode($parent->name) ?>
                </a>
                <?php if ($childs = $parent->getChildren()->isInMenu()->isActive()->all()) : ?>
                    <ul>
                        <?php foreach ($childs as $child): ?>
                            <li>
                                <?= Html::a($child->name, $child->present()->getUrl()) ?>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
            </li>
        <?php endif; ?>

        <?php if ($parent = CatalogCategory::findOne(238)) : ?>
            <li class="<?= Yii::$app->request->pathInfo === $parent->slug ? 'active' : '' ?>">
                <a href="<?= $parent->present()->getUrl() ?>">
                    <?= Html::encode($parent->name) ?>
                </a>
                <?php if ($childs = $parent->getChildren()->isInMenu()->isActive()->all()) : ?>
                    <ul>
                        <?php foreach ($childs as $child): ?>
                            <li>
                                <?= Html::a($child->name, $child->present()->getUrl()) ?>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
            </li>
        <?php endif; ?>

        <?php if ($parent = CatalogCategory::findOne(234)) : ?>
            <li class="<?= Yii::$app->request->pathInfo === $parent->slug ? 'active' : '' ?>">
                <a href="<?= $parent->present()->getUrl() ?>">
                    <?= Html::encode($parent->name) ?>
                </a>
                <?php if ($childs = $parent->getChildren()->isInMenu()->isActive()->all()) : ?>
                    <ul>
                        <?php foreach ($childs as $child): ?>
                            <li>
                                <?= Html::a($child->name, $child->present()->getUrl()) ?>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
            </li>
        <?php endif; ?>

        <?php if ($parent = CatalogCategory::findOne(243)) : ?>
            <li class="<?= Yii::$app->request->pathInfo === $parent->slug ? 'active' : '' ?>">
                <a href="<?= $parent->present()->getUrl() ?>">
                    <?= Html::encode($parent->name) ?>
                </a>
                <?php if ($childs = $parent->getChildren()->isInMenu()->isActive()->all()) : ?>
                    <ul>
                        <?php foreach ($childs as $child): ?>
                            <li>
                                <?= Html::a($child->name, $child->present()->getUrl()) ?>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
            </li>
        <?php endif; ?>

        <?php $favoriteCount = \common\modules\shop\models\ShopProductFavorite::getCount() ?>
        <li>
            <a href="<?= Url::to(['/favorite']) ?>">
                <span>Избранное</span>
                <span class="mmenu-count<?= !$favoriteCount ? ' d-none' : '' ?>" data-behavior="favorite-count-value"><?= $favoriteCount ?></span>
            </a>
        </li>

        <?php $compareCount = \common\modules\shop\models\ShopProductCompare::getCount() ?>
        <li>
            <a href="<?= Url::to(['/compare']) ?>">
                <span>Сравнение</span>
                <span class="mmenu-count<?= !$compareCount ? ' d-none' : '' ?>" data-behavior="compare-count-value"><?= $compareCount ?></span>
            </a>
        </li>

        <li>
            <?= MiniCartWidget::widget([
                'layout' => '<a href="{url}">
                            <span>Корзина</span>
                            <span class="mmenu-count" data-behavior="cart-count-value">{count}</span>
                        </a>',
            ])?>
        </li>
    </ul>
</nav>

<div class="wrap">
    <?= TwigRender::widget([
        'text' => $content,
    ]) ?>
</div>

<?php if (0) : ?>
<div class="section-subcribe">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="section-subcribe__title">Подпишитесь на наши новости</div>
                <div class="section-subcribe__hint">Рекомендации по лечению, новые препараты, истории успешного лечения и другое!</div>
            </div>
            <div class="col-md-6">
                <?= LeadForm::widget([
                    'key' => 'subscribe',
                    'mode' => LeadForm::MODE_INLINE,
                ]) ?>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>

<?= $this->render('_footer') ?>

<?php $this->endBody() ?>
<script>
    const mmenu_footer = `<?= trim($this->context->renderPartial('@theme/views/_mmenu-footer')) ?>`;
</script>
<?= Yii::$app->settings->get('script', 'default') ?>
</body>
</html>
<?php $this->endPage() ?>
