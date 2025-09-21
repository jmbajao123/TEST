
<!-- 🔽 Dropdown JS: click only -->
<script>
  document.addEventListener("DOMContentLoaded", function () {
    // Notification Dropdown
    const notifToggle = document.getElementById("notifDropdown");
    if (notifToggle) {
      const notifDropdown = new bootstrap.Dropdown(notifToggle);
      notifToggle.addEventListener("click", function (e) {
        e.preventDefault();
        e.stopPropagation();
        notifDropdown.toggle();
      });
    }

    // User Dropdown
    const userToggle = document.getElementById("userDropdownToggle");
    if (userToggle) {
      const userDropdown = new bootstrap.Dropdown(userToggle);
      userToggle.addEventListener("click", function (e) {
        e.preventDefault();
        e.stopPropagation();
        userDropdown.toggle();
      });
    }

    // Close dropdowns when clicking outside
    document.addEventListener("click", function (e) {
      document.querySelectorAll(".dropdown-menu.show").forEach(menu => {
        if (!menu.parentElement.contains(e.target)) {
          bootstrap.Dropdown.getInstance(menu.previousElementSibling)?.hide();
        }
      });
    });

    // Close dropdowns with Esc
    document.addEventListener("keydown", function (e) {
      if (e.key === "Escape") {
        document.querySelectorAll(".dropdown-menu.show").forEach(menu => {
          bootstrap.Dropdown.getInstance(menu.previousElementSibling)?.hide();
        });
      }
    });
  });
</script>


<!-- ✅ Custom CSS for Animation -->
<style>
  /* Default state */
  .notif-subtext {
    display: inline-block;
    transition: all 0.3s ease;
  }

  /* Animate when hovering on title or parent */
  .notifLink:hover .notif-subtext {
    color: #0d6efd; /* Bootstrap primary blue */
    transform: translateX(5px); /* Slide effect */
    opacity: 1;
    font-weight: 500;
  }

  /* Optional: Title hover effect */
  .notifLink:hover .notif-title {
    color: #0a58ca; 
  }
</style>