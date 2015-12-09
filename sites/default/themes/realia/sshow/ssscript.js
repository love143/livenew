jQuery.fn.slideShow = function (options) {
  var e = this;
  e.defaults = {
    run: 1,
    cls: ''
  };
  e.opts = jQuery.extend(e.defaults, options);
  e.par = (typeof e.opts.parent !== undefined) ? e.parent(e.opts.parent) : e;
  e.parwid = parseInt(e.par.css('width'));
  e.container = jQuery('<div>').addClass('_ss_container ' + e.opts.cls);
  e.wrap = jQuery('<div>').addClass('_ss_wrap');
  e.next = jQuery("<div>").addClass('_ss_next _ss_nav');
  e.prev = jQuery("<div>").addClass('_ss_prev _ss_nav');
  e.container.append(e.prev, e.wrap, e.next);
  e.hide().addClass('_ss_init').after(e.container);
  var _tw = 0;
  e.find('li').each(function () {
    var _d = jQuery("<div>").addClass("_ss_item").css('height', e.opts.height);
    _d.html(jQuery(this).html());
    e.wrap.append(_d);
    _d.css('width', e.par.width());
  });
  e.run = setInterval(function () {
    _tw = (_tw === (e.wrap.find('._ss_item').length - 1)) ? 0 : _tw + 1;
    e.animate(_tw * e.parwid);
  }, 5000);
  if (e.opts.run) {
    e.run;
  }
  e.init = function () {
    var e = this;
    e.wrap.css({
      height: e.opts.height,
      width: e.wrap.find('._ss_item').length * e.parwid
    });
    _tw = 0;
    e.animate = function (w) {
      e.wrap.animate({
        left: '-' + w + 'px'
      }, 1000);
    };
    e.next.off('click').on('click', function () {
      clearInterval(e.run);
      _tw = (_tw === (e.wrap.find('._ss_item').length - 1)) ? 0 : _tw + 1;
      e.animate(_tw * e.parwid);
    });
    e.prev.off('click').on('click', function () {
      clearInterval(e.run);
      _tw = (_tw === 0) ? (e.wrap.find('._ss_item').length - 1) : _tw - 1;
      e.animate(_tw * e.parwid);
    });
  };
  e.init();
  e.par.on('show', function () {
    setTimeout(e.init, 100);
  });
};
jQuery.each(['show', 'hide'], function (i, ev) {
  var el = jQuery.fn[ev];
  jQuery.fn[ev] = function () {
    this.trigger(ev);
    return el.apply(this, arguments);
  };
});