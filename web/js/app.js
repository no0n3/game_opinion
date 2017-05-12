var App = {
    user : {
        id : null,
    },
    update : {
        init : function(data) {
            if (!$.isNumeric(App.user.id)) {
                return null;
            }

            data = data ? data : {};
            data['voteBtnSelector'] = data['voteBtnSelector'] ? data['voteBtnSelector'] : '.update-upvote';

            $(data['voteBtnSelector']).on('click', function() {
                var $ele = $(this);
                var updateId = $ele.data('update-id');
                var voted = $ele.data('voted');

                $.post(voted ? data['downvoteUrl'] : data['upvoteUrl'], {'update_id' : updateId}, function(response) {
                    if (response.success) {
                        var $votesEle = $ele.find('span');

                        if (voted) {
                            var votes = parseInt($votesEle.html()) - 1;
                            $votesEle.html(0 > votes ? 0 : votes);
                            $ele.data('voted', false);
                            $ele.removeClass('item-voted');
                        } else {
                            $votesEle.html(parseInt($votesEle.html()) + 1);
                            $ele.data('voted', true);
                            $ele.addClass('item-voted');
                        }
                    }
                });
            });
        },
    }
};
