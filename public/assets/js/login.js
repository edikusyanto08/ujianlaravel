function showLoader() {
  $('body').css('overflow', 'hidden');
  let overlay = $('<div>');
  let mainLoader = $('<div>');
  overlay.attr('id', 'loader-overlay');
  mainLoader.attr('id', 'loader');
  overlay.append(mainLoader);
  $('body').append(overlay);
}
$(document).ready(function () {
  $('form').on('submit', function () {
    showLoader();
  });
});
