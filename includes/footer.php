
<footer>
    © 2026 Tabela Transport • All Rights Reserved
</footer>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>

  

   document.querySelectorAll(".dropdown-toggle").forEach(function (toggle) {
    toggle.addEventListener("click", function (e) {
        e.preventDefault();

        document.querySelectorAll(".dropdown-menu").forEach(menu => {
            if (menu !== toggle.nextElementSibling) {
                menu.classList.remove("show");
            }
        });

        toggle.nextElementSibling.classList.toggle("show");
    });
});


    function toggleSidebar() {
        document.getElementById('sidebar').classList.toggle('show');
    }

    // Close sidebar when clicking outside on mobile
   

</script>

</body>
</html>