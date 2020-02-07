<?php
$attributes = \common\modules\shop\models\ShopProductTypeAttribute::find()
    ->andWhere(['is_for_filter' => 1])
    ->all();
?>
<form class="filter">
    <div class="filter__wrap">
        <div class="filter__main">
            <div class="row">
                <div class="col-lg-4">
                    <fieldset class="filter__item">
                        <legend class="filter__main-title">Цена, руб:</legend>
                        <div class="filter__content">
                            <div class="filter__range">
                                <input class="js-range-slider" type="text" id="js-range-slider-price">
                            </div>
                            <div class="filter__price-fields">
                                <input class="form-control filter__price-field" type="number" id="price-from" name="price-from" aria-label="Цена, от" value="380000">
                                <input class="form-control filter__price-field" type="number" id="price-to" name="price-to" aria-label="Цена, до" value="950000">
                            </div>
                        </div>
                    </fieldset>
                </div>
                <div class="col-lg-4">
                    <fieldset class="filter__item">
                        <legend class="filter__main-title">Площадь, м2:</legend>
                        <div class="filter__content">
                            <div class="filter__range">
                                <input class="js-range-slider" type="text" id="js-range-slider-area">
                            </div>
                            <div class="filter__price-fields">
                                <input class="form-control filter__price-field" type="number" id="area-from" name="area-from" aria-label="Площадь, от" value="32">
                                <input class="form-control filter__price-field" type="number" id="area-to" name="area-to" aria-label="Площадь, до" value="240">
                            </div>
                        </div>
                    </fieldset>
                </div>
                <div class="col-lg-4">
                    <fieldset class="filter__item">
                        <legend class="filter__main-title">Сортировать:</legend>
                        <div class="filter__content">
                            <div class="filter__sort-labels-wrap">
                                <label class="filter__sort-label">
                                    <input class="filter__sort-input sr-only" type="radio" name="sort" value="sort-price">
                                    <span class="filter__sort-control">по цене</span>
                                </label>
                                <label class="filter__sort-label">
                                    <input class="filter__sort-input sr-only" type="radio" name="sort" value="sort-area">
                                    <span class="filter__sort-control">по площади</span>
                                </label>
                            </div>
                        </div>
                    </fieldset>
                </div>
            </div>
        </div>
        <div class="filter__additional">
            <?php foreach ($attributes as $attribute) : ?>
                <?php $default_values = preg_split('/\n/', $attribute->default_values); ?>
                <fieldset class="filter__additional-item">
                    <legend class="filter__additional-title"><?= $attribute->name ?>:</legend>
                    <div class="filter__content">
                        <div class="filter__option-labels-wrap">
                            <?php foreach ($default_values as $value) : ?>
                                <label class="filter__option-label">
                                    <input class="filter__option-input sr-only" type="checkbox" name="filter-<?= $attribute->id ?>">
                                    <span class="filter__option-control"><?= $value ?></span>
                                </label>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </fieldset>
            <?php endforeach; ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <button class="filter__open btn btn-lg btn-block btn-primary" type="button">Все параметры</button>
        </div>
        <div class="col-sm-6">
            <button class="filter__reset btn btn-lg btn-block btn-success" type="reset">Сбросить</button>
        </div>
    </div>
</form>
