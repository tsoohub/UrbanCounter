(function ($) {
    'use strict';

    Dropzone.autoDiscover = false;
    jQuery(document).ready(function() {
        jQuery('.fullwidthabanner').revolution({
            delay:6500,
            startwidth:1920,
            startheight:800,
            hideThumbs:10,
            fullWidth:"off",
            fullScreen:"on",
            fullScreenOffsetContainer: "header"
        });

        let dropzone = new Dropzone('#urban-upload', {
            url: '/sendQuote',
            autoProcessQueue: false,
            parallelUploads: 25,
            maxFilesize: 5,
            thumbnailHeight: 80,
            thumbnailWidth: 80,
            uploadMultiple: true,
            init: function(file) {
                this.on("addedfile", function(file) {
                    var removeButton = Dropzone.createElement("<button class='btn btn-sm btn-default fullwidth margin-top-5' style='margin-top: 5px;'>Remove file</button>");
                    var _this = this;
                    removeButton.addEventListener("click", function(e) {
                        e.preventDefault();
                        e.stopPropagation();
                        _this.removeFile(file);
                        if (file.status == 'success') {
                            parent.removeImage(file.xhr.response);
                        }
                    });
                    file.previewElement.appendChild(removeButton);
                });

                this.on("complete", function(file) {
                    this.removeAllFiles(true);
                })
            },
        });

        dropzone.on('sendingmultiple', function (file, xhr, formData) {

            formData.append('name', $('#inputName').val());
            formData.append('email', $('#inputEmail').val());
            formData.append('phone', $('#phone').val());
            formData.append('message', $('#message').val());

        });
        dropzone.on("successmultiple", function(files, response) {
            setTimeout(function() {
                    $("#myModal").modal('show');
                    $('#quote').trigger("reset");
                },
                2000
            );
        });
        dropzone.on("errormultiple", function(files, response) {
            alert(response);
        });

        $("#submitQuote").click(function (e) {
            e.preventDefault();

            if (dropzone.getQueuedFiles().length === 0) {
                alert('Upload the at least one file');
            } else {
                dropzone.processQueue();
            }
        });
    });
    formSubmit();
    function formSubmit(){
        $('#form').submit(function(e){
            e.preventDefault();

            let name = document.getElementById('name');
            let email = document.getElementById('email');
            let subject = document.getElementById('subject');
            let message = document.getElementById('message');

            if (name.value === "" || name.value.length === 0)
            {
                window.alert("Please enter your name.");
                name.focus();
                return false;
            }
            if (email.value === "" || email.value.length === 0 || !validateEmail(email.value))
            {
                window.alert("Please enter a valid e-mail address.");
                email.focus();
                return false;
            }
            if (subject.value === "" || subject.value.length === 0)
            {
                window.alert("Please enter a subject.");
                subject.focus();
                return false;
            }
            if (message.value === "" || message.value.length === 0)
            {
                window.alert("Please enter a message.");
                message.focus();
                return false;
            }

            $.ajax({
                type: 'post',
                url: 'sendEmail',
                data: $('#form').serialize(),
                success: function (response) {
                    setTimeout(function() {
                            $("#myModal").modal('show');
                            $('#form').trigger("reset");
                        },
                        2000
                    );
                }
            });
        });
        $('#quote').submit(function(e) {
            e.preventDefault();

            let form_data = new FormData();
            let file_data = $('#file').prop('files')[0];

            form_data.append('uploadFile', file_data);
            form_data.append('name', $('#inputName').val());
            form_data.append('email', $('#inputEmail').val());
            form_data.append('phone', $('#phone').val());
            form_data.append('message', $('#message').val());

            $.ajax({
                type: 'post',
                url: 'sendQuote',
                data: form_data,

                cache: false,
                contentType: false,
                processData: false,
                xhr: function() {
                    var myXhr = $.ajaxSettings.xhr();
                    if (myXhr.upload) {
                        // For handling the progress of the upload
                        myXhr.upload.addEventListener('progress', function(e) {
                            if (e.lengthComputable) {
                                $('progress').attr({
                                    value: e.loaded,
                                    max: e.total,
                                });
                            }
                        } , false);
                    }
                    return myXhr;
                },
                success: function (response) {
                    setTimeout(function() {
                            $("#myModal").modal('show');
                            $('#quote').trigger("reset");
                            $('.file-upload-wrapper').attr('data-text', 'Select your file!');
                        },
                        2000
                    );
                }
            });
        });
        $('#file').change(function() {
            $('.file-upload-wrapper').attr('data-text', $(this).prop('files')[0].name);
        });

    };
    function validateEmail(email)
    {
        var re = /\S+@\S+/;
        return re.test(email);
    }

    var $gallery = $('#gallery');

    $gallery.lightGallery({
        mode: 'lg-fade',
        hash: true	,
        download: true,
        enableDrag: true,
        enableSwipe: true,
        thumbnail:true,
        animateThumb: true,
        showThumbByDefault: true
    });



//isotope Code
    $('#gallery').isotope({
        // options
        itemSelector: '.revGallery-anchor',
        layoutmode: 'fitrows'
    });
    $('.gallery-button').on( 'click', function() {
        var filterValue = $(this).attr('data-filter');
        $('#gallery').isotope({ filter: filterValue });
        $gallery.data('lightGallery').destroy(true);
        $gallery.lightGallery({
            selector: filterValue.replace('*','')
        });
    });


    //CSS Gram Filters on Mouse enter
    $("#gallery a .nak-gallery-poster").addClass("inkwell");

    $("#gallery a").on({
        mouseenter : function() {
            $(this).find(".nak-gallery-poster").removeClass("inkwell").addClass("xpro2");
        },
        mouseleave : function() {
            $(this).find(".nak-gallery-poster").removeClass("xpro2").addClass("inkwell");
        }
    });
    $("#search-input").keyup(function() {
        var config = {
            controls: {
                scope: 'local'
            }
        };
        var containerStone = document.querySelectorAll('div[data-ref="container-1"]');
        var mixerStone = mixitup(containerStone, config);
        var inputText;
        var $matching = $();
        inputText = $("#search-input").val().toLowerCase();
        if ((inputText.length) > 0) {
            $('.mix').each(function() {
                var $this = $("this");
                if ($(this).children('.title').text().toLowerCase().match(inputText)) {
                    $matching = $matching.add(this)
                } else {
                    $matching = $matching.not(this)
                }
            });
            mixerStone.filter($matching)
        } else {
            mixerStone.filter('all')
        }
    });
    // GoTop
    $("#go-top").click(function(){
        $("html, body").animate({ scrollTop: 0 }, "slow");
    });

    $(window).scroll(function(){
        var target = $("#go-top");
        if($(window).scrollTop() > 350)target.show();
        else target.hide();
    });


    $(function(){
        if($('section').is('.sink')){
            var containerElSink = document.querySelector('#sink');
            var checkboxGroup = document.querySelector('.checkbox-group');
            var checkboxes = checkboxGroup.querySelectorAll('input[type="checkbox"]');
            var allCheckbox = checkboxGroup.querySelector('input[value="all"]');

            var mixerSink = mixitup(containerElSink);

            checkboxGroup.addEventListener('change', function(e) {
                var selectors = [];
                var checkbox;
                var i;

                if (e.target === allCheckbox && e.target.checked) {
                    // If the "all" checkbox was checked, uncheck all other checkboxes

                    for (i = 0; i < checkboxes.length; i++) {
                        checkbox = checkboxes[i];

                        if (checkbox !== allCheckbox) checkbox.checked = false;
                    }
                } else {
                    // Another checkbox was changed, uncheck "all".

                    allCheckbox.checked = false;
                }

                // Iterate through all checkboxes, pushing the
                // values of those that are checked into an array

                for (i = 0; i < checkboxes.length; i++) {
                    checkbox = checkboxes[i];

                    if (checkbox.checked) selectors.push(checkbox.value);
                }

                // If there are values in the array, join it into a string
                // using your desired logic, and send to the mixer's .filter()
                // method, otherwise filter by 'all'

                var selectorString = selectors.length > 0 ?
                    selectors.join(',') : // or '.' for AND logic
                    'all';

                mixerSink.filter(selectorString);
            });
        }
    });
    //Bilguun
    //Toggle function for panel sizes on filter
    $('.filter-check-box').on('click', function(event){
        $(".mix").removeClass(function (index, className) {
            return (className.match (/(^|\s)col-\S+/g) || []).join(' ');
        });
        var checkCount = $('.filter-check-box:checked').length;
        if (checkCount == 0) {
            $('.mix').addClass('col-lg-2 col-md-3 col-sm-4 col-xs-6');
            $('.list-section .mix-container .mix .img').css('height', '');
        } else {
            if (checkCount == 1) {
                $('.mix').addClass('col-lg-4 col-md-6 col-sm-6 col-xs-12');
                if($(this).is(':checked')) {
                    var elHeight = $('.list-section .mix-container .mix .img,.list-stone .mix .img').height();
                    var cssNewHeight = 'height: ' + elHeight  + 'px!important';
                    $('.list-section .mix-container .mix .img').css('cssText', cssNewHeight);
                }
            } else if (checkCount == 2) {
                $('.mix').addClass('col-lg-12 col-md-12 col-sm-12 col-xs-12');
            } else {
                $('.mix').addClass('col-lg-12 col-md-12 col-sm-12 col-xs-12');
            }
        }
    });

    //Toggle images inside panel on filter
    $('.filter-check-box').on('click', function(event){
        var checkCount = $('.filter-check-box:checked').length;
        $(".main-image").hide();
        $(".close-up-image").hide();
        $(".scene-image").hide();
        $(".slab-image").hide()
        if (checkCount == 0) {
            $(".main-image").show();
        } else {
            $('.filter-check-box:checked').each(function(){
                if($(this).hasClass("close-up-check")) {
                    $(".close-up-image").show();
                }
                if($(this).hasClass("scene-check")) {
                    $(".scene-image").show();
                }
                if($(this).hasClass("slab-check")) {
                    $(".slab-image").show();
                }
                let newWidth = 100 / checkCount - 1;
                $("div.mix a.img").css("width", newWidth + "%");

            });
        }
    });

    var galleryThumbs = new Swiper('.gallery-thumbs', {
        spaceBetween: 10,
        slidesPerView: 2,
        loop: true,
        freeMode: true,
        loopedSlides: 2, //looped slides should be the same
        watchSlidesVisibility: true,
        watchSlidesProgress: true,
    });
    var galleryTop = new Swiper('.gallery-top', {
        spaceBetween: 10,
        loop:true,
        loopedSlides: 2, //looped slides should be the same
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
        thumbs: {
            swiper: galleryThumbs,
        },
    });





})(jQuery);
$('.chatButton').on('click', function () {
    window.open("https://supportchat.icodice.com/chat?id=3", "_blank", "toolbar=no,scrollbars=no,resizable=yes,top=0,left=0,width=534,height=437");
});
$(document).ready(function () {
    // setup "global" variables first
    const socket = io.connect('https://supportchat.icodice.com/company_3', { secure: true, reconnect: true });

    socket.on('connect', () => {
        console.log('Connected');
        socket.emit("checkOperator", 3);
    });

    // success callback
    socket.on('update', function (data) {
        socket.emit("checkOperator", 3);
    });
    socket.on('checkOperator', function (data) {
        console.log(data.success);
        if(data.success == true){
            $(".chatButton-icodice").addClass( "block" );
        }else{
            $(".chatButton-icodice").addClass( "none" );
        }
    });
});

