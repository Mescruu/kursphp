$(document).ready(function() {

    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

    // Delete record
    $(document).on("click", ".close", function () {
        var delete_id = $(this).data('id');
        alert(delete_id);
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