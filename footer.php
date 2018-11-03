</div>
<label for="sidebar-checkbox" class="sidebar-toggle"></label>
<script type="text/javascript">
    (function(document) {
        var toggle = document.querySelector('.sidebar-toggle');
        var sidebar = document.querySelector('#sidebar');
        var checkbox = document.querySelector('#sidebar-checkbox');
        document.addEventListener('click', function(e) {
            var target = e.target;
            if(!checkbox.checked ||
                sidebar.contains(target) ||
                (target === checkbox || target === toggle)) return;
            checkbox.checked = false;
        }, false);
    })(document);
</script>
<!-- CSS -->
<link rel="stylesheet" href="/wp-content/themes/techblogger/assets/css/poole.css">
<link rel="stylesheet" href="/wp-content/themes/techblogger/assets/css/syntax.css">
<link rel="stylesheet" href="/wp-content/themes/techblogger/assets/css/lanyon.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans">
<link rel="stylesheet" href="/wp-content/themes/techblogger/assets/css/prism.css">
<script type="text/javascript" src="/wp-content/themes/techblogger/assets/js/prism.js"></script>
<?php wp_footer(); ?>
</body>
</html>
