import Dropzone from "dropzone";

Dropzone.autoDiscover = false;

document.addEventListener("DOMContentLoaded", function () {
    let dropzone = new Dropzone("#imagenDropzone", {
        url: "/upload-image",
        paramName: "file",
        maxFiles: 1,
        acceptedFiles: "image/*",
        addRemoveLinks: true,
        dictDefaultMessage: "Arrastra aqui tu imagen o haz click",
        headers: {
            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content"),
        },
        success: function (file, response) {
            document.querySelector("input[name='image']").value = response.path;
        },
        removedfile: function (file) {
            document.querySelector("input[name='image']").value = "";
            file.previewElement.remove();
        }
    });

    let existingImage = document.querySelector("input[name='image']").value;

    if (existingImage) {
        let mockFile = { name: "Imagen actual", size: 12345, type: "image/jpeg" };

        dropzone.emit("addedfile", mockFile);
        dropzone.emit("thumbnail", mockFile, `/storage/posts/${existingImage}`);
        dropzone.files.push(mockFile);
    }
});
