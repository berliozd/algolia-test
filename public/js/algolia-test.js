jQuery(function () {

    // POST form
    $("#postForm").submit(function (event) {

        // Stop form from submitting normally
        event.preventDefault();

        var $form = $(this),
            name = $form.find("input[name='name']").val(),
            image = $form.find("input[name='image']").val(),
            link = $form.find("input[name='link']").val(),
            category = $form.find("input[name='category']").val(),
            rank = $form.find("input[name='rank']").val(),
            apiUrl = $form.attr("action");

        var posting = $.post(apiUrl, {
            name: name,
            image: image,
            link: link,
            category: category,
            rank: rank
        });


        posting.fail(function (data) {
            $('#post-message').html('Error : ' + data.responseJSON.error + '- code : ' + data.responseJSON.errorCode);
        });

        posting.done(function (data) {
            $('#post-message').html('Object ' + data.objectID + ' added!');
        });
    });


    // DELETE form
    $("#deleteForm").submit(function (event) {

        // Stop form from submitting normally
        event.preventDefault();

        var $form = $(this),
            id = $form.find("input[name='id']").val(),
            apiUrl = $form.attr("action");

        var posting = $.ajax({
            type: "DELETE",
            url: apiUrl + '/' + id
        });


        posting.fail(function (data) {
            $('#delete-message').html('Error : ' + data.responseJSON.error + '- code : ' + data.responseJSON.errorCode);
        });

        posting.done(function (data) {
            $('#delete-message').html('Object ' + data.objectID + ' deleted!');
        });
    });


    // FILL delete form with id
    $("#hits").on("click", ".delete-link", function (event) {
        event.preventDefault();
        id = $(this).data().id;
        $("#id-to-delete").val(id);
        $('#delete-message').html('');
        $(window).scrollTo($('#deleteForm'), 500);
        $('#deleteFieldset').addClass('highlight');
        setTimeout(function(){$('#deleteFieldset').removeClass('highlight')}, 2000);
    });

});



