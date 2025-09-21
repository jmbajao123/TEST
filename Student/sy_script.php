<!-- ✅ Script -->
<script>
  document.addEventListener("DOMContentLoaded", function () {
    // Get today's date
    const today = new Date().toISOString().split("T")[0];

    // Restrict inputs to past dates only (before today)
    document.getElementById("e_sy").setAttribute("max", new Date(Date.now() - 86400000).toISOString().split("T")[0]);
    document.getElementById("hs_sy").setAttribute("max", new Date(Date.now() - 86400000).toISOString().split("T")[0]);
  });
</script>