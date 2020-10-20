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

    // REST OF THE CODE





});