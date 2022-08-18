document.deletePost = function (id) {
    let result = confirm('Do you want to delete the post?');
    if (result) {
        let actionUrl = '/posts/' + id;
        $('#delete-form').attr('action', actionUrl).submit();
    }
};
document.deleteTag = function (id) {
    let result = confirm('Do you want to delete the tag?');
    if (result) {
        let actionUrl = '/tags/' + id;
        $('#delete-form').attr('action', actionUrl).submit();
    }
};
