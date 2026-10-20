
<x-guest-layout>
    <header class="cv-brand">
        <div class="cv-logo">
            <div class="cv-logo-mark">
                <svg viewBox="0 0 32 32" fill="none"
                     xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                    <path d="M5 6.5C5 5.12 6.12 4 7.5 4h17C25.88 4 27 5.12 27 6.5v14c0 1.38-1.12 2.5-2.5 2.5H15l-7 5v-5h-.5C6.12 23 5 21.88 5 20.5v-14Z"
                          stroke="currentColor" stroke-width="2"
                          stroke-linejoin="round"/>
                    <path d="M10 10h12M10 14.5h9"
                          stroke="currentColor" stroke-width="2"
                          stroke-linecap="round"/>
                </svg>
            </div>

            <div class="cv-logo-name">CampusVoice</div>
        </div>

        <p class="cv-tagline">
            Platform Pengaduan dan Aspirasi Mahasiswa
        </p>
    </header>

    <section class="cv-card">
        <h1 class="cv-heading">Masuk</h1>
        <p class="cv-subheading">Masuk ke akun CampusVoice Anda</p>

        @if (session('status'))
            <div class="cv-error-box"
                 role="status"
                 style="color:#247544;background:#f0fff5;border-color:#b8e7c8;">
                {{ session('status') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="cv-error-box" role="alert">
                @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="cv-field">
                <label class="cv-label" for="email">EMAIL</label>

                <div class="cv-input-wrap">
                    <svg class="cv-input-icon"
                         viewBox="0 0 24 24"
                         fill="none"
                         stroke="currentColor"
                         stroke-width="1.7"
                         aria-hidden="true">
                        <rect x="3" y="5" width="18" height="14" rx="2"/>
                        <path d="m4 7 8 6 8-6"/>
                    </svg>

                    <input
                        class="cv-input"
                        id="email"
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        placeholder="Masukkan email Anda"
                        required
                        autofocus
                        autocomplete="username"
                    >
                </div>

                <p class="cv-hint">
                    Gunakan email berdomain kampus resmi (@student.univ.ac.id)
                </p>

                @error('email')
                    <p class="cv-error">{{ $message }}</p>
                @enderror
            </div>

            <div class="cv-field">
                <label class="cv-label" for="password">PASSWORD</label>

                <div class="cv-input-wrap">
                    <svg class="cv-input-icon"
                         viewBox="0 0 24 24"
                         fill="none"
                         stroke="currentColor"
                         stroke-width="1.7"
                         aria-hidden="true">
                        <rect x="4" y="10" width="16" height="11" rx="2"/>
                        <path d="M8 10V7a4 4 0 0 1 8 0v3"/>
                    </svg>

                    <input
                        class="cv-input"
                        id="password"
                        type="password"
                        name="password"
                        placeholder="Masukkan password Anda"
                        required
                        autocomplete="current-password"
                    >

                    <button
                        class="cv-password-toggle"
                        type="button"
                        id="togglePassword"
                        aria-label="Tampilkan password"
                    >
                        <svg id="eyeIcon"
                             viewBox="0 0 24 24"
                             fill="none"
                             stroke="currentColor"
                             stroke-width="1.7"
                             aria-hidden="true">
                            <path d="M2 12s3.5-7 10-7 10 7 10 7-3.5 7-10 7-10-7-10-7Z"/>
                            <circle cx="12" cy="12" r="3"/>
                        </svg>
                    </button>
                </div>

                @error('password')
                    <p class="cv-error">{{ $message }}</p>
                @enderror
            </div>

            <div class="cv-options">
                <label class="cv-remember" for="remember">
                    <input
                        id="remember"
                        type="checkbox"
                        name="remember"
                        value="1"
                        {{ old('remember') ? 'checked' : '' }}
                    >
                    <span>Ingat saya</span>
                </label>

                @if (Route::has('password.request'))
                    <a class="cv-link"
                       href="{{ route('password.request') }}">
                        Lupa password?
                    </a>
                @endif
            </div>

            <button class="cv-submit" type="submit">
                <span>MASUK</span>

                <svg viewBox="0 0 24 24"
                     fill="none"
                     stroke="currentColor"
                     stroke-width="2"
                     aria-hidden="true">
                    <path d="M5 12h14M13 5l7 7-7 7"/>
                </svg>
            </button>
        </form>

        <div class="cv-divider"></div>

        <p class="cv-register">
            Belum punya akun?

            @if (Route::has('register'))
                <a class="cv-link" href="{{ route('register') }}">
                    Daftar sekarang
                </a>
            @else
                <span>Pendaftaran belum tersedia.</span>
            @endif
        </p>

        <div class="cv-role">
            <div class="cv-role-inner">
                <svg viewBox="0 0 24 24"
                     fill="none"
                     stroke="currentColor"
                     stroke-width="1.7"
                     aria-hidden="true">
                    <path d="m3 9 9-5 9 5-9 5-9-5Z"/>
                    <path d="M7 11.2V16c3.3 2.6 6.7 2.6 10 0v-4.8M21 9v6"/>
                </svg>
            </div>
        </div>
    </section>

    <footer class="cv-footer">
        Gunakan akun CampusVoice Anda untuk membuat dan memantau pengaduan atau<br>
        aspirasi kepada pihak kampus.
    </footer>

    <script>
        const togglePassword = document.getElementById('togglePassword');
        const passwordInput = document.getElementById('password');

        togglePassword?.addEventListener('click', function () {
            const showPassword = passwordInput.type === 'password';

            passwordInput.type = showPassword ? 'text' : 'password';

            this.setAttribute(
                'aria-label',
                showPassword ? 'Sembunyikan password' : 'Tampilkan password'
            );

            this.innerHTML = showPassword
                ? `<svg viewBox="0 0 24 24" fill="none"
                     stroke="currentColor" stroke-width="1.7"
                     aria-hidden="true">
                     <path d="M3 3l18 18"/>
                     <path d="M10.6 10.6a2 2 0 0 0 2.8 2.8"/>
                     <path d="M9.9 5.2A10.9 10.9 0 0 1 12 5c6.5 0 10 7 10 7a16 16 0 0 1-3.1 3.8"/>
                     <path d="M6.2 6.2C3.5 8 2 12 2 12s3.5 7 10 7c1.1 0 2.1-.2 3-.5"/>
                   </svg>`
                : `<svg viewBox="0 0 24 24" fill="none"
                     stroke="currentColor" stroke-width="1.7"
                     aria-hidden="true">
                     <path d="M2 12s3.5-7 10-7 10 7 10 7-3.5 7-10 7-10-7-10-7Z"/>
                     <circle cx="12" cy="12" r="3"/>
                   </svg>`;
        });
    </script>
</x-guest-layout>
