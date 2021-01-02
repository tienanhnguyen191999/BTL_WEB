$(document).ready(function() {
    $('.loading-gif').hide();
    $('.invite-user').click(function () {
        if ($(this).hasClass('active')){
            $(this).removeClass('active')    
        } else {
            $(this).addClass('active')
        }
    })
    
    
    $('.send-invite-btn').click(function () {
        let data = [];
        $('.invite-user.active').each(function () {
            let tmp = {
                'user_id': '',
                'hotel_id': '',
                'conference_id': $('#main-table').data('id')
            }
            tmp.user_id = $(this).data('id');
            tmp.hotel_id = $(this).children("td:last").children("select").val();
            data.push(tmp);
        })

        
        if (data.length > 0) {
            $.ajax({
                url: "/api/sendInviteEmail.php",
                type: "POST",
                dataType: "json",
                data: { data },
                async: true,
                beforeSend: function(){
                    $('.loading-gif').show();
                },
                complete: function(){
                    $('.loading-gif').hide();
                },
                success: function(html){
                    
                }
            })
        }
    })
})