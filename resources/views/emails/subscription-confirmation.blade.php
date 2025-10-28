<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Confirm your LevelMinds Subscription</title>
</head>
<body style="font-family:Arial, sans-serif; background:#f9f9f9; padding:30px;">
    <div style="max-width:600px;margin:auto;background:#fff;padding:20px;border-radius:8px;">
        <div style="text-align:center;margin-bottom:16px;">
            <img src="{{ asset('images/branding/logo.svg') }}" alt="LevelMinds" style="height:48px;">
        </div>
        <h2 style="color:#3248ad;">Welcome to LevelMinds Blog!</h2>
        <p>Hi there,</p>
        <p>Thank you for subscribing to our blog updates.</p>
        <p>Click the button below to confirm your subscription:</p>

        <p style="text-align:center;">
            <a href="{{ route('subscribe.confirm', $subscription->confirmation_token) }}"
               style="background:#0047FF;color:white;padding:10px 20px;border-radius:6px;text-decoration:none;">
                Confirm Subscription
            </a>
        </p>

        <p>If you didn’t request this, you can safely ignore this email.</p>
        <p>– The LevelMinds Team</p>
    </div>
</body>
</html>
