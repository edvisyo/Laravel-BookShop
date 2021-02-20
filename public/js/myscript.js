var commentForm = document.getElementById('commentForm');

function showCommentForm() {
    commentForm.style.display = "block";
}

function closeCommentForm() {
    commentForm.style.display = "none";
}

function readUploadFileUrl(input)
{
  if(input.files && input.files[0])
  {
    var reader = new FileReader();
    reader.onload = function(e)
    {
      $('#uploadedImage').attr('src', e.target.result);
    }
    reader.readAsDataURL(input.files[0]);
  }
}

$("#book_cover").change(function() {
  readUploadFileUrl(this);
  $('.uploaded-image-preview').show();
});


$(".toggle-password").click(function() {

  $(this).toggleClass("fa-eye fa-eye-slash");
  var input = $($(this).attr("toggle"));
  if (input.attr("type") == "password") {
    input.attr("type", "text");
  } else {
    input.attr("type", "password");
  }
});
