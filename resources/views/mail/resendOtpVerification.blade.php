<!DOCTYPE html>
<html>

<body
    style="font-family: 'Times New Roman'; font-size: 14px; background: #f4f6f9; line-height: 1.6; margin: 0; padding: 2rem;">
    <div class="content" style="max-width: 600px; margin: 0 auto; background: #fff; padding: 30px;">
        <!-- Preheader Text -->
        <span
            style="display:none; font-size:1px; color:#007bff; line-height:1px; max-height:0px; max-width:0px; opacity:0; overflow:hidden;">Activate
            your account with the OTP code and complete your verification process.</span>

        <p>Hello {{ $user->email }},</p>
        <p>Your new OTP verification code is: <b>{{ $user->otp }}</b></p>
        <p>This code is only valid for 30 minutes, and it's due to expire at <b> {{ $user->otp_expires_at }} </b>.</p>
        <p>Please use this code to complete your verification process within the provided time frame.</p>
        <p>If you didn't request for this OTP, please ignore this email alert.</p>
        <p>If you have any questions or need assistance, please don't hesitate to contact us.</p>
        <p>Yours,</p>
        <p>The {{ config('app.name') }} team</p>
        <div class="notice" style="border-top: 1px solid #d8d8d8; border-style: thin; padding-top: 0.2rem;width:100%;">
            <p style="font-style:italic;font-size:0.8rem;">Please note that this email was sent from an unmonitored email
                address system, so do not reply to this email alert. Only reply to <a
                    href="mailo:service@paysprint.com">service@paysprint.com.</a> We're available 24/7 to provide you
                with assistance.</p>
            <div class="location" style="line-height: 0.456rem;font-size:0.9rem;font-style:italic;">
                <p>AY108 DEGU, ST</p>
                <p>Kasoa, Semenshyia.</p>
                <p>Ghana.</p>
            </div>
        </div>
    </div>
</body>

</html>
