<script>
  // Generate 8-character unique code
  function generateReferenceCode() {
    const chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    let code = "";
    for (let i = 0; i < 8; i++) {
      code += chars.charAt(Math.floor(Math.random() * chars.length));
    }
    return code;
  }

  // Set value when page loads
  document.addEventListener("DOMContentLoaded", function () {
    document.getElementById("req_referrence").value = generateReferenceCode();
  });
</script>