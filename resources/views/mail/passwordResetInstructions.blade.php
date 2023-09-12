<!DOCTYPE html>
<html>
<head>
  <link href="https://fonts.googleapis.com/css2?family=Muli&display=swap" rel="stylesheet">
</head>
<body style="font-family: 'Muli', sans-serif; font-size: 16px; line-height: 1.6; margin: 0; padding: 0;">
  <div class="content" style="max-width: 600px; margin: 0 auto; padding: 20px;">
    <!-- Preheader Text -->
    <span style="display:none; font-size:1px; color:#007bff; line-height:1px; max-height:0px; max-width:0px; opacity:0; overflow:hidden;">Reset your password to regain account access</span>
    
    <p>Hello {{ $user->name }},</p>
    <p>Somebody requested a new password reset authorization on <b>{{ $time }}</b> from {{ config('app.url') }} account associated with {{ $user->email }}.</p>
    <p>No changes have been made to your account yet.</p>
    <p>You can reset your password by clicking the button below:</p>
    <a href="{{ $actionLink }}" style="display: inline-block; padding: 10px 20px; background-color: #007bff; color: #fff; text-decoration: none; border-radius: 5px;" class="btn">Reset my account password</a>
    <p>The link is valid for <b>4 hours</b>.</p>
    <p>If the button does not work, you can also click on the link below to reset your password:</p>
    <p><a href="{{ $actionLink }}" style="color: #007bff;">{{ $actionLink }}</a></p>
    <p>If you did not request a new password, please let us know immediately by replying to this email.</p>
    <p>Yours,</p>
    <p>The {{ config('app.name') }} team</p>
  </div>
</body>
</html>
