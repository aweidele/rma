(function($) {
  if($('.staff-list').length) {
    $('.staff-list').each(function() {
      $('a',this).on('click',function(e) {
        e.preventDefault();
        var h = $(this).prop('href') + ' .main-content';

        $('body').addClass('dialog-loading');
        $('#dialog .dialog-content').load(h, function() {
          $('body').removeClass('dialog-loading').addClass('dialog-open');
        });
      });
    });

    $('#dialog button').on('click',function() {
      $('body').removeClass('dialog-open');
    });
  }
  new Tablesort(document.getElementById('projectTable'),{
    descending: true
  });
})(jQuery);
