$(function()
{
	$('.showhide').each(function()
	{
		$(this).click(function()
		{
			$('#fixed-nav').slideToggle('slow');
		});
	});
	$('.name').add('#clickScreen').each(function()
	{
		$(this).click(function()
		{
			$('#userInfo').slideToggle('slow');
			$('#clickScreen').slideToggle('slow');
		});
	});
});
