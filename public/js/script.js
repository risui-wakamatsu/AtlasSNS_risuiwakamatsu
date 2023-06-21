/* アコーディオンメニュー */
$(function () {
  $('.accordion').on('click', function () {
    $(this).next().slideToggle();
  });
});
