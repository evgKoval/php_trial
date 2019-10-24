$(document).ready(function() {
    $('#modal').on('show.bs.modal', function (eventModal) {
        var modal = $(this);

        $('#btnSubmit').on('click', function(event) {
            event.preventDefault();

            var title = modal.find('input[name="title"]').val();
            var text = modal.find('textarea[name="post_text"]').val();
            var id = modal.find('input[name="user_id"]').val();

            data = {
                title: title,
                post_text: text,
                user_id: id,
                create: true
            }

            sendAjax(data, modal, 'create-post.php');
        });
    });

    deletePost();
    editPost();

    $('#modal').on('hide.bs.modal', function (event) {
        var modal = $(this);

        modal.find('input[name="title"]').val('');
        modal.find('textarea[name="post_text"]').val('');
    });

    function editPost() {
        $('.btnEditModal').on('click', function(event) {
            var btnId = event.target.id;
            var card = $('.card').find('#' + btnId);
            
            var title = card.find('.card-title')[0].innerHTML;
            var post_text = card.find('.card-text')[0].innerHTML;

            var modal = $('#modal');

            modal.find('#title_input').val(title);
            modal.find('#text_input').val($.trim(post_text));

            $('#modal').modal('show');
            $('#btnSubmit').off('click');

            $('#btnSubmit').on('click', function(event) {
                event.preventDefault();

                var title = modal.find('input[name="title"]').val();
                var text = modal.find('textarea[name="post_text"]').val();
                var id = modal.find('input[name="user_id"]').val();

                data = {
                    title: title,
                    post_text: text,
                    id: btnId,
                }

                $.ajax({
                    method: "POST",
                    url: 'save-post.php',
                    data: data,
                    success: function(response) {
                        card.find('.card-title')[0].innerHTML = data.title;
                        card.find('.card-text')[0].innerHTML = data.post_text;

                        $('#modal').modal('hide');
                        $('#btnSubmit').off('click');
                        modal.find('input[name="title"]').val('');
                        modal.find('textarea[name="post_text"]').val('');
                    }
                });
            });
        });
    }

    function deletePost() {
        $('.btnDelete').on('click', function(event) {
            event.preventDefault();

            var btnId = event.target.id;

            $.ajax({
                method: "POST",
                url: 'delete.php',
                data: {id: btnId},
                success: function(response) {
                    var card = $('.card').find('#' + btnId);

                    card.parent()[0].remove();
                }
            });
        });
    }

    function sendAjax(data, modal, method) {
        $.ajax({
            method: "POST",
            url: method,
            data: data,
            success: function(response) {
                var post = JSON.parse(response);

                $(".container").append('\
                    <div class="card mb-4">\
                        <div class="card-body" id="'+ post.id +'">\
                            <h5 class="card-title">'+ post.title +'</h5>\
                            <p class="card-text">\
                                '+ post.post_text +'\
                            </p>\
                            <p>\
                                <small>\
                                    '+ post.created_at +'\
                                </small>\
                            </p>\
                            <button type="button" class="btn btn-primary btnEditModal" id="'+ post.id +'">\
                                Edit\
                            </button>\
                            <button type="button" id="'+ post.id +'" class="btn btn-danger btnDelete">Delete</button>\
                        </div>\
                    </div>\
                ');

                $('#modal').modal('hide');
                $('#btnSubmit').off('click');
                modal.find('input[name="title"]').val('');
                modal.find('textarea[name="post_text"]').val('');

                deletePost();
                editPost();
            }
        });
    }
});

