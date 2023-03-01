


function submitContactForm(form, event) {
    // $("#connect-form").submit();
    event.preventDefault();
    console.log ($(form).serialize());
    $.ajax({
        type: "POST",
        url: 'mail.php',
        data: $(form).serialize(),
        success: function (res){
            console.log (JSON.parse(res));
        },
        error:function (xhr, ajaxOptions, thrownError){
            alert('Server Error: ' + thrownError);
        }
   });



}
const strategies__colors = [
    "#2EB1FF",
    "#582EFF",
    "#A913AC",
    "#00BFB4",
    "#709E0D",
    "#D86626",
    "#cc3f52"
];

$(document).ready(e => {
    $('.strategies__item').each((a,b) => {
        let item = $(b);
        item.find('.strategies__item__title').css("color", strategies__colors[a] || strategies__colors[0]);
        item.find('.strategies__item__link').css("color", strategies__colors[a] || strategies__colors[0]);
        item.find('.strategies__item__link span').css("background", strategies__colors[a] || strategies__colors[0]);
    });
    $('.service-window').each((a,b) => {
        let item = $(b);
        item.find('.window__title').css("color", strategies__colors[a] || strategies__colors[0]);
        item.find('.window__link').css("color", strategies__colors[a] || strategies__colors[0]);
        item.find('.window__link span').css("background", strategies__colors[a] || strategies__colors[0]);
    });
    $('.menu__item').filter((i,e) => {
        return $(e).find('.menu__item__options').length > 0;
    }).addClass('menu__item__has-options');
    $('.window').on('click', 'div.window__close', e => {
        $(e.delegateTarget).removeClass('open');
    });
    $('[window-open]').on('click', e => {
        e.preventDefault ();
        e.stopPropagation();
        let id=$(e.target).attr('window-open');
        $('.window').removeClass('open');
        $('[window="' + id + '"]').addClass('open');
        $('.menu__item__title').removeClass('open');
    });
    $(document).on('keyup', e => {
        if (e.keyCode == 27) {
            $('.window').removeClass('open');
            $('.menu__item__title').removeClass('open');
        }
    });
    $('.menu__item__title').on('click', e => {
        e.preventDefault ();
        e.stopPropagation();
        let open = $(e.currentTarget).hasClass('open');
        $('.menu__item__title').removeClass('open');
        if (!open) $(e.currentTarget).addClass('open');
        
    });
    $('.menu__item__option').on('click', e => {
        e.preventDefault ();
        e.stopPropagation();
    });
    $(document).on('click', e => {
        $('.menu__item__title').removeClass('open');
    })
    $('.hamburger').on('click', e => {
        $('.menu').addClass('open');
    })
    $('.menu__close').on('click', e => {
        $('.menu').removeClass('open');
    })
    $('#popup-contact-form').validate({
        rules: {
            contact_firstname: {
              minlength: 2,
              maxlength: 20,
              required: true
            },
            contact_lastname: {
              minlength: 2,
              maxlength: 20,
              required: true
            },
            contact_email: {
              required: true,
              email: true
            },
        },
        submitHandler: submitContactForm
    });
    $('#connect-form').validate({
        rules: {
            contact_firstname: {
              minlength: 2,
              maxlength: 20,
              required: true
            },
            contact_lastname: {
              minlength: 2,
              maxlength: 20,
              required: true
            },
            contact_email: {
              required: true,
              email: true
            },
        },
        submitHandler:  submitContactForm
    });
});