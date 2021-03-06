document.addEventListener(
    "DOMContentLoaded", () => {
        const menu = new Mmenu( "#mmenu-nav", {
            "extensions": [
                "pagedim-black",
                "border-full",
                "theme-white"
            ],
            "navbars": [
                {
                    "position": "bottom",
                    "content": [
                        mmenu_footer
                    ]
                }
            ]
        }, {
            classNames: {
                selected: "active"
            }
        });
    }
);

function CollapseHandler() {
    const collapse = $('.footer-menu [data-toggle]');
    if (window.matchMedia('(max-width: 991px)').matches) {
        collapse.attr('data-toggle', 'collapse').siblings('.collapse-holder').collapse('hide');
        collapse.off()
    } else {
        collapse.attr('data-toggle', '').on('click', function (event) {
            event.stopPropagation();
        });
    }
}

function LowVisionLinks() {
    $('.top-panel__low-vision-toggle').on('click', function(){
        if(Cookies.get('low-vision-mode')) {
            Cookies.remove('low-vision-mode');
        } else {
            Cookies.set('low-vision-mode', 'on');
        }
        location.reload();
    });
}

$(function () {
    CollapseHandler();
    LowVisionLinks();
});

$(window).on('resize', function () {
    CollapseHandler();
});

/**
 * Инициализация поповера
 */
const initPopover = function () {
    $('[data-toggle="popover"]').popover({
        trigger: 'hover',
    });
};
initPopover();
$('[data-fancybox]').fancybox();
$('.fancybox').fancybox();

/**
 * Инициализация скрытия большого текста в отзыве
 */
// const initReviewReadMore = function () {
//     $('.review-body').readmore({
//         collapsedHeight: 188,
//         speed: 75,
//         lessLink: '<a href="javascript:void(0)" class="btn-read-more">Скрыть</a>',
//         moreLink: '<a href="javascript:void(0)" class="btn-read-more">Показать все</a>'
//     });
// };
// initReviewReadMore();

/**
 * Обработка клика по табу с цветом чекаем поле внутри
 */
$(document).on('click', '.color-tabs a', function () {
    const self = $(this);
    self.find('input').prop('checked', true);
});

/**
 * Инициализация шаринга в соц. сети
 */
const initShare = function () {
    $(".share-links").each(function (index, el) {
        el = $(el);
        const suffix = el.hasClass('share-links--black') ? '-black' : '';
        el.jsSocials({
            shares: [
                {
                    share: "facebook",
                    logo: '/images/svg/social/facebook' + suffix + '.svg',
                },
                {
                    share: "twitter",
                    logo: '/images/svg/social/twitter' + suffix + '.svg',
                },
                {
                    share: "googleplus",
                    logo: '/images/svg/social/google-plus' + suffix + '.svg',
                },
                {
                    share: "vkontakte",
                    logo: '/images/svg/social/vk' + suffix + '.svg',
                },
            ],
            showLabel: false,
            showCount: false,
            shareIn: "popup",
        })
    });
};
initShare();

/**
 * Любое завершение pjax
 */
$(document).on('pjax:complete', function () {
    // инициализируем заново поповеры
    initPopover();
    // виджет +/- в корзине
    $('.quantity-field').styler();
});

$.goup({
    bottomOffset: 50
});

svg4everybody();

$('[data-toggle="tooltip"]').tooltip();

$('.btn--video').click(function(){
    var target = $(this).attr('href');
    $('html, body').animate({scrollTop: $(target).offset().top}, 700);
    return false;
});

// Добавление товара в сравнение
$(document).on('click', '.product-card__to-compare', function () {
    const self = $(this);
    const data = {
        id: self.attr('data-id')
    };
    $.get("/shop/compare/add?id=" + self.attr('id'), data).always(function (data) {
        self.toggleClass('btn-success').toggleClass('btn-outline-success');
        $('[data-behavior="compare-count-value"]').text(data.count);
        if (data.count > 0) {
            $('[data-behavior="compare-count-value"]').removeClass('d-none').closest('li').addClass('active');
        } else {
            $('[data-behavior="compare-count-value"]').addClass('d-none').closest('li').removeClass('active');
        }
    });
    return false;
});

