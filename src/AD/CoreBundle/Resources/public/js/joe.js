
function homepageToggle(){
	$("#homepage-text").toggle("slide",function(){
		$("#homepage-text").romove();
	},800);
	$("#homepage-btn").toggle("slide",function(){
		$("#homepage-btn").romove();
	},800);
}