<!DOCTYPE html>
<html>

<head>
    <link href="https://fonts.googleapis.com/css2?family=Muli&display=swap" rel="stylesheet">
    <style>
        /* Style for the OTP box */
        .otp-box {
            background-color: #f5f5f5;
            padding: 18px;
            border-radius: 5px;
            font-size: 24px;
            font-weight: bolder;
            text-align: center;
            display: inline-block;
            width: 46%;
            letter-spacing: 0.3rem;
        }
    </style>
</head>

<body style="font-family: 'Muli', sans-serif; font-size: 16px; line-height: 1.6; margin: 0; padding: 0;">
    <div class="content" style="max-width: 600px; margin: 0 auto; padding: 20px;">
        <!-- Preheader Text -->
        <span
            style="display:none; font-size:1px; color:#007bff; line-height:1px; max-height:0px; max-width:0px; opacity:0; overflow:hidden;">Activate
            your account with the OTP code</span>

        <p>Hello {{ $user->email }},</p>
        <p>Thank you for signing up with {{ config('app.name') }}!</p>
        <!-- OTP Box -->
        <div class="otp-box">
            {{ $user->otp }}
        </div>
        <p>This code is valid for 30 minutes. and it's due to expire at {{ $user->otp_expires_at }}.</p>
        <p>Please use this code to complete your registration within the provided time frame.</p>
        <p>If you didn't sign up for {{ config('app.name') }}, please ignore this email.</p>
        <p>If you have any questions or need assistance, please don't hesitate to contact us.</p>
        <p>Yours,</p>
        <p>The {{ config('app.name') }} team</p>
    </div>
</body>

</html>
