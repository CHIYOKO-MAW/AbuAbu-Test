<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Abu-Abu Admin</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        :root {
            --bg: #0B0F19;
            --surface: #161B26;
            --surface-hover: #1E2433;
            --border: #2A3142;
            --text: #E5E7EB;
            --text-dim: #9CA3AF;
            --primary: #8B5CF6;
            --primary-hover: #7C3AED;
            --red: #F87171;
        }
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { background: var(--bg); color: var(--text); font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif; font-size: 14px; line-height: 1.5; min-height: 100vh; display: flex; align-items: center; justify-content: center; }
        .login-box { background: var(--surface); border: 1px solid var(--border); border-radius: 8px; padding: 32px; width: 100%; max-width: 360px; }
        .login-title { font-size: 20px; font-weight: 600; text-align: center; margin-bottom: 8px; }
        .login-subtitle { font-size: 13px; color: var(--text-dim); text-align: center; margin-bottom: 24px; }
        .form-input { width: 100%; padding: 10px 12px; border: 1px solid var(--border); border-radius: 6px; font-size: 13px; background: var(--bg); color: var(--text); margin-bottom: 16px; }
        .form-input:focus { outline: none; border-color: var(--primary); }
        .btn { display: inline-flex; align-items: center; justify-content: center; padding: 10px 14px; border-radius: 6px; font-size: 13px; font-weight: 500; cursor: pointer; border: none; width: 100%; }
        .btn-primary { background: var(--primary); color: white; }
        .btn-primary:hover { background: var(--primary-hover); }
        .error { background: rgba(248, 113, 113, 0.15); border: 1px solid var(--red); color: var(--red); padding: 12px; border-radius: 6px; font-size: 13px; margin-bottom: 16px; }
    </style>
</head>
<body>
    <div class="login-box">
        <div>
            <h2 class="login-title">Abu-Abu Admin</h2>
            <p class="login-subtitle">Sign in to manage your archive</p>
        </div>
        <form method="POST" action="{{ route('admin.login') }}">
            @csrf
            <div>
                <input type="email" name="email" id="email" required class="form-input" placeholder="Email address" value="{{ old('email') }}">
            </div>
            <div>
                <input type="password" name="password" id="password" required class="form-input" placeholder="Password">
            </div>

            @if ($errors->any())
                <div class="error">
                    {{ $errors->first() }}
                </div>
            @endif

            <div>
                <button type="submit" class="btn btn-primary">Sign in</button>
            </div>
        </form>
    </div>
</body>
</html>