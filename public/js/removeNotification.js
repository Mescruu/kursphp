$(document).ready(function() {

    let totalCount=$("#v-pills-notifications > div").length;
    $('#notNumber').text(totalCount);

    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

    // Delete record
    $(document).on("click", ".closeWarning", function () {




        if(confirm("Tej oparacji nie da się cofnąć!")) {

            totalCount--;
            $('#notNumber').text(totalCount);

            if(totalCount==0){
                $('#v-pills-notifications').text("<h4>Brak powiadomień</h4>");
            }


            $("#not"+$(this).data('id')).hide(500);



            var delete_id = $(this).data('id');
            var el = this;
            $.ajax({
                url: '/powiadomienia/usun/',
                type: 'get',
                data:{id:delete_id},
                success: function (response) {
                    $(el).closest("tr").remove();
                }
            });

            }


    });
    $(document).on("click", ".closePrimary", function () {

        totalCount--;
        $('#notNumber').text(totalCount);

        if(totalCount==0){
            $('#v-pills-notifications').html(" <h2>\n" +
                "                            Powiadomienia\n" +
                "                        </h2>\n" +
                "                        <hr>" +
                "<h4>Brak powiadomień</h4>");
        }
            $("#not"+$(this).data('id')).hide(500);

            var delete_id = $(this).data('id');
            var el = this;
            $.ajax({
                url: '/powiadomienia/usun/',
                type: 'get',
                data:{id:delete_id},
                success: function (response) {
                    $(el).closest("tr").remove();
                }
            });

    });
});