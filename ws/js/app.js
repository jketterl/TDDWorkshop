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
});