$('.compare-page__all-attr-link').click(function (evt) {
    evt.preventDefault();
    $('.compare-page__table tr[data-equal]').removeClass('d-none');
    $(this).addClass('active');
    $('.compare-page__diff-attr-link').removeClass('active');
});

$('.compare-page__diff-attr-link').click(function (evt) {
    evt.preventDefault();
    $('.compare-page__table tr[data-equal]').addClass('d-none');
    $(this).addClass('active');
    $('.compare-page__all-attr-link').removeClass('active');
});

// Добавление товара в избранное
$(document).on('click', '.product-card__to-favorites', function () {
    const self = $(this);
    const data = {
        product_id: self.attr('data-id')
    };
    $.post("/shop/favorites/add", data).always(function (data) {
        self.toggleClass('btn-success').toggleClass('btn-outline-success');
        $('[data-behavior="favorite-count-value"]').text(data.count);
        if (data.count > 0) {
            $('[data-behavior="favorite-count-value"]').removeClass('d-none').closest('li').addClass('active');
        } else {
            $('[data-behavior="favorite-count-value"]').addClass('d-none').closest('li').removeClass('active');
        }
    });
    return false;
});

$(document).ready(function () {

    $('.product-page__nav-tabs .nav-item:first-child .nav-link').click();

    if ($('.why-us-item').length) {
        var counterFlag = 0;

        $(window).scroll(function () {
            var oTop = $('.why-us-item').offset().top - window.innerHeight + 100;

            if (counterFlag === 0 && $(window).scrollTop() > oTop) {

                $('.why-us-item__number').countTo({
                    speed: 500,
                    refreshInterval: 1
                });

                counterFlag = 1;
            }
        });
    }

    $('.quantity-field').styler();

    $('.product-page__view-all-link, .product-page__view-set-link').click(function () {
        var thisTarget = $(this).attr('href');
        $('.product-page__nav-tabs a[href="' + thisTarget + '"]').click();
        $('html, body').animate({scrollTop: $('.product-page__nav-tabs').offset().top}, 700);
        return false;
    });

    $('.product-page__materials-link').click(function () {
        var materialsTarget = $(this).attr('href');
        $('html, body').animate({scrollTop: $(materialsTarget).offset().top}, 400);
        return false;
    });

    $('.search__open-btn').click(function () {
        $('.search__form').fadeIn();
        $('.search__field').focus();

        var searchWrap = $('.search-wrap').position().left + $('.search-wrap').outerWidth() - 1;
        $('.search__form').width(searchWrap);

        $(document).on('keydown', function (evt) {
            if (evt.keyCode === 27) {
                $('.search__form').fadeOut();
            }
        });
    });

    $('.search__close-btn').click(function () {
        $('.search__form').fadeOut();
    });

});

$(document).on('click', '.open-lead-modal', function () {
    const self = $(this);
    const modal = $(self.data('target'));
    const url  = self.attr('href') || self.data('url');
    $.get(url, function (result) {
        modal.find('.modal-content').html(result);
        modal.modal('show');
    });
    return false;
});

$(document).on('shown.bs.modal', '.lead-modal', function () {
    const btn = $('.open-lead-modal[data-loading]');
    btn.ladda('remove');
});

$(document).on('change', '#leadordergardenhouse-equipment', function () {
    $(this).closest('form').find('[hidden]').attr('hidden', false);
});

$('.product-page__carousel').owlCarousel({
    rewind: true,
    nav: true,
    dots: false,
    items: 1,
    navText: [
        '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 477.175 477.175" width="71" height="71" fill="currentColor"><path d="M145.188 238.575l215.5-215.5c5.3-5.3 5.3-13.8 0-19.1s-13.8-5.3-19.1 0l-225.1 225.1c-5.3 5.3-5.3 13.8 0 19.1l225.1 225c2.6 2.6 6.1 4 9.5 4s6.9-1.3 9.5-4c5.3-5.3 5.3-13.8 0-19.1l-215.4-215.5z"/></svg>',
        '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 477.175 477.175" width="71" height="71" fill="currentColor"><path d="M145.188 238.575l215.5-215.5c5.3-5.3 5.3-13.8 0-19.1s-13.8-5.3-19.1 0l-225.1 225.1c-5.3 5.3-5.3 13.8 0 19.1l225.1 225c2.6 2.6 6.1 4 9.5 4s6.9-1.3 9.5-4c5.3-5.3 5.3-13.8 0-19.1l-215.4-215.5z"/></svg>'
    ],
    URLhashListener: true
});

