<!DOCTYPE html>
<html>

<body style="font-family: 'Times New Roman'; background: #f4f6f9; line-height: 1.6; margin: 0; padding: 2rem;">
    <div class="content" style="max-width: 600px; margin: 0 auto; background: #fff; padding: 30px; font-size: 14px;">
        <!-- Preheader Text -->
        <span
            style="display:none; font-size:1px; color:#007bff; line-height:1px; max-height:0px; max-width:0px; opacity:0; overflow:hidden;">Reset
            your password to regain account access</span>

        <p>Hello {{ $user->firstname }},</p>
        <p>Someone requested a new password reset authorization on <b>{{ $time }}</b> from
            {{ config('app.url') }} account associated with {{ $user->email }}.</p>
            <b>More details from the originated request:</b>
            <div class="more-details" style="line-height: 0.456rem">
                <p>Originating Ip: {{ $userip }}</p>
                <p>Originating Country: {{ $usercountry }}</p>
                <p>Operating System Used: {{ $userOs }}</p>
            </div>
        <p>No changes have been made to your account yet.</p>
        <p>You can reset your password by clicking the button below:</p>
        <a href="{{ $actionLink }}"
            style="display: inline-block; padding: 10px 50px; background-color: #007bff; color: #fff; text-decoration: none; border-radius: 5px;     box-shadow: 0 2px 2px rgba(0, 0, 0, 0.1);
"
            class="btn">Reset my account password</a>
        <p>The link for resetting your password is only valid for <b>4 hours</b>.</p>
        <p>If the button does not work, you can also click on the link below to reset your password:</p>
        <p><a href="{{ $actionLink }}" style="color: #007bff;">{{ $actionLink }}</a></p>
        <p>If you did not request a new password, please let us know immediately by reaching out to us on our contact
            page <b>OR</b> writing to us at <a href="mailto:service@paysprint.com">service@paysprint.com</a>.</p>
        <p> You might as well ignore this email as no change has been made to your account yet, maybe it was a system
            glitch or malfunction. </p>
        <p>Yours,</p>
        <p>The {{ config('app.name') }} team</p>
        <div class="notice" style="border-top: 1px solid #d8d8d8; border-style: thin; padding-top: 0.2rem;width:100%;">
            <p style="font-style:italic;font-size:0.8rem;">Please note that this email was sent from an unmonitored
                email
                address system, so do not reply to this email alert. Only reply to <a
                    href="mailo:service@paysprint.com">service@paysprint.com.</a> We're available 24/7 to provide you
                with assistance.</p>
            <div class="location" style="line-height: 0.456rem;font-size:0.7rem;font-style:italic;">
                <p>AY108 DEGU, ST</p>
                <p>Kasoa, Semenshyia.</p>
                <p>Ghana.</p>
            </div>
        </div>
    </div>
</body>

</html>
