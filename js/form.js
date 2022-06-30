$(document).on({
    ajaxStart: function(){
        $("body").addClass("loading"); 
    },
    ajaxStop: function(){ 
        $("body").removeClass("loading"); 
    }    
});

$(document).ready(function () {
  $("form").submit(function (event) {
    $("#msg").html('');
    $(".form-group").removeClass("has-error");
    $(".help-block").remove();
    var formData = {
      url: $("#url").val(),
      degree: $("#degree").val()
    };

    $.ajax({
      type: "POST",
      url: "process.php",
      data: formData,
      dataType: "json",
      encode: true,
    }).done(function (data) {
      console.log(data);
      if (!data.success) {
        if(data.message) {
          $("#msg").html(
            '<div class="alert alert-danger">' + data.message + '</div>'
          );
          return
        }
        if (data.errors.url) {
          $("#url-group").addClass("has-error");
          $("#url-group").append(
            '<div class="help-block">' + data.errors.url + "</div>"
          );
        }

        if (data.errors.degree) {
          $("#degree-group").addClass("has-error");
          $("#degree-group").append(
            '<div class="help-block">' + data.errors.degree + "</div>"
          );
        }
      } else {
        $("form").html(
          '<div class="alert alert-success">' + data.message + "</div>"
        );
      }
    })
    .fail(function (data) {
      $("form").html(
        '<div class="alert alert-danger">Could not reach server, please try again later.</div>'
      );
    });

    event.preventDefault();
  });
}); 