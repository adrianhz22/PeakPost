document.addEventListener("trix-attachment-add", async ({ attachment }) => {
    if (!attachment.file) return;

    const formData = new FormData();
    formData.append("file", attachment.file);

    const csrfToken = document.querySelector('meta[name="csrf-token"]').content;

    const res = await fetch("/trix-image", {
        method: "POST",
        headers: {
            "X-CSRF-TOKEN": csrfToken
        },
        body: formData
    });

    const { url } = await res.json();
    attachment.setAttributes({ url, href: url });
});
