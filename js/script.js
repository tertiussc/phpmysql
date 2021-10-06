$(".delete-article-btn").on("click", function (e) {
    // prevent the default action of the element in this case it would be the default action of a anchor tag to direct to the href attribute
    e.preventDefault();
    // Are you sure confirmation popup
    if (confirm("Are you sure?")) {
        var frm = $("<form>");
        frm.attr("method", "post");
        frm.attr("action", $(this).attr("href"));
        frm.appendTo("body");
        frm.submit();
    }
});

// create a new custom validation rule
$.validator.addMethod(
    "dateTime",
    function (value, element) {
        return value == "" || !isNaN(Date.parse(value));
    },
    "Must be a valid date and time"
);

// Validate the form using the JQuery Validate plugin
// $("#formArticle").validate({
//     // Set the fields to be validated
//     rules: {
//         title: {
//             required: true,
//         },
//         content: {
//             required: true,
//         },
//         published_at: {
//             dateTime: true,
//         },
//     },
// });

// Implement the date and time picker
$("#published_at").datetimepicker({
    format: 'Y-m-d H:i:s'
});

// Publish articles
$("button.publish-now").on("click", function (e) {
    // Assign the data- (in this case "data-id" attribute value) received from the button element
    var id = $(this).data("id");
    var button = $(this);

    $.ajax({
        url: "/phpmysql/admin/publish_article.php",
        type: "POST",
        data: { id: id },
    }).done(function (data) {
        button.parent().html(data);
    });
});
