// $notification_count = 100;
// get_notification(function () {
//     $notification_count = $(".menu").find("li").length;
// });

// function get_notification(callback) {
//     checkconnection();
//     $(".menu").empty();
//     $.getJSON("showNotification", function (note_data) {
//         if (note_data.length === 0) {
//             $notification_count = note_data.length;
//             $(".notification_header_li").text("No new Notification");
//             $(".notification_counter").text("");
//         } else {
//             if (note_data.length > $notification_count) {
//                 $.playSound("tone/note_tone.mp3");
//                 $notification_count = note_data.length;
//             }
//             $(".notification_header_li").text("You have " + note_data.length + " new Notification");
//             $(".notification_counter").text(note_data.length);
//             var options = '';
//             var icon = "";
//             var content = "";
//             $.each(note_data, function (k, v) {
                
//                 options += '<li data-id="' + v.id + '" data-action_link="' + v.action_link + '" class="note_menu"> <a href="JavaScript:void(0);"> <i class="' + v.icon + '"></i>' + v.message + '</a></li> ';
//             })
//             console.log($(".menu"));
//             $(".menu").html(options);
//         }
//         if (callback instanceof Function) {
//             callback();
//         }
//     });
// }

// function checkconnection() {
//     var status = navigator.onLine;
//     if (status) {
         
//         $(".check_online_offline_text").text("Online");
//         $(".check_online_offline_icon").addClass("text-success");
//         //alert('Internet connected !!');
//     } else {
//        // alert('No internet Connection !!');
//        $(".check_online_offline_text").text("Offline");
//         $(".check_online_offline_icon").addClass("text-warning");
//     }
// }


// $(document).on("click", ".note_menu", function () { 
//     $action_link = $(this).data("action_link");
//     $id = $(this).data("id");
//     $_token = $("input[name=_token]").val();

//     $.post( "showNotificationRedirect",{ "_token":$_token,"id": $id,"action_link": $action_link },function( data ) { console.log(data);
//   if(data.status == 'true'){ 
//     window.location.href = $action_link;
//   }else{
//     window.location.href = $action_link;
//   }
// });

// });

// setInterval(get_notification, 1000 * 60 * 60);
