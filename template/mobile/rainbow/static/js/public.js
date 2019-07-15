
/**
 * 后退
 */
function returnFun(){
	if($('.header .backBtn').attr('data-num') == 1 || $('.header .backBtn').attr('data-num') == undefined ){
		window.history.back();
	}else {
		window.location.href = $('.header .backBtn').attr('data-num');
	}
	return false;
}

/**
 * 页面跳转
 */
function pageJump(_url){
    window.location.href = _url;
}