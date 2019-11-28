$(document).ready(function() {

    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

    // Delete record
    $(document).on("click", ".closeWarning", function () {

        if(confirm("Tej oparacji nie da się cofnąć!")) {

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