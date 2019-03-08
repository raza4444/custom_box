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

<script  type="text/javascript">(function () {
        var options = {
           facebook: "saremcotech", // Facebook page ID
            //facebook: "993314740879356",
            whatsapp: "+923007992777", // WhatsApp number
            email: "info@saremcotech.com", // Email
            call: "0306-4035992", // Call phone number
           
            company_logo_url: "https://staging.saremcopackaging.com/uploads/settings/15504717829329.png", // URL of company logo (png, jpg, gif)
            greeting_message: "Contact Us \n042-35440451\n", // Text of greeting message
            call_to_action: "Call Us!", // Call to action
            button_color: "#00A5E7", // Color of button
            position: "left", // Position may be 'right' or 'left'
            order: "facebook,whatsapp,email,call", // Order of buttons
        };
        var proto = document.location.protocol, host = "whatshelp.io", url = proto + "//static." + host;
        var s = document.createElement('script'); s.type = 'text/javascript'; s.async = true; s.src = url + '/widget-send-button/js/init.js';
        s.onload = function () { WhWidgetSendButton.init(host, proto, options); };
        var x = document.getElementsByTagName('script')[0]; x.parentNode.insertBefore(s, x);
    })();</script>  