$('.page-site-faq__menu a').click(function(){
    var target = $(this).attr('href');
    $('html, body').animate({scrollTop: $(target).offset().top}, 400);
    return false;
});

$('.projects__carousel').owlCarousel({
    dots: true,
    rewind: true,
    navText: [
        '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 477.175 477.175" width="150" height="150" fill="currentColor"><path d="M145.188 238.575l215.5-215.5c5.3-5.3 5.3-13.8 0-19.1s-13.8-5.3-19.1 0l-225.1 225.1c-5.3 5.3-5.3 13.8 0 19.1l225.1 225c2.6 2.6 6.1 4 9.5 4s6.9-1.3 9.5-4c5.3-5.3 5.3-13.8 0-19.1l-215.4-215.5z"/></svg>',
        '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 477.175 477.175" width="150" height="150" fill="currentColor"><path d="M145.188 238.575l215.5-215.5c5.3-5.3 5.3-13.8 0-19.1s-13.8-5.3-19.1 0l-225.1 225.1c-5.3 5.3-5.3 13.8 0 19.1l225.1 225c2.6 2.6 6.1 4 9.5 4s6.9-1.3 9.5-4c5.3-5.3 5.3-13.8 0-19.1l-215.4-215.5z"/></svg>'
    ],
    responsive : {
        0 : {
            items: 1
        },
        576 : {
            items: 2
        },
        992 : {
            items: 3
        },
        1200 : {
            items: 3,
            nav: true
        }
    }
});

$('.main-tabs__reviews-carousel').owlCarousel({
    rewind: true,
    dots: false,
    items: 1,
    navText: [
        '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 477.175 477.175" width="150" height="150" fill="currentColor"><path d="M145.188 238.575l215.5-215.5c5.3-5.3 5.3-13.8 0-19.1s-13.8-5.3-19.1 0l-225.1 225.1c-5.3 5.3-5.3 13.8 0 19.1l225.1 225c2.6 2.6 6.1 4 9.5 4s6.9-1.3 9.5-4c5.3-5.3 5.3-13.8 0-19.1l-215.4-215.5z"/></svg>',
        '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 477.175 477.175" width="150" height="150" fill="currentColor"><path d="M145.188 238.575l215.5-215.5c5.3-5.3 5.3-13.8 0-19.1s-13.8-5.3-19.1 0l-225.1 225.1c-5.3 5.3-5.3 13.8 0 19.1l225.1 225c2.6 2.6 6.1 4 9.5 4s6.9-1.3 9.5-4c5.3-5.3 5.3-13.8 0-19.1l-215.4-215.5z"/></svg>'
    ],
    responsive : {
        1200 : {
            nav: true
        }
    }
});

$('.works__carousel').owlCarousel({
    rewind: true,
    dots: false,
    navText: [
        '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 477.175 477.175" width="150" height="150" fill="currentColor"><path d="M145.188 238.575l215.5-215.5c5.3-5.3 5.3-13.8 0-19.1s-13.8-5.3-19.1 0l-225.1 225.1c-5.3 5.3-5.3 13.8 0 19.1l225.1 225c2.6 2.6 6.1 4 9.5 4s6.9-1.3 9.5-4c5.3-5.3 5.3-13.8 0-19.1l-215.4-215.5z"/></svg>',
        '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 477.175 477.175" width="150" height="150" fill="currentColor"><path d="M145.188 238.575l215.5-215.5c5.3-5.3 5.3-13.8 0-19.1s-13.8-5.3-19.1 0l-225.1 225.1c-5.3 5.3-5.3 13.8 0 19.1l225.1 225c2.6 2.6 6.1 4 9.5 4s6.9-1.3 9.5-4c5.3-5.3 5.3-13.8 0-19.1l-215.4-215.5z"/></svg>'
    ],
    responsive : {
        0 : {
            items: 1
        },
        576 : {
            items: 2
        },
        992 : {
            items: 3
        },
        1200 : {
            items: 4,
            nav: true
        }
    }
});
