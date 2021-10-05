$(".delete-article-btn").on("click", function (e) {
    // prevent the default action of the element in this case it would be the default action of a anchor tag to direct to the href attribute
    e.preventDefault();
    // Are you sure confirmation popup
    if (confirm("Are you sure?")) {
        var frm = $("<form>");
        frm.attr('method', 'post');
        frm.attr('action', $(this).attr('href'));
        frm.appendTo("body");
        frm.submit();
    }
});

// create a new custom validation rule
$.validator.addMethod("dateTime", function(value, element){
    return (value == "") || ! isNaN(Date.parse(value));

}, "Must be a valid date and time")

// Validate the form using the JQuery Validate plugin
$('#formArticle').validate({
    // Set the fields to be validated
    rules: {
        title: {
            required: true
        },
        content: {
            required: true
        },
        published_at: {
            dateTime: true
        }
    }
})