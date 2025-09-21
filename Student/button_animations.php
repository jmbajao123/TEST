<!-- ✅ Extra Styling -->
<style>
  /* Hover + glow */
  #requestBtn {
    transition: all 0.3s ease-in-out;
  }

  #requestBtn:hover {
    background-color: #198754; /* Bootstrap success green */
    color: #fff;
    box-shadow: 0 0 12px rgba(25, 135, 84, 0.6);
    transform: translateY(-2px);
  }

  #requestBtn:active {
    transform: scale(0.96);
    box-shadow: 0 0 6px rgba(25, 135, 84, 0.5);
  }

  /* Loading text + icon */
  .btn-text,
  .btn-loading {
    display: inline-flex;
    align-items: center;
    justify-content: center;
  }
</style>

<!-- ✅ Script -->
<script>
  document.addEventListener("DOMContentLoaded", function () {
    const requestBtn = document.getElementById("requestBtn");
    const btnText = requestBtn.querySelector(".btn-text");
    const btnLoading = requestBtn.querySelector(".btn-loading");
    const loadingPercent = document.getElementById("loadingPercent");

    requestBtn.addEventListener("click", function (e) {
      e.preventDefault(); // stop default modal trigger

      // Switch to loading state
      btnText.classList.add("d-none");
      btnLoading.classList.remove("d-none");

      let percent = 0;
      loadingPercent.textContent = "0%";

      const interval = setInterval(() => {
        percent += 5;
        loadingPercent.textContent = percent + "%";

        if (percent >= 100) {
          clearInterval(interval);

          // Small delay for smoothness
          setTimeout(() => {
            // Reset button
            btnText.classList.remove("d-none");
            btnLoading.classList.add("d-none");
            loadingPercent.textContent = "0%";

            // ✅ Open modal correctly
            const modalEl = document.getElementById("requestModal");
            const modal = new bootstrap.Modal(modalEl);
            modal.show();
          }, 300);
        }
      }, 80); // speed (5% every 80ms ≈ 1.6s total)
    });
  });
</script>
<button type="button" id="requestBtn" class="btn btn-outline-success position-relative overflow-hidden rounded-pill px-4 py-2 fw-semibold">
                <span class="btn-text"><i class="bi bi-file-earmark-text me-2"></i> Request Documents</span>
                <span class="btn-loading d-none">
                  <i class="bi bi-file-earmark-arrow-up me-2 spin-icon"></i> <span id="loadingPercent">0%</span>
                </span>
              </button>