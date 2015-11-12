Drupal.behaviors.languageSwitch = {
  attach: function (context, settings) {
    var languageSwitch = jQuery('#block-realia-blocks-realia-language', context);
    jQuery('.expand', languageSwitch).hide();

    languageSwitch.hover(
            function () {
              jQuery('.expand', languageSwitch).show();
            },
            function () {
              jQuery('.expand', languageSwitch).hide();
            }
    );

    var min = parseInt(jQuery('#edit-field-price-value-min').val());
    var max = parseInt(jQuery('#edit-field-price-value-max').val());

    jQuery('#edit-field-price-value-wrapper label', context).append('<span class="price"><span class="value"><span class="from">' + min + '</span> - <span class="to">' + max + '</span></span></span>');
    jQuery('#edit-field-price-value-wrapper .price .value .to', context).currency({region: settings.theme.currency, thousands: ' ', decimal: ',', decimals: 0, prefix: settings.theme.prefix})
    jQuery('#edit-field-price-value-wrapper .price .value .from', context).currency({region: settings.theme.currency, thousands: ' ', decimal: ',', decimals: 0, prefix: settings.theme.prefix})

    jQuery('#edit-field-price-value-wrapper .views-widget', context).slider({
      range: true,
      min: min,
      max: max,
      values: [min, max],
      slide: function (event, ui) {
        jQuery('#edit-field-price-value-min').attr('value', ui.values[0]);
        jQuery('#edit-field-price-value-max').attr('value', ui.values[1]);

        jQuery('#edit-field-price-value-wrapper .price .value .from').text(ui.values[0]);
        jQuery('#edit-field-price-value-wrapper .price .value .from').currency({region: settings.theme.currency, thousands: ' ', decimal: ',', decimals: 0, prefix: settings.theme.prefix_currency});

        jQuery('#edit-field-price-value-wrapper .price .value .to').text(ui.values[1]);
        jQuery('#edit-field-price-value-wrapper .price .value .to').currency({region: settings.theme.currency, thousands: ' ', decimal: ',', decimals: 0, prefix: settings.theme.prefix_currency});
      }
    });

    jQuery('#btn-nav', context).click(function (e) {
      jQuery('body').toggleClass('nav-open');
      e.preventDefault();
    });

    jQuery('input[type="checkbox"]', context).ezMark();
    jQuery('input[type="radio"]', context).ezMark();
    jQuery('select:visible', context).chosen({disable_search_threshold: 10});

    if (jQuery.cookie !== undefined) {
      if (jQuery.cookie('palette') == 'off') {
        jQuery('#aviators-palette').addClass('closed');
      }

      jQuery('#aviators-palette .toggle', context).live('click', function (e) {
        e.preventDefault();
        if (jQuery.cookie('palette') == 'off') {
          jQuery.cookie('palette', 'on');
        } else {
          jQuery.cookie('palette', 'off');
        }

        jQuery(this).parent().toggleClass('closed');
        jQuery('#aviators-palette').css({'margin-left': '0px'});
      });
    }
  }
};
Drupal.behaviors.contentTrim = {
  attach: function (context, settings) {
    var length = 250;
    var e = jQuery(".communities-content .views-field");
    e.each(function () {
      var _e = jQuery(this).find('.truncate-dynamic');
      strTrunc(_e, length);
    });
    jQuery(document.body).on('click', "._read_more_", function () {
      var _e = jQuery(this);
      strTrunc(_e.parent(), 0);
    });
    jQuery(document.body).on('click', "._read_less_", function () {
      var _e = jQuery(this);
      strTrunc(_e.parent(), length);
    });
    function strTrunc(_e, length) {
      if (length > 0 && _e.text().length > length) {
        var _str = _e.text();
        var _desc = _str.substring(0, length);
        _e.html(_desc + '...&nbsp;&nbsp;').append(jQuery("<a class='_read_more_' href='javascript:void(0)'>").text('read more'));
        if (!_e.attr('content')) {
          _e.attr('content', _str);
        }
      } else if (length === 0) {
        _e.html(_e.attr('content') + '&nbsp;&nbsp;').append(jQuery("<a class='_read_less_' href='javascript:void(0)'>").text('read less'));
      }
    }
  }
};
Drupal.behaviors.featuresImage = {
  attach: function (context, settings) {
    jQuery(context).on('click', '.taxonomy-term .taxonomy-term-features img', function () { // .featuresImage
      var e = jQuery(this);
      var _body = jQuery('body');
      var _mask = jQuery('<div>').addClass('featured-mask');
      var _prev = jQuery('<div>').addClass('featured-prev nav');
      var _next = jQuery('<div>').addClass('featured-next nav');
      var _close = jQuery('<div>').addClass('featured-close nav');
      var _download = jQuery('<a>').addClass('featured-download nav');
      var _vUl = Array();
      var _tUl = Array();
      var _pointer = 0;
      e.closest(".taxonomy-term-features").each(function () {
        _vUl.push(this.src);
        _tUl.push(this.title);
      });
      var _wrap = jQuery('<div>').addClass('featured-wrap');
      featuredImg();
      _body.append(_mask.append(_wrap, _prev, _next, _close, _download));
      _close.on('click', featuredClose);
      _next.on('click', featuredNext);
      _prev.on('click', featuredPrev);
      jQuery(context).keydown(function (e) {
        var _key = e.which || e.keyCode;
        switch (_key) {
          case 27:
            featuredClose();
            break;
          case 37:
            featuredPrev();
            break;
          case 39:
            featuredNext();
            break;
        }
      });
      jQuery('body').css({
        overflow: 'hidden'
      });
      function featuredClose() {
        jQuery('body').css({
          overflow: 'initial'
        });
        _mask.remove();
      }
      function featuredNext() {
        _pointer = (_pointer === (_vUl.length - 1)) ? 0 : _pointer + 1;
        featuredImg();
      }
      function featuredPrev() {
        _pointer = (_pointer - 1 < 0) ? _vUl.length - 1 : _pointer - 1;
        featuredImg();
      }
      function featuredImg() {
        _wrap.css({
          'background-image': "url('" + _vUl[_pointer] + "')"
        });
        _download.attr({
          href: _vUl[_pointer],
          download: _tUl[_pointer]
        });
      }
      var addSwipeTo = function (selector) {
        jQuery(selector).swipe("destroy").swipe({
          swipe: function (event, direction) {
            if (direction === 'right') {
              featuredPrev();
            } else if (direction === 'left') {
              featuredNext();
            }
          },
          threshold: 0
        });
      };
      addSwipeTo(".featured-wrap");
    });
  }
};