/// <reference path="../../typings/globals/jquery/index.d.ts" />

// const { result } = require("lodash");

$(document).ready(function() {
    var Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000
    });
    // $(document).on("click", ".show-modal",function(e) {
    //     // console.log(e)
    //     $($(this).data('id')).modal('show');
    // })
    // $(document).on("click", "[data-dismiss=modal]", function() {
    //     $(this).closest('.modal').modal('toggle')
    // })
    let switcher = false;
    $('#SelectPossible').click(function() {
        switch (switcher) {
            case false:
                $(this).text('Отменить')
                $('.gallery-img-div').find('img').css('opacity', '0.5')
                $('.gallery-img-div').removeClass('show-modal')
                $('.gallery-img-div').addClass('to-select')
                $('.select-img').parent().removeClass('d-none')
                $('#DeleteImage').removeClass('d-none')
                switcher = true;
                break;
            case true:
                $(this).text('Множественный выбор')
                $('.gallery-img-div').find('img').css('opacity', '1')
                $('.gallery-img-div').addClass('show-modal')
                $('.gallery-img-div').removeClass('to-select')
                $('.select-img').parent().addClass('d-none')
                $('#DeleteImage').addClass('d-none')
                switcher = false;
                break;
        }
    })

    $(document).on('click', '.to-select', function(){
        let checkbox = $(this).find('input[type=checkbox]')
        switch (checkbox.prop('checked')) {
            case true:
                checkbox.attr('checked', false)
                break;
            case false:
                checkbox.attr('checked', true)
                break;
        }
    })
    $(document).on("submit", ".EditImage", function(e) {
        $(this).closest('.modal').modal('toggle')
        e.preventDefault();
        $(this).ajaxSubmit({
            success: function() {
                Toast.fire({
                    icon: 'success',
                    title: 'Данные успешно изменены',
                })
            }
        })
    })
    $('#DeleteSelected').submit(function (e) {
        e.preventDefault()
        $(this).ajaxSubmit({
            success: function (res) { 
                $.each(res.id, function(key, val) {
                    $('#image' + val).remove();
                    $('[data-id="#image' + val + '"]').remove();
                    // console.log($('[data-id="#image' + val + '"]'))
                })
            }
        })
    })
    $(document).on('submit', '.DeleteImage', function(e) {
        e.preventDefault()
        let el = $(this)
        $(this).closest('.modal').modal('toggle')
        $(this).ajaxSubmit({
            success: function () { 
                $('#image' + el.data('id')).remove();
                $('[data-id="#image' + el.data('id') + '"]').remove();
            }
        })
    })
    $('#DeleteSelected').submit(function (e) {
        e.preventDefault()
        $(this).ajaxSubmit({
            success: function (res) { 
                $.each(res.id, function(key, val) {
                    // $('#image' + val).remove();
                    $('[data-id="#image' + val + '"]').remove();
                    // console.log($('[data-id="#image' + val + '"]'))
                })
            }
        })
    })
    Dropzone.autoDiscover = false

    // Get the template HTML and remove it from the doumenthe template HTML and remove it from the doument
    var previewNode = document.querySelector("#template")
    previewNode.id = ""
    var previewTemplate = previewNode.parentNode.innerHTML
    previewNode.parentNode.removeChild(previewNode)

    var myDropzone = new Dropzone(document.body, { // Make the whole body a dropzone
        url: $('button.start').data('url'), // Set the url
        thumbnailWidth: 80,
        thumbnailHeight: 80,
        parallelUploads: 20,
        previewTemplate: previewTemplate,
        autoQueue: false, // Make sure the files aren't queued until manually added
        previewsContainer: "#previews", // Define the container to display the previews
        clickable: ".fileinput-button", // Define the element that should be used as click trigger to select files.
        params: {
            _token: $('meta[name="csrf-token"]').attr('content')
        }
    })

    myDropzone.on("addedfile", function(file) {
        // Hookup the start button
        file.previewElement.querySelector(".start").onclick = function() {
            myDropzone.enqueueFile(file)
        }
    })

    // Update the total progress bar
    myDropzone.on("totaluploadprogress", function(progress) {
        document.querySelector("#total-progress .progress-bar").style.width = progress + "%"
    })

    myDropzone.on("sending", function(file) {
        // Show the total progress bar when upload starts
        document.querySelector("#total-progress").style.opacity = "1"
        // And disable the start button
        file.previewElement.querySelector(".start").setAttribute("disabled", "disabled")
    })

    // Hide the total progress bar when nothing's uploading anymore
    myDropzone.on("queuecomplete", function(progress, res) {
        document.querySelector("#total-progress").style.opacity = "0"
    })
    myDropzone.on("success", function(file, response) {
        console.log(response);
        $(response.image).prependTo($('div.row.row-cols-auto'))
    })

    myDropzone.on("error", function(err) {
        console.log(err)
        Toast.fire({
            icon: 'error',
            title: 'Error!',
        })
    })

    // Setup the buttons for all transfers
    // The "add files" button doesn't need to be setup because the config
    // `clickable` has already been specified.
    document.querySelector("#actions .start").onclick = function() {
        myDropzone.enqueueFiles(myDropzone.getFilesWithStatus(Dropzone.ADDED))
    }
    document.querySelector("#actions .cancel").onclick = function() {
        myDropzone.removeAllFiles(true)
    }
})