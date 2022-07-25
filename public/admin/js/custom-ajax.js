
jQuery(document).ready(function () {
    //check if firm_name is OTHER
    jQuery("#firm_name").on('change', function () {
        var firm_name = jQuery("#firm_name").val();
        if (firm_name == "Other") {
            jQuery(".add_firm_form").show();
        } else {
            jQuery(".add_firm_form").hide();
        }
    });

    //Ajax code for show member list according to firm name
    $(document).on("change", ".choose_firm_name", function (e) {
        e.preventDefault();
        var _token = $("input[name='_token']").val();
        var firm_id = $(this).val();

        //set all val
        var options = { "_token": _token, "firm_id": firm_id };

        $.ajax({
            type: "GET",
            url: base_url + "/assign-manage-member-list",
            context: this,
            data: options,
            beforeSend: function () {
                $(".custom_loader").show();
            },
            success: function (responce) {
                $(".assign_member_list_reponce").html(responce);
                $(".custom_loader").hide();
                setTimeout(function () {
                    $(".success-msg").fadeOut(3000);
                    $(".unsuccess-msg").fadeOut(3000);
                }, 3000);
            }
        });
    });
});