jQuery(document).ready(function($){
	var pricedata;
	var brandlist = [];
	var $brandinput = $(".brand input"),
		$price = $(".price i");

    $.ajax({
        url: gofix.data_link,
        //force to handle it as text
        dataType: "text",
        success: function(data) {
            var json = $.parseJSON(data);
            pricedata = json.pricedata;

            for (var i = 0; i < pricedata.length; i++) {
			    brandlist.push(pricedata[i].brand);
			}
			console.log(brandlist);
			$('.brand input').autoComplete({
				minChars: 1,
			    source: function(term, suggest){
			        term = term.toLowerCase();
			        var matches = [];
			        for (var i=0; i<brandlist.length; i++)
			            if (~brandlist[i].toLowerCase().indexOf(term)) matches.push(brandlist[i]);
			        suggest(matches);
			    },
			    onSelect: function(e, term, item){
					updateResult();
			    }
			});
        }
    });

    function updateResult() {
    	var brand = $brandinput.val(),
    		type = $(".sentence .what .option-list li.selected").html(),
    		when = $(".sentence .when .option-list li.selected").html(),
    		additional_cost = 0;

    	if(brand == "" || brandlist.indexOf(brand)==-1) {
    		$brandinput.addClass("error");
    		$(".result").removeClass('active');
			$price.html("0");
    		return;
    	}
    	else
    		$brandinput.removeClass("error");

    	if(brand=="" || type==undefined || when==undefined) {
    		return;
    	}

    	switch(when) {
    		case 'today':
    			additional_cost = 20;
    			break;
    		case 'tomorrow':
    			additional_cost = 10;
    			break;
    	}
    	for (var i=0; i<pricedata.length; i++)
			if (pricedata[i].brand == brand) {
				$price.html(parseInt(pricedata[i].cost)+additional_cost);
				$(".result").addClass('active');
			} 
    }

	$('.get-in-touch').tipso({
		position: 'top',
		background: '#fff',
		color: '#004051',
		width: '270',
		content: '<p>We’ll do everything we can to make this super simple.</p><p>Please <a href="mailto:someone@example.com">email us</a> or just call Jenny on <span>07469 141 125</span>.</p>',
		tooltipHover: true
	});

	$(".sentence .option-list li").click(function(){
		$(this).siblings().removeClass("selected");
		$(this).addClass("selected");
		updateResult();
	});

	$(".sentence .what .option-list li").click(function(){
		var brand = $brandinput.val();
		if(brand=="")
			sweetAlert({title:"Please choose the brand"});
	});

	$(".brand input").change(function(){
		updateResult();
	});
});