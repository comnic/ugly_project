// JavaScript Document

document.write("<script src='/static/js/channel.class.js'></script>");
document.write("<script src='/static/js/content.class.js'></script>");

var page = 0;

$(document).ready(function(e) {
    $('.carousel').carousel({
		interval: 2000
	});	
	
    //0일때 최근 컨텐츠를 반환하다.
    setContentView(0, true);
    
    getMovieContent(category_idx, ++page);
	
	$(window).scroll(function(){
		if($(window).scrollTop() == $(document).height() - $(window).height()){
			getMovieContent(category_idx, ++page);
		}
		
	});
	
	$(document).on("mouseenter", "#movieList li", function(){
		$(".content-item-over", $(this)).show();
		
	});
	
	$(document).on("mouseleave", "#movieList li", function(){
		$(".content-item-over", $(this)).hide();
		
	});
	
	$(document).on("click", "#movieList li", function(){
	
		var cidx = $(this).data("cidx");
		
		setContentView(cidx, true);

	});

	$(document).on("click", "#relationContentList li", function(){
		
		var cidx = $(this).data("cidx");
		
		setContentView(cidx, false);

	});
	
	
	$("#btnMoreContentList").click(function(){
		getMovieContent(category_idx, ++page);
	});

/*
	$('#modalMovieView').on('show.bs.modal', function (event) {

	});
*/
	$('#modalMovieView').on('hide.bs.modal', function (event) {
		$("#youtubePlayer").html("");
	});



});

function getMovieContent(cat, page){

		$.ajax({
			type: "POST",
			url: "/movie_list/get_content_list/" + cat + "/" + page,
			data: "",
			datatype: "json",
			success: function(data)
			{
				var data = $.parseJSON(data);
				
				//add movie list
				$.each(data.items, function(idx, item){
					//console.log(idx);
					$("#movieList").append("\
						<li class=\"p5\" data-cidx=\""+item.idx+"\">\
			            	<div>\
            			    	<div class=\"content-item-over\"><img src=\"/static/images/contents_on.png\"></div>\
                    			<div class=\"content-item-img\"><img src=\""+item.img+"\"></div>\
                    			<div class=\"content-item-txt\"><h6>"+ item.title +"</h6></div>\
                			</div>\
            			</li>\
					");
				});
				
				
			}
		});
}

function setContentView(cidx, rel){
	

	$.ajax({
		type: "POST",
		url: "/movie_list/get_content_ajax/" + cidx,
		data: "",
		datatype: "json",
		success: function(data)
		{
			//console.log(data);
			
			var item = $.parseJSON(data);
			
			var cont = new Content(item.idx, item.category, item.kind, item.title, item.summary, item.content, item.cnt, item.movie_link);
			//console.log(cont);
			
			
			$("#youtubePlayer").html("<iframe class=\"embed-responsive-item\" src=\""+ cont.link +"\" width=\"623\" height=\"325\"></iframe>");
			$("#movieTitle").html(cont.title);
			$("#movieSummary").html(cont.summary);
			$("#movieDesc").html(cont.content);
			
			if(rel){
				$.getJSON( "/movie_list/get_content_list/"+cont.category+"/1", function( data ) {
				
					//console.log(data);
					$("#relationContentList").empty();
				
					//add relation list
					$.each(data.items, function(idx, item){
						if(idx > 5)
							return false;
						
						$("#relationContentList").append("\
							<li class=\"p5\" data-cidx=\""+item.idx+"\">\
								<div>\
									<div class=\"col-md-5 thumbnail\"><img src=\""+item.img+"\"></div>\
									<div class=\"col-md-6 content-item-txt\"><h6>"+ item.title +"</h6></div>\
				        		</div>\
			    	        </li>\
						");
					});

				});
			}
			
			$('#modalMovieView').modal('show');
			
		}
	});	


}