export function setupImagePreview(imageInputRef, imagePreviewRef) {
    imageInputRef.addEventListener("change", function (e) {
        const file = e.target.files[0];

        if (file) {
            const reader = new FileReader();

            reader.onload = function (e) {
                imagePreviewRef.src = e.target.result;
                imagePreviewRef.style.display = "block";
            };

            reader.readAsDataURL(file);
        } else {
            imagePreviewRef.src = "";
            imagePreviewRef.style.display = "none";
        }
    });
}
