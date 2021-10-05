$("#btn").on("click", function () {
    $.ajax("get_time.php").done(function (data) {
        $("#time").html(data);
    });
});

$("#btn2").on("click", function () {
    $.ajax("get_data.php").done(function (data) {

        var json = JSON.parse(data)
        $('#name').html(json.name);
        $('#email').html(json.email);
        $("#dob").html(json.dob);
    });
});
