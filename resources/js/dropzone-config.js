import Dropzone from "dropzone";

Dropzone.autoDiscover = false;

document.addEventListener("DOMContentLoaded", function () {
    const fileInput = document.getElementById("image");
    const dropzoneElement = document.querySelector("#imagenDropzone");

    if (!dropzoneElement || !fileInput) return;

    const dropzone = new Dropzone(dropzoneElement, {
        url: "/fake",
        autoProcessQueue: false,
        clickable: true,
        maxFiles: 1,
        acceptedFiles: "image/*",
        addRemoveLinks: true,
        previewsContainer: dropzoneElement,
        createImageThumbnails: true,
        paramName: "image",

        init: function () {
            this.on("addedfile", function (file) {

                if (this.files.length > 1) {
                    this.removeFile(this.files[0]);
                }

                const dataTransfer = new DataTransfer();
                dataTransfer.items.add(file);
                fileInput.files = dataTransfer.files;
            });

            this.on("removedfile", function () {
                fileInput.value = "";
            });
        },
    });
});
