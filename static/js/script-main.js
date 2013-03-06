
$(function()
{
	window.search = false;
	window.content = $("#content").html();
	$('.showhide').each(function()
	{
		$(this).click(function()
		{
			$('#fixed-nav').slideToggle('slow');
			$('#userInfo').slideUp('slow');
			$('#clickScreen').slideUp('slow');
			$('.search').slideUp('slow');
		});
	});
	$('.name').each(function()
	{
		$(this).click(function()
		{
			$('#userInfo').slideToggle('slow');
			$('#clickScreen').slideDown('slow');
			$('.search').slideUp('slow');
		if(window.search = true)
			{
				$("#content").html(window.content);
				window.search = false;
			}
		});
	});
	$('#clickScreen').click(function()
	{
		$('#userInfo').slideUp('slow');
		$('#clickScreen').slideUp('slow');
		$('.search').slideUp('slow');
		if(window.search = true)
		{
			$("#content").html(window.content);
			window.search = false;
		}
	});
});
function openSearch()
{
	$('.search').slideToggle('slow');
	$('#clickScreen').slideDown('slow');
	$('#userInfo').slideUp('slow');
	if(window.search = true)
	{
		$("#content").html(window.content);
		window.search = false;
	}
}
function preformSearch(field)
{
	window.search = true;
	$.ajax({
		type: "POST",
		url: "/CollegeMatch.tk/LiveSearch/",
		data: { q: field.val() }
	}).done(function( results ) {
		$("#content").html(results);
	});
}
