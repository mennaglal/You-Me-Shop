<!-- BEGIN GLOBAL MANDATORY SCRIPTS -->

<script src="{{asset('assets/ltr/js/libs/jquery-3.1.1.min.js')}}"></script>

<script src="{{asset('assets/bootstrap/js/popper.min.js')}}"></script>
<script src="{{asset('assets/bootstrap/js/bootstrap.min.js')}}"></script>

<script src="{{asset('assets/ltr/plugins/perfect-scrollbar/perfect-scrollbar.min.js')}}"></script>
<script src="{{asset('assets/ltr/js/app.js')}}"></script>

<script>
    $(document).ready(function() {
        App.init();
    });
</script>

<script src="{{asset('assets/ltr/js/custom.js')}}"></script>

<!-- END GLOBAL MANDATORY SCRIPTS -->

<!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->

<script src="{{asset('assets/ltr/plugins/font-icons/feather/feather.min.js')}}"></script>
<script type="text/javascript">
    feather.replace();
</script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.5.1/jquery.nicescroll.min.js"></script>
<script>
    $(document).ready(function() {
        $("html").niceScroll({horizrailenabled:false,cursorwidth: '10px', autohidemode: false, zindex: 999, cursorcolor: "#f4364f" });
    });
</script>


<!-- END PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->
