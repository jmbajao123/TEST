<script>
document.getElementById("tor").addEventListener("change", function() {
    const fileInput = this;
    const file = fileInput.files[0];
    const errorMsg = document.getElementById("torFileError");

    if (file) {
        if (file.type !== "application/pdf") {
            errorMsg.style.display = "block";
            fileInput.value = ""; // Clear the input
        } else {
            errorMsg.style.display = "none";
        }
    }
});
</script>