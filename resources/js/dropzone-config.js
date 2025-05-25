import Dropzone from "dropzone";

Dropzone.autoDiscover = false;

document.addEventListener("DOMContentLoaded", function () {
    const imageInput = document.getElementById("image");

    const dropzoneElement = document.querySelector("#imagenDropzone");

    if (!dropzoneElement) return;

    let dropzone = new Dropzone(dropzoneElement, {
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
            if (imageInput) {
                imageInput.value = response.path;
            }
        },
        removedfile: function (file) {
            if (imageInput) {
                imageInput.value = "";
            }
            if (file.previewElement) {
                file.previewElement.remove();
            }
        },
        init: function () {
            this.on("addedfile", function (file) {
                if (this.files.length > 1) {
                    this.removeFile(this.files[0]);
                }

                if (file.previewElement) {
                    const img = file.previewElement.querySelector("img");
                    if (img) {
                        img.style.cursor = "pointer";
                        img.addEventListener("click", () => {
                            dropzoneElement.click();
                        });
                    }
                }
            });
        }
    });

    let existingImage = imageInput?.value;

    if (existingImage) {
        const mockFile = { name: "Imagen actual", size: 12345, type: "image/jpeg" };

        dropzone.emit("addedfile", mockFile);
        dropzone.emit("thumbnail", mockFile, existingImage);
        dropzone.emit("complete", mockFile);

        dropzone.files.push(mockFile);
    }
});
