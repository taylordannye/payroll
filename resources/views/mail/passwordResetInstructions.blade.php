<!DOCTYPE html>
<html>

<head>
    <link href="https://fonts.googleapis.com/css2?family=Muli&display=swap" rel="stylesheet">
</head>

<body
    style="font-family: 'Muli', sans-serif; font-size: 14px; background: #f4f6f9; line-height: 1.6; margin: 0; padding: 2rem;">
    <div class="content" style="max-width: 600px; margin: 0 auto; background: #fff; padding: 30px;">
        <!-- Preheader Text -->
        <span
            style="display:none; font-size:1px; color:#007bff; line-height:1px; max-height:0px; max-width:0px; opacity:0; overflow:hidden;">Reset
            your password to regain account access</span>

        <p>Hello {{ $user->surname }},</p>
        <p>Somebody requested a new password reset authorization on <b>{{ $time }}</b> from
            {{ config('app.url') }} account associated with {{ $user->email }}.</p>
        <p>No changes have been made to your account yet.</p>
        <p>You can reset your password by clicking the button below:</p>
        <a href="{{ $actionLink }}"
            style="display: inline-block; padding: 10px 50px; background-color: #007bff; color: #fff; text-decoration: none; border-radius: 5px;     box-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
"
            class="btn">Reset my account password</a>
        <p>The link for resetting your password is only valid for <b>4 hours</b>.</p>
        <p>If the button does not work, you can also click on the link below to reset your password:</p>
        <p><a href="{{ $actionLink }}" style="color: #007bff;">{{ $actionLink }}</a></p>
        <p>If you did not request a new password, please let us know immediately by reaching out to us on our contact
            page <b>OR</b> writing to us at <strong>abuse@paysync.com</strong>.</p>
        <p> You might as well ignore this email as no change has been made to your account yet, maybe it was a system
            glitch or malfunction. </p>
        <p>Yours,</p>
        <p>The {{ config('app.name') }} team</p>
    </div>
    <p style="font-size: 0.7rem; text-align: center; font-style: italic;">Please do not reply to this email as it was sent from un-monitored email account.</p>
</body>

</html>
