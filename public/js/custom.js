"use strict";

Dropzone.autoDiscover = false;

/* Slide */
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
});
/* Contact */
$(document).ready(function(){
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

    let dropzone = new Dropzone('#urban-upload', {
        url: '/sendQuote',
        autoProcessQueue: false,
        addRemoveLinks: true,
        parallelUploads: 25,
        maxFilesize: 8,
        thumbnailHeight: 80,
        thumbnailWidth: 80,
        uploadMultiple: true,
        init: function(file) {
            this.on("addedfile", function(file) {
                var removeButton = Dropzone.createElement("<button class='btn btn-sm btn-default fullwidth margin-top-10'>Remove file</button>");
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

    function validateEmail(email)
    {
        var re = /\S+@\S+/;
        return re.test(email);
    }
});

jQuery(document).ready(function($) {
    $(".faqlist li a").click(function(event) {
        event.preventDefault();

        var defaultAnchorOffset = 0;

        var anchor = $(this).attr('data-scrollto');

        var anchorOffset = $('#'+anchor).attr('data-scroll-offset');
        if (!anchorOffset)
            anchorOffset = defaultAnchorOffset;

        $('html,body').animate({
            scrollTop: $('#'+anchor).offset().top - anchorOffset
        }, 1000);
    });

});
window.onload = function() {
    baguetteBox.run('.baguetteBoxOne');
    if (typeof oldIE === 'undefined' && Object.keys) {
        hljs.initHighlighting();
    }
};

$(window).scroll(function () {
    if ($(this).scrollTop() > 100) {
        $('header').addClass("fixed");
    } else {
        $('header').removeClass("fixed");
    }
});

/* Gallery */
lightGallery(document.getElementById('lightgallery'));
/* Time */
$(function () {
    $('#datetimepicker1').datetimepicker();
});
$(document).ready(function () {
    $('.chatButton').on('click', function () {
        var $url = 'https://supportchat.icodice.com/check';
        function httpGet($url)
        {
            var xmlHttp = new XMLHttpRequest();
            xmlHttp.open( "GET", $url, false ); // false for synchronous request
            xmlHttp.send( null );
            return xmlHttp.responseText;
        }
        console.log(httpGet($url));
        if(httpGet($url) === 'true'){
            window.open("https://supportchat.icodice.com/chat", "_blank", "toolbar=no,scrollbars=no,resizable=yes,top=0,left=0,width=534,height=437");
        }else{
            $('#myModal').modal("show");
        }
    });
});
$(window).load(function(){
    var $container = $('.portfolioContainer');
    $container.isotope({
        filter: '*',
        animationOptions: {
            duration: 750,
            easing: 'linear',
            queue: false
        }
    });

    $('.portfolioFilter a').click(function(){
        $('.portfolioFilter .current').removeClass('current');
        $(this).addClass('current');

        var selector = $(this).attr('data-filter');
        $container.isotope({
            filter: selector,
            animationOptions: {
                duration: 750,
                easing: 'linear',
                queue: false
            }
        });
        return false;
    });

    $("#projects .mix").hover(
        function() {
            let addCompare = $(this).find('.addCompare');
            addCompare.removeClass('compare');
            addCompare.click(function(e) {
                e.stopImmediatePropagation();

                console.log(this);

            });
        }
    ).mouseleave(
        function() {
            $(this).find('.addCompare').addClass('compare');
        }
    );
});
$(window).scroll(function(){
    var target = $("#go-top");
    if($(window).scrollTop() > 250)target.show();
    else target.hide();
});

$(document).ready(function(){
    $("#go-top").click(function(){
        $("html, body").animate({ scrollTop: 0 }, "slow");
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
            $('.stones .mix-container .mix .img').css('height', '');
        } else {
            if (checkCount == 1) {
                $('.mix').addClass('col-lg-4 col-md-6 col-sm-6 col-xs-12');
                if($(this).is(':checked')) {
                    var elHeight = $('.stones .mix-container .mix .img').height();
                    var cssNewHeight = 'height: ' + elHeight * 1.5 + 'px!important';
                    $('.stones .mix-container .mix .img').css('cssText', cssNewHeight);
                }
            } else if (checkCount == 2) {
                $('.mix').addClass('col-lg-6 col-md-12 col-sm-12 col-xs-12');
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

});
var containerEl4 = document.querySelector('[data-ref="container-4"]');
var config = {
    controls: {
        scope: 'local'
    }
};
var mixer4 = mixitup(containerEl4, config);
$(document).ready(function(){
    $('.stones .select span').click(function(event){
        event.stopPropagation();
        $(this).closest('.select').find('.buttons').slideToggle();
        $(this).closest('.select').toggleClass('active');

        if($(this).closest('.select').find('button').hasClass('mixitup-control-active')){
            $(this).closest('.select').addClass('choosing');
        }else {
            $(this).closest('.select').removeClass('choosing');
        }
    });
    $('.buttons').click(function(event){
        event.stopPropagation();
    });
    $(".showup").on("click", function (event) {
        event.stopPropagation();
    });
});



