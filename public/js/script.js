$(function () {
  $(".comment_rating").rateYo({
    rating: $(this).attr("data-rating"),
    fullStar: true,
    readOnly: true
  });
});
