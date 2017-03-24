$(document).ready(function () {
    var image;
    $('.preview-block').hide()
    $('#preview-button').on('click', function (e) {
        e.preventDefault();
        $('#preview .content').text('')
        $('.preview-block').show()

        var title = $('<h1/>').append($('[name="name"]').val())
        $('#preview .content').append(title)
        $('#preview .content').append($('[name="task"]').val())
        readURL(document.querySelector('[name="image"]'))

    })


    function readURL(input) {
        console.log(input.files, input)
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            console.log('test2')
            reader.onload = function (e) {
                image = e.target.result;
                $('#image-view').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
})