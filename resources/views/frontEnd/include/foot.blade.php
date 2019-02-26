<script src="{{ URL::asset('js/app.js') }}"></script>
<!-- jQuery JS -->
        <script src="{{ URL::asset('front_end/js/vendor/jquery-1.12.4.min.js') }}"></script>
        <!-- Popper JS -->
        <script src="{{ URL::asset('front_end/js/popper.min.js') }}"></script>
        <!-- Bootstrap JS -->
        <script src="{{ URL::asset('front_end/js/bootstrap.min.js') }}"></script>
        <!-- Plugins JS -->
        <script src="{{ URL::asset('front_end/js/plugins.js') }}"></script>
        <!-- Main JS -->
        <script src="{{ URL::asset('front_end/js/main.js') }}"></script>
<script type="text/javascript">
	$('form.subscribeForm').submit(function () {
            var email = $('#subscribe_email').val();

                //var f = $(this).find('.form-group'),
                    ferror = false,
                    emailExp = /^[^\s()<>@,;:\/]+@\w[\w\.-]+\.[a-z]{2,}$/i;
                if(email == '' || email == null)
            {
                ferror = true;
            }
                if (ferror) return false;
                else var str = $(this).serialize();
                $.ajax({
                    type: "POST",
                    url: "<?php echo route("subscribeSubmit"); ?>",
                    data: str,
                    success: function (msg) {
                        if (msg == 'OK') {
                            $("#subscribesendmessage").addClass("show");
                            $("#subscribeerrormessage").removeClass("show");
                            $("#subscribe_name").val('');
                            $("#subscribe_email").val('');
                        }
                        else {
                            $("#subscribesendmessage").removeClass("show");
                            $("#subscribeerrormessage").addClass("show");
                            $('#subscribeerrormessage').html(msg);
                        }

                    }
                });
                return false;
            });

</script>
