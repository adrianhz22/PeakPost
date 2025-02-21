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
        }
    });
});
