var containerEl1 = document.querySelectorAll('div[data-ref="container-1"]');
var containerEl2 = document.querySelectorAll('div[data-ref="container-2"]');
var config = {
    controls: {
		scope: 'local'
    }
};
var mixer = mixitup(containerEl1, config);
var mixer2 = mixitup(containerEl2, config);

// var inputText;
// var $matching = $();
/*
$("#input").keyup(function(){
    // Delay function invoked to make sure user stopped typing

        inputText = $("#input").val().toLowerCase();

        // Check to see if input field is empty
        if ((inputText.length) > 0) {
            $('.mix').each(function() {
                $this = $("this");

                // add item to be filtered out if input text matches items inside the title
                if($(this).children('.title').text().toLowerCase().match(inputText)) {
                    $matching = $matching.add(this);
                }
                else {
                    // removes any previously matched item
                    $matching = $matching.not(this);
                }
            });
            //containerEl1.mixitup('filter', $matching);            
			mixer.filter($matching);
		} else {
            // resets the filter to show all item if input is empty
            mixer.filter(config);
        }
});

*/