var containerEl1 = document.querySelectorAll('div[data-ref="container-2"]');
var config = {
    /*animation: {
        duration: 700,
        effects: 'fade translateY(600%) stagger(35ms)',
        easing: 'cubic-bezier(0.86, 0, 0.07, 1)',
        reverseOut: true
    },*/
    callbacks: {
        onMixStart: function() {
            clearHeaders();
        },
        onMixEnd: function() {
            sortStones();
        }
    },
    controls: {
        scope: 'local'
    }
};
function clearHeaders() {
    $('.stone-sub-container').replaceWith(function() {
        return $('.mix', this);
    });

}
function sortStones(){
    $("#selectType .mixitup-control-active").each(function( i, l ){
        // alert( $(this).text() );
        var title = $(this).text();
        $("#stones").append('<div  class="stone-sub-container"><h1 style="color:white;display:none;" class="col-sm-12 type-header">'+title+'</h1><div class="list-stone" id="'+title.toLowerCase()+'"><div class="container-fluid"><div class="row"></div></div></div></div>');
    });
    $(".type-header").show('slow');
    $("#stones .mix").each(function(){
        var stoneElement = $(this);
        $(".list-stone").each(function(){
            if(stoneElement.hasClass( $(this).attr("id"))) {
                $(this).children(".container-fluid").children(".row").append(stoneElement);
            }
        });
    });
}
mixerStone = mixitup(containerEl1, config);