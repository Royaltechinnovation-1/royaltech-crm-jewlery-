<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In — {{ $businessName ?? 'JewelERP' }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@500;600;700&family=Cormorant+Garamond:wght@600;700&family=Manrope:wght@400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        :root {
            --gold: #d4af37;
            --gold-light: #f0d78c;
            --gold-deep: #a8841f;
            --glass: rgba(28, 18, 12, 0.72);
            --glass-border: rgba(212, 175, 55, 0.55);
            --text: #f7f3ea;
            --muted: rgba(247, 243, 234, 0.72);
        }

        * { box-sizing: border-box; }

        html, body {
            margin: 0;
            min-height: 100%;
        }

        body {
            font-family: "Manrope", system-ui, sans-serif;
            color: var(--text);
            background: #0a0705;
        }

        .login-page {
            position: relative;
            min-height: 100vh;
            min-height: 100dvh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 1.25rem;
            overflow: hidden;
        }

        .login-bg {
            position: absolute;
            inset: 0;
            background:
                linear-gradient(120deg, rgba(8, 5, 3, 0.55) 0%, rgba(8, 5, 3, 0.28) 45%, rgba(8, 5, 3, 0.45) 100%),
                url("{{ asset('images/login-bg.jpg') }}") center / cover no-repeat;
            transform: scale(1.02);
            animation: bg-drift 18s ease-in-out infinite alternate;
        }

        .login-layout {
            position: relative;
            z-index: 1;
            width: min(1120px, 100%);
            display: grid;
            grid-template-columns: 1fr;
            gap: 1.25rem;
            align-items: center;
        }

        @media (min-width: 960px) {
            .login-layout {
                grid-template-columns: minmax(240px, 0.9fr) minmax(380px, 1.15fr);
                gap: 1.75rem;
            }
        }

        /* ---- Video card (left) ---- */
        .video-card {
            position: relative;
            width: min(100%, 360px);
            margin: 0 auto;
            aspect-ratio: 9 / 16;
            max-height: min(78vh, 720px);
            border-radius: 1.1rem;
            overflow: hidden;
            border: 1.5px solid var(--glass-border);
            box-shadow:
                0 0 0 1px rgba(255, 215, 128, 0.08),
                0 24px 60px rgba(0, 0, 0, 0.45);
            background: #000;
            animation: rise 0.7s ease-out both;
        }

        @media (min-width: 960px) {
            .video-card {
                width: 100%;
                margin: 0;
                max-height: min(82vh, 760px);
            }
        }

        .video-card video {
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center;
            display: block;
        }

        .video-card::after {
            content: "";
            position: absolute;
            inset: 0;
            pointer-events: none;
            box-shadow: inset 0 0 40px rgba(0, 0, 0, 0.25);
            border-radius: inherit;
            z-index: 1;
        }

        /* Cover Gemini watermark with brand logo — scales on all screens */
        .video-watermark {
            position: absolute;
            right: clamp(0.45rem, 2.8%, 0.9rem);
            bottom: clamp(0.45rem, 2.8%, 0.9rem);
            z-index: 3;
            width: clamp(4.5rem, 28%, 7.5rem);
            max-width: 42%;
            padding: clamp(0.28rem, 1.5%, 0.45rem);
            border-radius: clamp(0.4rem, 1.2vw, 0.65rem);
            background: rgba(0, 0, 0, 0.72);
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.4);
            pointer-events: none;
            line-height: 0;
        }

        .video-watermark img {
            display: block;
            width: 100%;
            height: auto;
            object-fit: contain;
        }

        @media (max-width: 959px) {
            .video-watermark {
                width: clamp(4rem, 22vw, 6.5rem);
                max-width: 36%;
            }
        }

        @media (min-width: 1400px) {
            .video-watermark {
                width: clamp(6rem, 26%, 8.5rem);
            }
        }

        /* ---- Login glass card (right) ---- */
        .login-card {
            position: relative;
            width: 100%;
            max-width: 520px;
            margin: 0 auto;
            padding: 2rem 1.6rem 1.6rem;
            border-radius: 1.15rem;
            background: linear-gradient(160deg, rgba(42, 28, 18, 0.78), rgba(18, 12, 8, 0.82));
            border: 1.5px solid var(--glass-border);
            backdrop-filter: blur(18px);
            -webkit-backdrop-filter: blur(18px);
            box-shadow:
                0 0 0 1px rgba(255, 215, 128, 0.06),
                0 28px 70px rgba(0, 0, 0, 0.45),
                inset 0 1px 0 rgba(255, 220, 150, 0.12);
            animation: rise 0.75s ease-out 0.08s both;
        }

        @media (min-width: 960px) {
            .login-card {
                max-width: none;
                padding: 2.4rem 2.35rem 1.85rem;
            }
        }

        .brand-logo {
            display: block;
            width: clamp(7.5rem, 34%, 10.5rem);
            max-width: 56%;
            height: auto;
            margin: 0 auto 0.85rem;
            border-radius: 0.55rem;
            box-shadow: 0 10px 28px rgba(0, 0, 0, 0.35);
        }

        .brand-name {
            margin: 0;
            text-align: center;
            font-family: "Cinzel", "Cormorant Garamond", Georgia, serif;
            font-size: clamp(1.05rem, 2vw, 1.25rem);
            font-weight: 700;
            letter-spacing: 0.14em;
            text-transform: uppercase;
            color: var(--gold-light);
        }

        .brand-divider {
            display: flex;
            align-items: center;
            gap: 0.65rem;
            margin: 1rem 0 1.35rem;
            color: var(--gold);
        }

        .brand-divider::before,
        .brand-divider::after {
            content: "";
            flex: 1;
            height: 1px;
            background: linear-gradient(90deg, transparent, rgba(212, 175, 55, 0.55), transparent);
        }

        .brand-divider span {
            font-size: 0.7rem;
            opacity: 0.9;
        }

        .login-copy {
            text-align: center;
            margin-bottom: 1.45rem;
        }

        .login-copy h2 {
            margin: 0;
            font-family: "Cormorant Garamond", Georgia, serif;
            font-size: clamp(2rem, 3.2vw, 2.55rem);
            font-weight: 700;
            letter-spacing: -0.01em;
            color: #fff;
        }

        .login-copy p {
            margin: 0.4rem 0 0;
            font-size: 0.92rem;
            color: var(--muted);
        }

        .login-alert {
            margin-bottom: 0.9rem;
            padding: 0.7rem 0.85rem;
            border-radius: 0.65rem;
            font-size: 0.85rem;
        }

        .login-alert-ok {
            background: rgba(16, 185, 129, 0.15);
            border: 1px solid rgba(52, 211, 153, 0.35);
            color: #6ee7b7;
        }

        .login-alert-err {
            background: rgba(244, 63, 94, 0.14);
            border: 1px solid rgba(251, 113, 133, 0.35);
            color: #fda4af;
        }

        .login-field {
            margin-bottom: 1rem;
        }

        .login-field > label {
            display: block;
            margin-bottom: 0.4rem;
            font-size: 0.72rem;
            font-weight: 700;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            color: var(--gold-light);
        }

        .login-input {
            position: relative;
            display: flex;
            align-items: center;
        }

        .field-icon {
            position: absolute;
            left: 0.9rem;
            width: 1.2rem;
            height: 1.2rem;
            color: var(--gold-light);
            pointer-events: none;
            z-index: 1;
        }

        .login-input input {
            width: 100%;
            border: 1.5px solid rgba(212, 175, 55, 0.4);
            background: rgba(10, 7, 5, 0.42);
            color: #fff;
            border-radius: 0.75rem;
            padding: 0.95rem 3.1rem 0.95rem 2.85rem;
            font-family: inherit;
            font-size: 0.98rem;
            outline: none;
            transition: border-color 0.2s ease, box-shadow 0.2s ease, background 0.2s ease;
        }

        .login-input input::placeholder {
            color: rgba(247, 243, 234, 0.42);
        }

        .login-input input:focus {
            border-color: var(--gold);
            background: rgba(10, 7, 5, 0.58);
            box-shadow: 0 0 0 3px rgba(212, 175, 55, 0.2);
        }

        .login-input:focus-within .field-icon {
            color: var(--gold);
        }

        .toggle-pass {
            position: absolute;
            right: 0.45rem;
            border: 0;
            background: rgba(212, 175, 55, 0.14);
            color: var(--gold-light);
            width: 2.35rem;
            height: 2.35rem;
            border-radius: 0.55rem;
            display: grid;
            place-items: center;
            cursor: pointer;
            padding: 0;
            transition: background 0.2s ease, color 0.2s ease, transform 0.15s ease;
        }

        .toggle-pass:hover {
            background: rgba(212, 175, 55, 0.28);
            color: #fff;
        }

        .toggle-pass:active {
            transform: scale(0.96);
        }

        .toggle-pass svg {
            width: 1.2rem;
            height: 1.2rem;
        }

        .toggle-pass .icon-eye-off { display: none; }
        .toggle-pass.is-visible .icon-eye { display: none; }
        .toggle-pass.is-visible .icon-eye-off { display: block; }

        .login-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 0.75rem;
            margin: 0.2rem 0 1.35rem;
            font-size: 0.88rem;
        }

        .login-row label {
            display: inline-flex;
            align-items: center;
            gap: 0.55rem;
            cursor: pointer;
            color: var(--muted);
            user-select: none;
        }

        .login-row input[type="checkbox"] {
            width: 1.05rem;
            height: 1.05rem;
            accent-color: var(--gold);
            cursor: pointer;
        }

        .forgot-link {
            color: var(--gold-light);
            text-decoration: none;
            font-weight: 700;
        }

        .forgot-link:hover {
            text-decoration: underline;
            color: #fff;
        }

        .login-submit {
            width: 100%;
            border: 0;
            border-radius: 0.8rem;
            padding: 1rem 1rem;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.55rem;
            font-family: inherit;
            font-size: 1.02rem;
            font-weight: 800;
            letter-spacing: 0.02em;
            color: #1a1208;
            background: linear-gradient(90deg, #f0d78c, var(--gold) 45%, var(--gold-deep));
            cursor: pointer;
            box-shadow: 0 12px 28px rgba(212, 175, 55, 0.28);
            transition: transform 0.18s ease, filter 0.18s ease, box-shadow 0.18s ease;
        }

        .login-submit svg {
            width: 1.15rem;
            height: 1.15rem;
        }

        .login-submit:hover {
            filter: brightness(1.06);
            transform: translateY(-1px);
            box-shadow: 0 16px 34px rgba(212, 175, 55, 0.4);
        }

        .login-submit:active { transform: translateY(0); }

        .secure-foot {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            margin-top: 1.25rem;
            color: var(--muted);
            font-size: 0.78rem;
        }

        .secure-foot::before,
        .secure-foot::after {
            content: "";
            flex: 1;
            height: 1px;
            background: linear-gradient(90deg, transparent, rgba(212, 175, 55, 0.35), transparent);
        }

        .secure-foot span {
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            white-space: nowrap;
        }

        .secure-foot svg {
            width: 0.95rem;
            height: 0.95rem;
            color: var(--gold);
        }

        .powered-by {
            position: relative;
            z-index: 2;
            margin-top: 1.5rem;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            flex-wrap: nowrap;
            white-space: nowrap;
            gap: 0.4rem;
            font-size: 0.85rem;
            color: rgba(247, 243, 234, 0.8);
        }

        .powered-by img {
            width: 2.4rem;
            height: auto;
            flex-shrink: 0;
            border-radius: 0.25rem;
        }

        .powered-by strong {
            color: #9ec8ff;
            font-weight: 700;
            white-space: nowrap;
        }

        @keyframes rise {
            from { opacity: 0; transform: translateY(16px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes bg-drift {
            from { transform: scale(1.02) translate3d(0, 0, 0); }
            to { transform: scale(1.06) translate3d(-1%, -0.8%, 0); }
        }

        @media (max-width: 959px) {
            .video-card {
                max-height: 42vh;
                aspect-ratio: 16 / 10;
            }
        }
    </style>
</head>
<body>
<div class="login-page">
    <div class="login-bg" aria-hidden="true"></div>

    <div class="login-layout">
        <aside class="video-card" aria-label="Brand film">
            <video autoplay muted loop playsinline preload="auto">
                <source
                    src="https://res.cloudinary.com/dwnnakrrh/video/upload/q_auto:best,w_1080,c_limit,f_mp4/v1795154241/gemini_generated_video_5403b677_zmeoqf.mp4"
                    type="video/mp4"
                >
            </video>
            <div class="video-watermark" aria-hidden="true">
                <img
                    src="{{ asset('logo.jpeg') }}"
                    alt="RoyalTech Innovation"
                    loading="eager"
                    decoding="async"
                >
            </div>
        </aside>

        <section class="login-card" aria-label="Sign in">
            <img
                class="brand-logo"
                src="{{ asset('logo.jpeg') }}"
                alt="RoyalTech Innovation"
                loading="eager"
                decoding="async"
            >
            <h1 class="brand-name">{{ strtoupper($businessName ?? 'JewelERP') }}</h1>
            <div class="brand-divider" aria-hidden="true"><span>◆</span></div>

            <div class="login-copy">
                <h2>Welcome Back</h2>
                <p>Sign in to manage your jewellery business</p>
            </div>

            @if(session('status'))
                <div class="login-alert login-alert-ok">{{ session('status') }}</div>
            @endif

            @if($errors->any())
                <div class="login-alert login-alert-err">{{ $errors->first() }}</div>
            @endif

            <form action="{{ route('login.post') }}" method="POST" autocomplete="on">
                @csrf

                <div class="login-field">
                    <label for="email">Email Address</label>
                    <div class="login-input">
                        <svg class="field-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                            <rect x="3" y="5" width="18" height="14" rx="2"/>
                            <path d="M3 7l9 6 9-6"/>
                        </svg>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" placeholder="admin@jewelerp.in">
                    </div>
                </div>

                <div class="login-field">
                    <label for="password">Password</label>
                    <div class="login-input">
                        <svg class="field-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                            <rect x="5" y="11" width="14" height="10" rx="2"/>
                            <path d="M8 11V8a4 4 0 0 1 8 0v3"/>
                        </svg>
                        <input id="password" type="password" name="password" required autocomplete="current-password" placeholder="Enter your password">
                        <button type="button" class="toggle-pass" id="togglePassword" aria-label="Show password" title="Show password">
                            <svg class="icon-eye" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                                <path d="M2 12s3.5-7 10-7 10 7 10 7-3.5 7-10 7S2 12 2 12z"/>
                                <circle cx="12" cy="12" r="3"/>
                            </svg>
                            <svg class="icon-eye-off" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                                <path d="M3 3l18 18"/>
                                <path d="M10.6 10.6a2.5 2.5 0 0 0 3 3"/>
                                <path d="M9.9 5.1A10.5 10.5 0 0 1 12 5c5.2 0 9.5 3.4 11 7.5a12 12 0 0 1-4.1 5"/>
                                <path d="M6.1 6.1A12 12 0 0 0 1 12.5a11.8 11.8 0 0 0 5.1 5.3"/>
                                <path d="M14.1 9.1A3 3 0 0 0 12 8.5"/>
                            </svg>
                        </button>
                    </div>
                </div>

                <div class="login-row">
                    <label>
                        <input type="checkbox" name="remember" value="1">
                        <span>Remember me</span>
                    </label>
                    <a class="forgot-link" href="#">Forgot Password?</a>
                </div>

                <button type="submit" class="login-submit">
                    <span>Sign In</span>
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" aria-hidden="true">
                        <path d="M5 12h14"/>
                        <path d="M13 6l6 6-6 6"/>
                    </svg>
                </button>
            </form>

            <div class="secure-foot">
                <span>
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                        <path d="M12 3l8 3v5c0 5-3.5 8.5-8 10-4.5-1.5-8-5-8-10V6l8-3z"/>
                        <path d="M9 12l2 2 4-4"/>
                    </svg>
                    Secure business access
                </span>
            </div>
        </section>
    </div>

    <p class="powered-by">
        Powered by
        <img src="{{ asset('logo.jpeg') }}" alt="RoyalTech Innovation" loading="lazy" decoding="async">
        <strong>RoyalTech Innovation</strong>
    </p>
</div>

<script>
    (function () {
        const input = document.getElementById('password');
        const btn = document.getElementById('togglePassword');
        if (!input || !btn) return;

        btn.addEventListener('click', function () {
            const show = input.type === 'password';
            input.type = show ? 'text' : 'password';
            btn.classList.toggle('is-visible', show);
            btn.setAttribute('aria-label', show ? 'Hide password' : 'Show password');
            btn.setAttribute('title', show ? 'Hide password' : 'Show password');
            input.focus();
        });
    })();
</script>
</body>
</html>
