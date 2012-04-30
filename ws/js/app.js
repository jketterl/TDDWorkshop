$(document).ready(function(){
    var container = $('div.newsticker');

	var renderPosts = function(data) {
		container.empty();
		data.reverse().forEach(function(post){
			container.append($('<div class="post">' + post.text + '</div>'));
		});
	}	

    var loadPosts = function(){
        $.ajax('api.php', {
            success: renderPosts
        });
        setTimeout(loadPosts, 10000);
    };
    loadPosts();

	$('form').bind('submit', function(event) {
		event.preventDefault();
		var target = $(event.target);
		$.ajax(target.attr('action'), {
			type: 'post', 
			data: target.serialize(),
			done: renderPosts
		});
	});
});
