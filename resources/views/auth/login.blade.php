@extends('layouts.app')

@section('content')
<!-- Main Background & Layout -->
<div class="min-h-screen flex items-center justify-center bg-gradient-to-t from-[#F8F9FF] to-[#FFFFFF] py-[100px]">
    
    <!-- Login Card -->
    <div class="relative w-[448px] bg-white border border-[#BBCABF] shadow-[0px_10px_15px_-3px_rgba(0,0,0,0.1)] rounded-[12px] p-[32px] flex flex-col gap-[32px] z-10 overflow-hidden">
        
        <!-- Subtle fruit-inspired decorative blur -->
        <div class="absolute w-[128px] h-[128px] -right-[63px] -top-[63px] bg-[#10B981] opacity-20 blur-[20px] rounded-full z-0"></div>

        <!-- Header Section -->
        <div class="relative z-10 w-full flex flex-col items-center gap-[4px]">
            <!-- Icon Background -->
            <div class="flex justify-center items-center py-[12px] w-[64px] h-[52px] bg-[#EFF4FF] rounded-full mb-1">
                <svg class="w-[21px] h-[28px] text-[#006C49]" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 3L2 8l10 5 10-5-10-5zm0 18l-10-5v-6l10 5 10-5v6l-10 5z"/>
                </svg>
            </div>

            <!-- Title & Subtitle -->
            <div class="flex flex-col items-center pt-[12px] w-full">
                <h1 class="font-inter font-bold text-[32px] leading-[40px] text-[#006C49] tracking-[-0.8px]">
                    FruitStock
                </h1>
            </div>
            <div class="flex flex-col items-center pt-[4px] w-full">
                <h2 class="font-inter font-semibold text-[20px] leading-[28px] text-[#3C4A42]">
                    Welcome Back!
                </h2>
            </div>
            <div class="flex flex-col items-center w-full">
                <p class="font-inter font-normal text-[14px] leading-[20px] text-[#3C4A42]">
                    Masuk ke sistem manajemen
                </p>
            </div>
        </div>

        <!-- Alert Error -->
        @if($errors->any())
            <div class="relative z-10 bg-red-50 border border-red-200 text-red-600 text-sm p-3 rounded-lg w-full font-inter">
                {{ $errors->first() }}
            </div>
        @endif

        <!-- Form Section -->
        <form action="{{ route('login') }}" method="POST" class="relative z-10 flex flex-col items-start gap-[24px] w-full">
            @csrf
            
            <!-- Email Field -->
            <div class="flex flex-col items-start gap-[8px] w-full">
                <label for="email" class="font-jetbrains font-medium text-[12px] leading-[16px] tracking-[0.6px] text-[#3C4A42]">
                    EMAIL ALAMAT
                </label>
                <div class="relative w-full h-[46px]">
                    <div class="absolute left-[12px] top-0 bottom-0 flex items-center">
                        <svg class="w-[16px] h-[16px] text-[#BBCABF]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                    </div>
                    <input type="email" name="email" id="email" placeholder="Masukkan alamat email" required
                        class="w-full h-full bg-[#FFFFFF] border border-[#BBCABF] rounded-[8px] py-[13px] pr-[12px] pl-[40px] font-inter font-normal text-[14px] leading-[17px] text-[#6C7A71] focus:outline-none focus:border-[#006C49] focus:ring-1 focus:ring-[#006C49]">
                </div>
            </div>

            <!-- Password Field -->
            <div class="flex flex-col items-start gap-[8px] w-full">
                <div class="flex flex-row justify-between w-full h-[16px]">
                    <label for="password" class="font-jetbrains font-medium text-[12px] leading-[16px] tracking-[0.6px] text-[#3C4A42]">
                        PASSWORD
                    </label>
                </div>
                <div class="relative w-full h-[46px]">
                    <div class="absolute left-[12px] top-0 bottom-0 flex items-center">
                        <svg class="w-[16px] h-[16px] text-[#BBCABF]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                        </svg>
                    </div>
                    <input type="password" name="password" id="password" placeholder="••••••••" required
                        class="w-full h-full bg-[#FFFFFF] border border-[#BBCABF] rounded-[8px] py-[13px] pr-[40px] pl-[40px] font-inter font-normal text-[14px] leading-[17px] text-[#6C7A71] focus:outline-none focus:border-[#006C49] focus:ring-1 focus:ring-[#006C49]">
                </div>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="flex flex-row justify-center items-center px-[16px] py-[12px] w-full h-[54px] bg-[#006C49] hover:bg-[#00573A] shadow-[0px_1px_2px_rgba(0,0,0,0.05)] rounded-[8px] transition-colors">
                <span class="font-inter font-semibold text-[20px] leading-[28px] text-[#FFFFFF]">
                    Masuk
                </span>
            </button>
        </form>

        <!-- Akun Demo Info Section -->
        <div class="relative z-10 w-full pt-[24px] mt-[-8px] border-t border-[#BBCABF]/40 flex flex-col gap-[12px]">
            <h3 class="font-jetbrains font-medium text-[10px] leading-[16px] text-[#3C4A42] tracking-[0.6px] uppercase opacity-70">
                Akun Demo Tersedia (PW: password123)
            </h3>
            <div class="flex flex-col gap-[6px]">
                <div class="flex justify-between items-center bg-[#F8F9FF] border border-[#BBCABF]/30 px-[12px] py-[8px] rounded-[6px]">
                    <span class="font-jetbrains text-[11px] font-bold text-[#006C49]">Admin</span>
                    <span class="font-inter text-[12px] text-[#6C7A71]">admin@fruitstock.com</span>
                </div>
                <div class="flex justify-between items-center bg-[#F8F9FF] border border-[#BBCABF]/30 px-[12px] py-[8px] rounded-[6px]">
                    <span class="font-jetbrains text-[11px] font-bold text-[#006C49]">Gudang</span>
                    <span class="font-inter text-[12px] text-[#6C7A71]">gudang@fruitstock.com</span>
                </div>
                <div class="flex justify-between items-center bg-[#F8F9FF] border border-[#BBCABF]/30 px-[12px] py-[8px] rounded-[6px]">
                    <span class="font-jetbrains text-[11px] font-bold text-[#006C49]">Kasir</span>
                    <span class="font-inter text-[12px] text-[#6C7A71]">kasir@fruitstock.com</span>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <div class="relative z-10 w-full flex flex-col items-center mt-[-8px]">
            <p class="font-jetbrains font-medium text-[12px] leading-[16px] text-[#3C4A42] tracking-[0.6px] opacity-60">
                © 2026 FruitStock v1.0.0
            </p>
        </div>

    </div>
</div>
@endsection