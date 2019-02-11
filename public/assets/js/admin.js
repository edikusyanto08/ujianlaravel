function showLoader() {
    $('body').css('overflow', 'hidden');
    let overlay = $('<div>');
    let mainLoader = $('<div>');
    overlay.attr('id', 'loader-overlay');
    mainLoader.attr('id', 'loader');
    overlay.append(mainLoader);
    $('body').prepend(overlay);
}
$(document).ready(function() {
  $('form').on('submit', function () {
    let _this = $(this);

    if (!_this.hasClass('no-loader')) {
      showLoader();
    }
  });
  $('.select2').select2();
  $('.datepicker').pickadate({
    closeOnSelect: true,
    selectMonths: true,
    selectYears: 40,
    format: 'dd/mm/yyyy',
    today: 'Today',
    clear: 'Clear',
    close: 'Ok',
  });
  $('.timepicker').pickatime({
    default: 'now', // Set default time: 'now', '1:30AM', '16:30'
    fromnow: 0,       // set default time to * milliseconds from now (using with default = 'now')
    twelvehour: false, // Use AM/PM or 24-hour format
    donetext: 'OK', // text for done-button
    cleartext: 'Clear', // text for clear-button
    canceltext: 'Cancel', // Text for cancel-button
    autoclose: true, // automatic close timepicker
    ampmclickable: true, // make AM PM clickable
    aftershow: function(){} //Function for after opening timepicker
  });
  $('.tooltipped').tooltip({delay: 50});
  $('.modal').modal();
  $('#slide-out').perfectScrollbar();
  $('#slide-out').find('.collapsible-header').on('click', function () {
    $('#slide-out').perfectScrollbar('update');
  });
  $(".button-collapse").sideNav({
    menuWidth: 256,
  });
});
