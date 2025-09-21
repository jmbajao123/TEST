<style>
  .custom-checkbox {
    width: 18px;
    height: 18px;
    border: 2px solid black !important;
    cursor: pointer;
  }
  .custom-checkbox:checked {
    background-color: black;
    border-color: black;
  }
</style>

<script>
  // Allow only one checkbox to be selected
  const semesterCheckboxes = document.querySelectorAll('input[name="semester[]"]');
  
  semesterCheckboxes.forEach(checkbox => {
    checkbox.addEventListener('change', () => {
      if (checkbox.checked) {
        semesterCheckboxes.forEach(other => {
          if (other !== checkbox) {
            other.checked = false;
          }
        });
      }
    });
  });
</script>