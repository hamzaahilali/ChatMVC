<h3 class=" text-center">Messagerie</h3>
<div class="messaging">
    <div class="inbox_msg">
        <div class="inbox_people">
            <div class="headind_srch">
                <div class="recent_heading">
                    <h4>Contacts</h4>
                </div>
                <div class="srch_bar">
                    <div class="stylish-input-group">
                        <input type="text" class="search-bar" placeholder="Search">
                        <span class="input-group-addon">
                <button type="button"> <i class="fa fa-search" aria-hidden="true"></i> </button>
                </span></div>
                </div>
            </div>
            <div class="inbox_chat" data-Selected="0">

                <?php
                if ($usersOnline != null)
                    foreach ($usersOnline as $userOnline) { ?>
                        <a href="#" class="userChat" id="<?= $userOffline->getId(); ?>">
                            <div class="chat_list">
                                <div class="chat_people">
                                    <div class="chat_img"><img src="https://ptetutorials.com/images/user-profile.png"
                                                               alt="sunil">
                                    </div>
                                    <div class="chat_ib">
                                        <h5> <?= $userOffline->getFullName(); ?><span class="badge badge-primary">on-ligne</span>
                                        </h5>
                                    </div>
                                </div>

                            </div>
                        </a>
                    <?php } ?>
                <?php
                if ($usersOffline != null)
                    foreach ($usersOffline as $userOffline) { ?>
                        <a href="#" class="userChat" id="<?= $userOffline->getId(); ?>">
                            <div class="chat_list">
                                <div class="chat_people">
                                    <div class="chat_img"><img src="https://ptetutorials.com/images/user-profile.png"
                                                               alt="sunil">
                                    </div>
                                    <div class="chat_ib">
                                        <h5> <?= $userOffline->getFullName(); ?><span class="badge badge-light">off-ligne</span>
                                        </h5>
                                    </div>
                                </div>
                            </div>
                        </a>
                    <?php } ?>

            </div>
        </div>
        <div class="mesgs">
            <div id="msg_history" class="msg_history">


            </div>
            <div class="type_msg">
                <div class="input_msg_write">
                    <input type="text" id="write_msg" class="write_msg" placeholder="Type a message"/>
                    <button id="msg_send_btn" class="msg_send_btn" type="button"><i class="fa fa-paper-plane-o"
                                                                                    aria-hidden="true"></i></button>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">



    $(document).ready(function () {


        $(".type_msg").hide();

        $("#msg_send_btn").click(function () {

            let content = $("#write_msg").val();
            let userReceiverId = $('.inbox_chat').attr("data-Selected");

            if (content != "" && userReceiverId != 0) {
                $.ajax({
                    url: '?page=message.add',
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        content: content,
                        userReceiverId: userReceiverId
                    },
                    success: function (data) {
                        console.log(data);
                    },
                    error: function (data) {

                    }

                });
            }
        });

        $(".userChat").click(function () {

            if ($('.inbox_chat').attr("data-Selected") != 0) {
                $("#" + $('.inbox_chat').attr("data-Selected")).children('div').removeClass("active_chat");
            }
            let contactSelected = $(this).attr("id");
            $('.inbox_chat').attr("data-Selected", contactSelected);
            $(this).children('div').addClass("active_chat");

            $("#msg_history").html('');
            $(".type_msg").show();

            getMoreDocumentations(contactSelected,0);
        });


    });

    // load next page of Discussion
    function getMoreDocumentations(idUser,page) {
        let url = "?page=message.loadpage.idUser.curentPage";
        url = url.replace("curentPage", page);
        url = url.replace("idUser", idUser);
        $.ajax({
            url: url,
            context: document.body
        }).done(function(result) {

            let JSONArray = $.parseJSON(result);

            let currentUserId= "<?= $_SESSION['auth'] ?>";

            $.each(JSONArray, function(i, item) {

                if(JSONArray[i].userSenderId == currentUserId)
                    addIncoming_msg(JSONArray[i].content,JSONArray[i].dateSend)
                else
                    outgoing_msg(JSONArray[i].content,JSONArray[i].dateSend)
            });
        });
    }


    function addIncoming_msg(msg,date) {

        $("#msg_history").prepend(
        "<div class='incoming_msg'>"+
        "<div class='incoming_msg_img'><img src='https://ptetutorials.com/images/user-profile.png' alt='sunil'></div>"+
        "<div class='received_msg'>"+
        "<div class='received_withd_msg'>"+
        "<p>"+ msg +"</p>"+
        "<span class='time_date'>"+ date +"</span></div>"+
        "</div>"+
        "</div>");
    }

    function outgoing_msg(msg,date) {

        $("#msg_history").prepend(
        "<div class='outgoing_msg'>"+
        "<div class='sent_msg'>"+
        "<p>"+msg+"</p>"+
        "<span class='time_date'>"+ date +"</span></div>"+
        "</div>");
    }

</script>
