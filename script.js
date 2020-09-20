$ = jQuery;

$('.agencies-list_item').click(function(){
var agency=$(this).attr('id');

if(agency == 'all') {
$('.property-preview').addClass('hide');
$('.property-preview').parent().addClass('hide');
setTimeout(function(){
$('.property-preview').removeClass('hide');
$('.property-preview').parent().removeClass('hide');
}, 300);
}else{
$('.property-preview').addClass('hide');
$('.property-preview').parent().addClass('hide');
setTimeout(function(){
$('.' + agency).removeClass('hide');
$('.' + agency).parent().removeClass('hide');
}, 300);
}

});