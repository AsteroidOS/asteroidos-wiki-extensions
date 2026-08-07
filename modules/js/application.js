/*!
 * Adapted from Bootstrap docs JavaScript
 */

$(document).ready(function() {
  $('pre').wrap('<div class="aos-bootstrap-scope"><div class="install-code-wrapper"></div></div>');
  $('.install-code-wrapper').append('<div class="clipboard-button-wrapper"></div>');
  $('.clipboard-button-wrapper').append('<input type="button" class="btn btn-primary clipboard-button" value="&#10697;"></input>');
  $(".clipboard-button").click(function() {
    var button = this;
    var codeContent = $(this).closest(".install-code-wrapper").find("pre").text();
    copyToClipboard(codeContent).then(function() {
      flashButton(button, "\u2714");
    }, function() {
      // Writing can be refused when the document is not focused or the
      // permission is denied. Say so instead of leaving the button unchanged.
      flashButton(button, "\u2717");
    });
  });
});

function flashButton(button, glyph) {
  button.value = glyph;
  setTimeout(function() {
    button.value = "\u29c9";
  }, 1000);
}

function copyToClipboard(text) {
  if (navigator.clipboard) {
    // Already a promise, and it rejects on failure.
    return navigator.clipboard.writeText(text);
  }

  // Fallback for insecure contexts. Keep the textarea out of the flow so that
  // select() does not scroll the article.
  var temp = $("<textarea>").css({ position: "fixed", top: 0, opacity: 0 }).val(text);
  $("body").append(temp);
  temp[0].select();
  var copied = document.execCommand("copy");
  temp.remove();
  var result = $.Deferred();
  return copied ? result.resolve().promise() : result.reject().promise();
}

!function ($) {

  $(function () {

    // IE10 viewport hack for Surface/desktop Windows 8 bug
    //
    // See Getting Started docs for more information
    if (navigator.userAgent.match(/IEMobile\/10\.0/)) {
      var msViewportStyle = document.createElement('style')
      msViewportStyle.appendChild(
        document.createTextNode(
          '@-ms-viewport{width:auto!important}'
        )
      )
      document.querySelector('head').appendChild(msViewportStyle)
    }

    var $window = $(window)
    var $body   = $(document.body)

    $body.scrollspy({
      target: '.sidebar',
      offset: 20 // required to select the right thing. if this is smaller then you are at the top of one section
                 // but the next section is highlighted
    });

    $window.on('load', function () {
      $body.scrollspy('refresh')
    });

    $('.source-link').each(function () {
      var id = $(this).data('content');
      var content = $('<span>').append($('#' + id)).html();
      $(this).attr('data-content', content);

      // Keep popovers open when hovered
      $(this).popover({
        trigger: 'manual',
        container: 'body',
        placement: 'left',
        template: '<div class="popover popover-source"> <div class="arrow"></div> <div class="popover-inner"> <h3 class="popover-title"></h3> <div class="popover-content"> <p></p> </div> </div> </div>',
        html: true,
        delay: {show: 50, hide: 750}
      }).on('mouseenter', function () {
        var self = this;
        $(this).popover('show');
        $(this).addClass('active');
        $(this).addClass('popover-source');

        $('.popover').on('mouseleave', function () {
          $(self).popover('hide');
          $(self).removeClass('active');
        });

      }).on('mouseleave', function () {
        var self = this;
        setTimeout(function () {
          if (!$('.popover:hover').length) {
            $(self).popover('hide');
            $(self).removeClass('active');
          }
        }, 100);
      });
    });


    // back to top
    setTimeout(function () {
      var $sideBar = $('.sidebar')

      $sideBar.affix({
        offset: {
          top: function () {
            var offsetTop      = $sideBar.offset().top
            var sideBarMargin  = parseInt($sideBar.children(0).css('margin-top'), 10)
            var navOuterHeight = $('.docs-nav').height()

            return (this.top = offsetTop - navOuterHeight - sideBarMargin)
          },
          bottom: function () {
            return (this.bottom = $('.footer').outerHeight(true))
          }
        }
      })
    }, 100);

    setTimeout(function () {
      $('.top').affix()
    }, 100);

  })

}(jQuery)
