$(document).ready(function(){
    var container = $('div.newsticker');
    var userContainer = $('select');

	var renderPosts = function(posts) {
		container.empty();
		posts.forEach(function(post){
			container.append($('<div class="post">' + post.text + '<br /><span class="post-user">' + post.username + '</span></div>'));
		});
	};
	
	var renderUsers = function(users) {
	    // User nur neu laden, wenn sich was veraendert hat
	    if (users.length !== userContainer.children().size()) {
    	    userContainer.empty();
    	    users.forEach(function(user) {
    	        var option = $('<option>');
    	        option.attr('value', user.id);
    	        option.html(user.name);
    	        userContainer.append(option);
    	    });
	    }
	};
	
	var renderPostsAndUsers = function(data)
	{
	    renderPosts(data.posts.reverse());
	    renderUsers(data.users);
	};
	
	var renderPostsAndUsersAfterFormUsage = function(data)
	{
	    $('div.new-user').hide();
        $('div.new-user').find('input').empty();
	    renderPostsAndUsers(data);
	};

    var loadPosts = function(){
        $.ajax('api.php', {
            success: renderPostsAndUsers
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
			success: renderPostsAndUsersAfterFormUsage,
			error: function(jqXHR, textStatus, errorThrown) {
			    $('div.new-user').hide();
				var errorMessage = $.parseJSON(jqXHR.responseText);
				alert('Fehler beim Posten/Anlegen: "' + errorMessage.message + '"');
			}
		});
	});
	
	$('span.new-user').bind('click', function(event) {
	    $('div.new-user').show();
	});
	
	$('input[type="reset"]').bind('click', function(event) {
	    $('div.new-user').hide();
	});
});
