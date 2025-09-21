<!-- Script to calculate total -->
<script>
document.addEventListener("DOMContentLoaded", function () {
    const checkboxes = document.querySelectorAll(".doc-checkbox");
    const totalInput = document.getElementById("total_payment");

    function calculateTotal() {
        let total = 0;
        checkboxes.forEach(cb => {
            if (cb.checked) {
                total += parseFloat(cb.getAttribute("data-price")) || 0;
            }
        });
        totalInput.value = total.toFixed(2); // display with 2 decimals
    }

    checkboxes.forEach(cb => {
        cb.addEventListener("change", calculateTotal);
    });
});
</script>