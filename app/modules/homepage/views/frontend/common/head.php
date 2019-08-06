<link rel="stylesheet" href="templates/frontend/css/bootstrap.min.css" type="text/css" />
<link rel="stylesheet" href="templates/frontend/css/template.css" type="text/css" />
<link rel="stylesheet" href="templates/frontend/css/nmc.css" type="text/css" />
<link rel="stylesheet" href="templates/frontend/css/nam.css" type="text/css" />
<link rel="stylesheet" href="templates/frontend/css/font-awesome.min.css" type="text/css" />
<link href="templates/frontend/css/divbox.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="templates/frontend/js/jquery.min.js"></script>
<script src="templates/frontend/js/divbox.js"></script>
<script type="text/javascript">
    jQuery(document).ready(function($) {
        $(".scroll").click(function(event) {
            event.preventDefault();
            $('html,body').animate({
                scrollTop: $(this.hash).offset().top
            }, 1000);
        });
    });
</script>