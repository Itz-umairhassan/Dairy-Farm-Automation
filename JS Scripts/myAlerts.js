function sucess_alert(status, message) {
    $("#alert_status").text(status);
    $("#alert_message").text(message);
    $(".alert").toggle();

    setTimeout(() => {
        $(".alert").toggle();
    }, 1000 * 2.5);
}

function failure_alert(status, message) {
    $(".alert").toggle();
    $(".alert").removeClass("alert-success");
    $(".alert").addClass("alert-danger");
    $("#alert_status").text(status);
    $("#alert_message").text(message);

    setTimeout(() => {
        $(".alert").toggle();
        $(".alert").removeClass("alert-danger");
        $(".alert").addClass("alert-success");
    }, 1000 * 2.5);
}
