@php
  $showNavbar = false; // Atur false jika tidak ingin navbar tampil
  $showFooter = false; // Atur false jika tidak ingin footer tampil
@endphp

@extends('layouts.app')

@section('title', 'Masuk Akun - SMAN 1 Pare')

@section('content')
    <div class="min-h-[calc(100vh-80px)] flex items-center justify-center py-12 px-gutter-mobile lg:px-gutter bg-surface">
        <div class="max-w-md w-full bg-surface-container-lowest rounded-2xl p-space-xl shadow-lg flex flex-col gap-space-lg">

            <!-- Header Brand -->
            <div class="flex flex-col items-center text-center gap-space-xs">
                <div class="w-12 h-12 rounded-xl bg-primary flex items-center justify-center text-on-primary shadow-sm mb-2">
                    <span class="material-symbols-outlined text-[28px]">school</span>
                </div>
                <h1 class="font-headline-md text-headline-md text-on-surface tracking-tight">Masuk Portal SMANSA</h1>
                <p class="font-body-sm text-body-sm text-on-surface-variant">
                    Silakan masukkan email dan kata sandi akun civitas akademika Anda.
                </p>
            </div>

            <!-- Session Status / Error Messages -->
            @if ($errors->any())
                <div class="p-3 rounded-lg bg-error-container text-on-error-container font-label-sm text-label-sm">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Form Login -->
            <form action="{{ route('login.submit') }}" method="POST" class="flex flex-col gap-space-md">
                @csrf

                <div class="flex flex-col gap-1">
                    <label for="email" class="font-label-md text-label-md text-on-surface">Alamat Email</label>
                    <div
                        class="flex items-center gap-space-sm px-space-md py-2.5 bg-surface-container-low rounded-lg border border-outline-variant/40 focus-within:border-primary">
                        <span class="material-symbols-outlined text-[20px] text-on-surface-variant">mail</span>
                        <input id="email" name="email" type="email" value="{{ old('email') }}" required
                            autocomplete="email" autofocus placeholder="nama@sman1pare.sch.id"
                            class="w-full bg-transparent font-body-md text-body-md text-on-surface placeholder:text-outline focus:outline-none" />
                    </div>
                </div>

                <div class="flex flex-col gap-1">
                    <div class="flex items-center justify-between">
                        <label for="password" class="font-label-md text-label-md text-on-surface">Kata Sandi</label>
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}"
                                class="font-label-sm text-label-sm text-secondary hover:underline">Lupa sandi?</a>
                        @endif
                    </div>
                    <div
                        class="flex items-center gap-space-sm px-space-md py-2.5 bg-surface-container-low rounded-lg border border-outline-variant/40 focus-within:border-primary">
                        <span class="material-symbols-outlined text-[20px] text-on-surface-variant">lock</span>
                        <input id="password" name="password" type="password" required autocomplete="current-password"
                            placeholder="••••••••"
                            class="w-full bg-transparent font-body-md text-body-md text-on-surface placeholder:text-outline focus:outline-none" />
                    </div>
                </div>

                <div class="flex items-center justify-between">
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" name="remember"
                            class="w-4 h-4 rounded text-primary focus:ring-primary border-outline-variant" />
                        <span class="font-label-sm text-label-sm text-on-surface-variant">Ingat saya</span>
                    </label>
                </div>

                <button type="submit"
                    class="w-full py-3 px-4 rounded-xl bg-primary text-on-primary font-label-md text-label-md font-semibold hover:bg-surface-container-highest hover:text-on-surface transition-colors cursor-pointer shadow-sm flex items-center justify-center gap-2">
                    <span>Masuk ke Akun</span>
                    <span class="material-symbols-outlined text-[18px]">arrow_forward</span>
                </button>
            </form>

            <!-- Footer Kembali ke Beranda -->
            <div class="text-center pt-2 border-t border-outline-variant/30">
                <a href="{{ route('home') }}"
                    class="font-label-md text-label-md text-secondary hover:underline flex items-center justify-center gap-1">
                    <span class="material-symbols-outlined text-[16px]">arrow_back</span>
                    <span>Kembali ke Beranda SMAN 1 Pare</span>
                </a>
            </div>

        </div>
    </div>
@endsection
