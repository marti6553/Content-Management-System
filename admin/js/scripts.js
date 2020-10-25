$(document).ready(function () {
    // CKEDITOR
    ClassicEditor
        .create(document.querySelector('#body'))
        .catch(error => {
            console.error(error);
        });
    // CHECKBOXES IN VIEW_ALL_POSTS
    $('#selectAllBoxes').click(function (event) {
        if (this.checked) {
            $('.checkBoxes').each(function () {
                this.checked = true;
            });
        } else {
            $('.checkBoxes').each(function () {
                this.checked = false;
            });
        }
    });
    function loadUsersOnline() {
        $.get("functions.php?onlineusers=result", function (data) {
            $(".usersonline").text(data);
        });
    }
    setInterval(function () {
        loadUsersOnline();
    }, 500);


    // REST OF THE CODE





});