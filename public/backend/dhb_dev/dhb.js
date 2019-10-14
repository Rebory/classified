//error function for ajax forms

function printErrorMsg (msg) {
    $("#ajax-form").find(':submit').val("Submit")
     $("#ajax-form").find(':submit').removeAttr('disabled', 'disabled');

    $(".print-error-msg").find("ul").html('');
    $(".print-error-msg").css('display','block');
    $.each( msg, function( key, value ) {
        $(".print-error-msg").find("ul").append('<li>'+value+'</li>');
    });
}
//end code
// disable button on click
$(function()
{
  $('#ajax-form').submit(function(){
    $("input[type='submit']", this)
      .val("Please Wait...")
      .attr('disabled', 'disabled');
    return true;
  });
});
//end code

$('#ajax-form').on('submit', function(event) {
        event.preventDefault();

        var formData = $(this).serialize(); // form data as string
        var formAction = $(this).attr('action'); // form handler url
        var formMethod = $(this).attr('method'); // GET, POST
        var redirectTo  = $(this).attr('redirectTo'); // GET, POST

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            url: formAction,
            method: formMethod,
            cache: false,
            data:new FormData(this),
            dataType:'JSON',
            contentType: false,
            processData: false,
            success: function(data) {
                if($.isEmptyObject(data.error)){
                    $("#msg").html(data.success);
                    $('#hideError').addClass('hidden');
                    $("#msg").fadeOut(3000);
                    $("#msg").removeClass('hidden').addClass('alert alert-success');
                    window.setTimeout(function(){window.location.href = redirectTo },4000);
                }
                else{
                    printErrorMsg(data.error);
                    $(".print-error-msg").fadeOut(15000);
                }
            }
        });
    });



//hotel profile/logo/
 $('#ajax-form-logo-on-change').on('change', function(event) {
     event.preventDefault();


     var formData = $(this).serialize(); // form data as string
     var formAction = $(this).attr('action'); // form handler url
     var formMethod = $(this).attr('method'); // GET, POST
     var redirectTo  = $(this).attr('redirectTo'); // GET, POST

     $.ajaxSetup({
         headers: {
             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         }
     });

     $.ajax({
         url: formAction,
         method: formMethod,
         cache: false,
         data:new FormData(this),
         dataType:'JSON',
         contentType: false,
         processData: false,
         success: function(data) {
             if($.isEmptyObject(data.error)){
                 $("#msg").html(data.success);
                 $('#hideError').addClass('hidden');
                 $("#msg").fadeOut(2000);
                 $("#msg").removeClass('hidden').addClass('alert alert-success');
                 window.setTimeout(function(){window.location.href = redirectTo },3000);

             }
             else{
                 printErrorMsg(data.error);
                 $(".print-error-msg").fadeOut(10000);

             }
         }
     });
 });

//end code hotel profile/logo

 //hotel profile/cover-photo/
 $('#ajax-form-cover-on-change').on('change', function(event) {
     event.preventDefault();

     var formData = $(this).serialize(); // form data as string
     var formAction = $(this).attr('action'); // form handler url
     var formMethod = $(this).attr('method'); // GET, POST
     var redirectTo  = $(this).attr('redirectTo'); // GET, POST

     $.ajaxSetup({
         headers: {
             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         }
     });

     $.ajax({
         url: formAction,
         method: formMethod,
         cache: false,
         data:new FormData(this),
         dataType:'JSON',
         contentType: false,
         processData: false,
         success: function(data) {
             if($.isEmptyObject(data.error)){
                 $("#msg").html(data.success);
                 $('#hideError').addClass('hidden');
                 $("#msg").fadeOut(2000);
                 $("#msg").removeClass('hidden').addClass('alert alert-success');
                 window.setTimeout(function(){window.location.href = redirectTo },3000);
             }
             else{
                 printErrorMsg(data.error);
                 $(".print-error-msg").fadeOut(10000);
             }
         }
     });
 });
 //end code hotel profile//cover-photo

/***************************************************/


// $(function () {
//     $('.datetimepicker2').datetimepicker(
//         {
//             // format: 'LT',
//             // useCurrent: false,
//             format: 'HH:mm'
//         });
// });

/***************************************************/
$(function () {
    $('.datetimepicker1').datepicker();  //bootstrap date picker not theme picker
});
/***************************************************/
$(function () {
    $('.datetimepicker2').datetimepicker({
        format: 'MM/DD/YYYY hh:mm'
    });
});
/***************************************************/


// Print code perticuller div
function codespeedy(){
    var print_div = document.getElementById("div-print");
    var print_area = window.open();
    print_area.document.write(print_div.innerHTML);
    print_area.document.close();
    print_area.focus();
    print_area.print();
    print_area.close();
}
//end print code

//summernote
$('.summernote').summernote({
    height:400,
    toolbar: [
        // [groupName, [list of button]]
        ['style', ['style']],
        ['font', ['bold', 'italic', 'underline', 'clear']],
        ['font', ['fontsize', 'color']],
        ['font', ['fontname']],
        ['para', ['paragraph']],
        // ['insert', ['link','image', 'doc', 'video']], // image and doc are customized buttons
        ['misc', ['codeview', 'fullscreen']],
    ]
});
//summernote end





