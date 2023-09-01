
$( function() {

    // Configure the search box to use autocomplete
    $( "#search-box" ).autocomplete({
        source: function(request, response) {
            console.log(request.term);
            // Send an AJAX request to the search URL
            $.ajax({
                url: searchUrl,
                type: "GET",
                data: {
                    q: request.term
                },
                dataType: "json",
                success: function(data) {
                    console.log(data);
                    response($.map(data, function(item) {
                        return {
                            label: item.title,
                            value: item.postId,
                        };
                    }));
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log('AJAX Error: ' + textStatus + ' - ' + errorThrown);
                }
            });
        },
        minLength: 2,

        select: function(event, ui) {
            event.preventDefault();
            // Set the value of the search box to the selected label
            $("#search-box").val(ui.item.label);
            // $("#post-id").val(ui.item.value);
            // Navigate to the selected post
            // window.location.href = postUrl + ui.item.value;
        }
    });
});
