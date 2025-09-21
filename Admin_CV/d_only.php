<script>
                            document.getElementById("diploma").addEventListener("change", function() {
                                const fileInput = this;
                                const file = fileInput.files[0];
                                const errorMsg = document.getElementById("fileError");

                                if (file) {
                                    const fileType = file.type;
                                    if (fileType !== "application/pdf") {
                                        errorMsg.style.display = "block";
                                        fileInput.value = ""; // Clear the input
                                    } else {
                                        errorMsg.style.display = "none";
                                    }
                                }
                            });
                            </script>