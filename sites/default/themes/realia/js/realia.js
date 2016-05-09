(function ($, Drupal, window, document, undefined) {
  $(document).ready(function () {
    //Global Variable
    var initValue;

    //Executables
    // removes and replaces text in input fields when clicked
    $('input').blur(function () {
      if ($(this).attr('value').length == 0) {
        $(this).attr('value', initValue);
      }
      initValue = '';
    });
    $('input:not(input[type="button"], input[type="reset"], input[type="submit"])').focus(function () {
      if ($(this).attr('value').length > 0) {
        initValue = $(this).attr("value");
        $(this).attr('value', '');
      }
    });
    //inits and creates lightbox effects for images

    if (jQuery('#MyGmaps').length) {
      LoadGmaps();
    }

    function svgLivenew() {
      if ($(".svg-livenew").length) {
        if ($(window).width() < 768) {
          $(".svg-livenew")[0].setAttribute("viewBox", "0 0 500 600");
        } else {
          $(".svg-livenew")[0].setAttribute("viewBox", "0 0 1000 600");
        }
      }
    }

    $(window).resize(svgLivenew);
    svgLivenew();

  });

  function LoadGmaps() {

    var myOptions = {
      zoom: 9,
      draggable: false,
      disableDefaultUI: false,
      panControl: false,
      scrollwheel: false,
      zoomControl: false,
      zoomControlOptions: {
        style: google.maps.ZoomControlStyle.DEFAULT
      },
      mapTypeControl: false,
      mapTypeControlOptions: {
        style: google.maps.MapTypeControlStyle.HORIZONTAL_BAR
      },
      streetViewControl: false,
      mapTypeId: google.maps.MapTypeId.ROADMAP,
      center: {lat: 35.227322, lng: -80.841522}
    },
    infoWindow = new google.maps.InfoWindow({
      content: ""
    }),
    bounds = new google.maps.LatLngBounds();

    var map = new google.maps.Map(document.getElementById('MyGmaps'), myOptions);

    google.maps.event.addDomListener(window, "resize", function () {
      var center = map.getCenter();
      google.maps.event.trigger(map, "resize");
      map.setCenter(center);
    });

    var url = location.origin + '/sites/default/themes/realia/libraries/livewellcounties.json'
    map.data.loadGeoJson(url);
    $.ajax({
      url: url,
      dataType: 'JSON',
      success: function(data) {
        var lat = {}, lng = {};
        $(data.features).each(function(key,feature) {
          $(feature.geometry.coordinates[0]).each(function(key,val) {
            lng['max'] = (!lng['max'] || Math.abs(lng['max']) > Math.abs(val[0])) ? val[0] : lng['max'];
            lng['min'] = (!lng['min'] || Math.abs(lng['min']) < Math.abs(val[0])) ? val[0] : lng['min'];
            lat['max'] = (!lat['max'] || Math.abs(lat['max']) > Math.abs(val[1])) ? val[1] : lat['max'];
            lat['min'] = (!lat['min'] || Math.abs(lat['min']) < Math.abs(val[1])) ? val[1] : lat['min'];
          });
        });
        var bounds = new google.maps.LatLngBounds();
        bounds.extend(new google.maps.LatLng(lat.min - 0.01, lng.min - 0.01));
        bounds.extend(new google.maps.LatLng(lat.max - 0.01, lng.max - 0.01));
        map.fitBounds(bounds);
        map.setCenter(bounds.getCenter());
      }
    });

    map.data.setStyle(function(feature) {
      var color = '#FF9A38';
      if (feature.getProperty('isColorful')) {
        color = '#65A700';
      }
      return /** @type {google.maps.Data.StyleOptions} */({
        fillColor: color,
        strokeColor: '#FFFFFF',
        strokeWeight: 2,
        fillOpacity: .7
      });
    });   

    map.data.addListener('click', function(event) {
      map.setCenter();
      infoWindow.setContent("<div class='mygmaps-info'><h3>"+event.feature.N.name+"</h3>"+event.feature.N.description+"</div>");
      var anchor = new google.maps.MVCObject();
      anchor.set("position",event.latLng);
      infoWindow.open(map,anchor);
    });
    map.data.addListener('mouseover', function(event) {
      map.data.revertStyle();
      event.feature.setProperty('isColorful', true);
          // map.data.overrideStyle(event.feature, {strokeWeight: 8});
        });
    map.data.addListener('mouseout', function(event) {
      map.data.revertStyle();
      event.feature.setProperty('isColorful', false);
    });

    var labels = [
    {label: "York", lat: "34.992597", long: "-81.243896"},
    {label: "Gaston", lat: "35.281921", long: "-81.192398"},
    {label: "Mecklenburg", lat: "35.227322", long: "-80.841522"},
    {label: "Union", lat: "34.970797", long: "-80.509186"},
    {label: "Cabarrus", lat: "35.372465", long: "-80.549011"},
    {label: "Iredell", lat: "35.774581", long: "-80.888214"},
    ];

    labels.forEach(function (entry) {

      var mapLabel = new MapLabel({
        text: entry["label"],
        position: new google.maps.LatLng(entry["lat"], entry["long"]),
        map: map,
        fontSize: 16,
        align: 'center',
        zIndex: 999,
      });

    });
  }

  // Blog width fixer for mobile view
  $(document).ready(blogTitleFix);
  $(window).resize(blogTitleFix);
  function blogTitleFix() {
    var w = $(window);
    var e = $('body.page-blog .span12 .span6.blog-wrapper');
    if (e.length) {
      if (w.width() <= 769) {
        e.find("[class^='blog-item-']").width(w.width() - (e.outerWidth(true) - e.width()));
      } else {
        e.find("[class^='blog-item-']").css('width', '100%');
      }
    }
  }

// do not put any code between these two lines
})(jQuery, Drupal, this, this.document);

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
      e.closest(".taxonomy-term-features").find('img').each(function () {
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