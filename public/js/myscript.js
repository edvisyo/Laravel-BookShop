var commentForm = document.getElementById('commentForm');

function showCommentForm() {
    commentForm.style.display = "block";
}

function closeCommentForm() {
    commentForm.style.display = "none";
}


$(".toggle-password").click(function() {

  $(this).toggleClass("fa-eye fa-eye-slash");
  var input = $($(this).attr("toggle"));
  if (input.attr("type") == "password") {
    input.attr("type", "text");
  } else {
    input.attr("type", "password");
  }
});
