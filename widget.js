/*
* @PageName: widget.js
* @Company Name: STPL
* @Author: Rakesh
* @Purpose: Genrate widget & Key checking process
* @Date: 13-Dec-2013
*/
// Start Jquery initalize

/*var dataFilesPath;

document.writeln('<script type="text/javascript" language="javascript" src="http://code.jquery.com/jquery-1.10.2.min.js"></sc'+'ript>'); 
var int=self.setInterval(function(){
	if((typeof $) != 'undefined'){
		window.clearInterval(int);
		ready();
	}
},1000);*/
$(function() {
	
	
	var serverPath = window.location.host;
	
	// Set image width height adjustment	
	$.ajax({
		dataType:"jsonp",
		url:"http://shopnowwidget.stpldemo.com/widget/addView?clientUrl="+clientUrl+"&ip="+ip+"&widget_id="+widget_id,
		contentType:"json",
		type:"GET",
		success: function(data){
			//alert(data);
		}});
	// Load data with dynamic layout with widget
	$.ajax({
		dataType:"jsonp",
		url:"http://shopnowwidget.stpldemo.com/widget/getdynamicForm?keyVal="+SHOPNOWWIDGETKEYFORCHECKING,
		contentType:"json",
		type:"GET",
		success: function(data){
			var bgColor =data.bgcolor;
			
			var heightFrame = data.rec_height;
			var widthFrame =  data.rec_width;
			var titleColor = data.title_color;
			var button_bgcolor  = data.button_bgcolor;
			var btn_text_color = data.button_text_color;
		
		
			var newbgcolor='#'+bgColor;
		// Initalize varibel for rendering
			var js_builddata_divblock, js_innerblock = "", js_endblock, imgRows, targRows;
			imgRows = data.image.split('^');
			targRows = data.targetLink.split('^');
			js_builddata_divblock = '<link href="http://shopnowwidget.stpldemo.com/widget/css/widget.css" rel="stylesheet" type="text/css"  />'
			js_builddata_divblock += '<div class="widgetMainCont" id="widget_maincontainer">';
			js_builddata_divblock += '<div class="widgetListCont">';
			js_builddata_divblock += '<div class="widgetHd">'+data.widget_title+'</div>';
			js_builddata_divblock += '<ul class="widgetListUL">';
			for(i=0; i<imgRows.length; i++){
				if(targRows[i]!='' && targRows[i] !='')
				{
				js_innerblock +='<li>';
				js_innerblock += '<div class="widgetInnerCont">';
				js_innerblock += '<div class="widgetImgCont"><a href="'+targRows[i]+'"><img src="'+imgRows[i]+'" alt=""  id="ads_image" /></a></div>';
				js_innerblock += '<div class="widgetBtn"><a onclick="getChildUrlData(\''+targRows[i]+'\',\''+data.widget_id+'\',\''+ip+'\',\''+clientUrl+'\')" target="_blank"><input onclick="window.location=\''+targRows[i]+'\'" type="button" value="'+data.button_text+'" class="btns btns-widget" /></a></div>';
				js_innerblock +='</div>';
				js_innerblock += '</li>';
				}
			}
			js_endblock='</ul>';
			js_endblock +='</div>';
			js_endblock +='</div>';
			$('body').append(js_builddata_divblock+js_innerblock+js_endblock);
			
			$(".widgetListCont").css({"background-color":newbgcolor});
			$(".widgetInnerCont").css({"width":'100%'});
			// var newWidth = widthFrame/4;
			
			$(".ul.widgetListUL li").css({"width":'16%'});
			
			
			$(".widgetHd").css({"color": "#"+titleColor});
		 	$(".widgetHd").css({"width":widthFrame-50});
			if(heightFrame!='')
			{
			$(".widgetListCont").css({"height":heightFrame});
			}
			/* removing 17-DEc-2013 else
			{
			$(".widgetListCont").css({"height":'200px'});	
			} */
			if(widthFrame!='')
			{
			$(".widgetListCont").css({"width":widthFrame});
// 			$(".widgetHd").css({"width":widthFrame}); // removing 17 dec-2013
			}
			/*else
			{
			$(".widgetListCont").css({"width":'800px;'});
			$(".widgetHd").css({"width":'800px;'});	
			}  // removing 17 dec-2013  */ 
			$('img#ads_image').css({'height':'60px'});
	        $('img#ads_image').css({'width':'140px'});
			
			// For button text  background: linear-gradient(to bottom, #A1D54F 1%, #66AD0A 27%, #76AF0A 68%, #80C217 100%) repeat scroll 0 0 rgba(0, 0, 0, 0);
			
			// var btnBgCustomCss='linear-gradient(to bottom, #'+button_bgcolor+' 1%, #'+button_bgcolor+' 27%, #'+button_bgcolor+' 68%, #'+button_bgcolor+' 100%) repeat scroll 0 0 rgba(0, 0, 0, 0);';
			$('.btns-widget').css({'background':'#'+button_bgcolor});
			$('.btns-widget').css({'box-shadow':'none'});
			$('.btns-widget').css({'border':'1px solid #'+button_bgcolor});
			$('.btns-widget').css({'color':'#'+btn_text_color});
			
			// Overwrite code of CSS , 17 - dec -2013
			$('ul.widgetListUL li').css({'display':'inline-block','padding':'15px 0','width':'23%'});
		}
	});
	/*$("#widget_maincontainer").load( "", function( response, status, xhr ) {
	 alert( xhr.status + " " + xhr.statusText )
	  if ( status == "error" ) {
		var msg = "Sorry but there was an error: ";
		$( "#error" ).html( msg + xhr.status + " " + xhr.statusText );
	  }
	});*/		
});

function getChildUrlData(url,K,ip,clientUrl){
		$.ajax({
			type: "POST",
			dataType: "jsonp",
			url: "http://shopnowwidget.stpldemo.com/widget/redirectAjax?cod="+K+"&url="+url+"&ip="+ip+"&clientUrl="+clientUrl,
			data: { cod: K,url:url },
			success: function(msg){
				//alert(data);
				//callajax(K,url);
			}
		});	
	}