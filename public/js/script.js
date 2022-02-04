$( document ).ready(function() {
    $('.js-vote button').click(function(e){
        e.preventDefault();

        let direction = $(e.currentTarget).data('direction');
        let user_id = $(e.currentTarget).data('user-id');
        let pill = $(e.currentTarget).parent().find('.js-vote-total');
        let url = '/vote/' + user_id + '/' + direction;
        $.getJSON({
            url: url,
            success: function (response) {
                pill.text(response.vote);
            }
        })
    });
});