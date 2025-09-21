<script>
                const dateInput = document.getElementById('c_date');
                const today = new Date();

                // Options for formatted date
                const options = { year: 'numeric', month: 'long', day: 'numeric' };
                dateInput.value = today.toLocaleDateString('en-US', options); // e.g., September 5, 2025
              </script>