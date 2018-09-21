function markAsRead(countNotification) {
    if(countNotification!==0){
    $.ajax({
        url: './markAsRead',
        dataType: 'JSON',
        success: function (data) {
        }
    });
    }
}

function markNotificationAsRead(countNotification) {
    if(countNotification!==0){
    $.ajax({
        url: '../../markAsRead',
        dataType: 'JSON',
        success: function (data) {
        }
    });
    }
}

// $('#latest_stories').click(function () {
//     var page_no = $('#page_no').val();
//     var url = './post/latest/'+page_no;
//     window.location.replace(url);
//     // alert(url);
// });
