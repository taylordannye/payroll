<!DOCTYPE html>
<html>
<head>
  <link href="https://fonts.googleapis.com/css2?family=Muli&display=swap" rel="stylesheet">
</head>
<body style="font-family: 'Muli', sans-serif; font-size: 16px; line-height: 1.6; margin: 0; padding: 0;">
  <div class="content" style="max-width: 600px; margin: 0 auto; padding: 20px;">
    <!-- Preheader Text -->
    <span style="display:none; font-size:1px; color:#007bff; line-height:1px; max-height:0px; max-width:0px; opacity:0; overflow:hidden;">Your password has been changed successfully</span>
    <p>Hello {{ $user->name }},</p>
    <p>We're writing to confirm that your password for {{ config('app.name') }} account associated with {{ $user->email }} has been changed successfully.</p>
    <p>If you did not make this change or believe it was made in error, please immediately follow the instruction below.</p>
    <p>Reset your password, you can do so by clicking on the below link:</p>
    <p><a href="{{ route('forgot-password') }}" style="color: #007bff;">{{ route('forgot-password') }}</a></p>
    <p>Thank you for using {{ config('app.name') }}!</p>
    <p>Yours,</p>
    <p>The {{ config('app.name') }} team</p>
  </div>
</body>
</html>
