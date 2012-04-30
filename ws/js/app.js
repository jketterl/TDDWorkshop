$(document).ready(function(){
    var loadPosts = function(){
        var container = $('div.newsticker');
        $.ajax('api.php', {
            success:function(data){
                container.empty();
                data.reverse().forEach(function(post){
                    container.append($('<div class="post">' + post.text + '</div>'));
                });
            }
        });
        setTimeout(loadPosts, 10000);
    };
    loadPosts();

	$('form').bind('submit', function(event) {
		event.preventDefault();
		var target = $(event.target);
		$.ajax(target.attr('action'), {
			type: 'post', 
			data: target.serialize()
		});
	});
});
