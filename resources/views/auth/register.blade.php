@extends('layouts.audio')

@section('title', 'Create Account | Abu-Abu Audio')
@section('description', 'Create an Abu-Abu account to save albums to your wishlist.')

@section('content')
    <main class="min-h-screen flex items-center justify-center bg-[radial-gradient(circle_at_top,rgba(108,92,231,0.06),transparent_18%),linear-gradient(180deg,#2c3138_0%,#32363d_26%,#2d3138_100%)]">
        <div class="w-full max-w-md px-4 py-8">
            <a href="{{ route('audio.index') }}" class="block text-center mb-8">
                <span class="font-display text-3xl font-bold text-white">Abu-Abu</span>
                <div class="text-sm text-white/50">Audio</div>
            </a>

            <div class="rounded-[32px] border border-white/6 bg-[#20252c] p-8 shadow-[0_24px_80px_rgba(0,0,0,0.16)]">
                <h1 class="text-2xl font-bold text-white text-center mb-2">Create account</h1>
                <p class="text-white/50 text-center mb-8">Save albums to your wishlist</p>

                @if($errors->any())
                    <div class="mb-6 rounded-2xl border border-red-500/20 bg-red-500/10 px-4 py-3 text-sm text-red-400">
                        @foreach($errors->all() as $error)
                            <div>{{ $error }}</div>
                        @endforeach
                    </div>
                @endif

                <form method="POST" action="{{ route('auth.register.post') }}" class="space-y-5">
                    @csrf
                    
                    <div>
                        <label for="name" class="block text-xs font-semibold uppercase tracking-[0.24em] text-white/50 mb-2">Name</label>
                        <input 
                            type="text" 
                            name="name" 
                            id="name"
                            required
                            autofocus
                            class="w-full rounded-2xl border border-white/8 bg-[#1c2128] px-4 py-3.5 text-white placeholder:text-white/30 focus:border-[#3d9ae9]/70 focus:outline-none"
                            placeholder="Your name"
                        >
                    </div>

                    <div>
                        <label for="email" class="block text-xs font-semibold uppercase tracking-[0.24em] text-white/50 mb-2">Email</label>
                        <input 
                            type="email" 
                            name="email" 
                            id="email"
                            required
                            class="w-full rounded-2xl border border-white/8 bg-[#1c2128] px-4 py-3.5 text-white placeholder:text-white/30 focus:border-[#3d9ae9]/70 focus:outline-none"
                            placeholder="you@example.com"
                        >
                    </div>

                    <div>
                        <label for="password" class="block text-xs font-semibold uppercase tracking-[0.24em] text-white/50 mb-2">Password</label>
                        <input 
                            type="password" 
                            name="password" 
                            id="password"
                            required
                            minlength="8"
                            class="w-full rounded-2xl border border-white/8 bg-[#1c2128] px-4 py-3.5 text-white placeholder:text-white/30 focus:border-[#3d9ae9]/70 focus:outline-none"
                            placeholder="Min. 8 characters"
                        >
                    </div>

                    <div>
                        <label for="password_confirmation" class="block text-xs font-semibold uppercase tracking-[0.24em] text-white/50 mb-2">Confirm password</label>
                        <input 
                            type="password" 
                            name="password_confirmation" 
                            id="password_confirmation"
                            required
                            class="w-full rounded-2xl border border-white/8 bg-[#1c2128] px-4 py-3.5 text-white placeholder:text-white/30 focus:border-[#3d9ae9]/70 focus:outline-none"
                            placeholder="Confirm password"
                        >
                    </div>

                    <button type="submit" class="w-full rounded-2xl bg-[#3d9ae9] py-3.5 text-base font-semibold text-white transition hover:bg-[#52a8f0]">
                        Create account
                    </button>
                </form>

                <div class="mt-8 text-center text-white/50">
                    Already have an account? 
                    <a href="{{ route('auth.login') }}" class="text-[#9bd0ff] hover:underline">Sign in</a>
                </div>
            </div>

            <a href="{{ route('audio.index') }}" class="block mt-8 text-center text-sm text-white/40 hover:text-white">
                ← Back to audio catalog
            </a>
        </div>
    </main>
@endsection