@extends('layouts.user')

@section('content')
<script src="https://cdn.tailwindcss.com"></script>
<style>
  .app-main { padding: 20px; }
</style>
<div class="tailwind-scope mt-4 max-w-4xl mx-auto">
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-gray-100">My Referral Link</h2>
        <p class="text-gray-400">Share this link to grow your network and earn commissions.</p>
    </div>

    <div class="bg-[#1a222d] rounded-lg shadow-lg overflow-hidden border border-[#334155] p-8 text-center">
        <div class="mb-6">
            <div class="inline-flex items-center justify-center w-20 h-20 rounded-full bg-indigo-500/20 text-indigo-400 mb-4">
                <i class="fa-solid fa-link text-3xl"></i>
            </div>
            <h3 class="text-xl font-bold text-gray-200">Your Unique Referral Code: <span class="text-indigo-400 font-mono">{{ $user->referral_code }}</span></h3>
        </div>

        <div class="max-w-2xl mx-auto bg-[#0b1220] p-4 rounded-lg border border-[#334155] flex flex-col md:flex-row items-center shadow-inner mb-8 gap-4">
            <input type="text" id="refLink" readonly value="{{ $referralLink }}" class="w-full bg-transparent border-none text-gray-300 font-mono text-sm focus:outline-none text-center md:text-left text-ellipsis overflow-hidden">
            <button onclick="copyLink()" class="w-full md:w-auto bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-2 rounded shadow transition whitespace-nowrap">
                <i class="fa-solid fa-copy mr-2"></i> Copy Link
            </button>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 border-t border-[#334155] pt-8">
            <a href="https://wa.me/?text=Join me on samarth.digital! {{ $referralLink }}" target="_blank" class="flex items-center justify-center p-3 rounded-lg bg-[#25D366]/10 text-[#25D366] border border-[#25D366]/30 hover:bg-[#25D366]/20 transition">
                <i class="fa-brands fa-whatsapp text-2xl mr-2"></i> Share on WhatsApp
            </a>
            <a href="https://www.facebook.com/sharer/sharer.php?u={{ $referralLink }}" target="_blank" class="flex items-center justify-center p-3 rounded-lg bg-[#1877F2]/10 text-[#1877F2] border border-[#1877F2]/30 hover:bg-[#1877F2]/20 transition">
                <i class="fa-brands fa-facebook text-2xl mr-2"></i> Share on Facebook
            </a>
            <a href="https://twitter.com/intent/tweet?text=Join me on samarth.digital!&url={{ $referralLink }}" target="_blank" class="flex items-center justify-center p-3 rounded-lg bg-[#1DA1F2]/10 text-[#1DA1F2] border border-[#1DA1F2]/30 hover:bg-[#1DA1F2]/20 transition">
                <i class="fa-brands fa-twitter text-2xl mr-2"></i> Share on Twitter
            </a>
        </div>
    </div>
</div>

<script>
function copyLink() {
    var copyText = document.getElementById("refLink");
    copyText.select();
    copyText.setSelectionRange(0, 99999);
    navigator.clipboard.writeText(copyText.value);
    alert("Copied the referral link: " + copyText.value);
}
</script>
@endsection
