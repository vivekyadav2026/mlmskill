@extends('layouts.user')

@section('content')
<script src="https://cdn.tailwindcss.com"></script>
<style>
  .app-main { padding: 20px; }
</style>
<div class="tailwind-scope mt-4 max-w-3xl mx-auto">
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-gray-100">Send Email Invites</h2>
        <p class="text-gray-400">Invite your friends and network by sending them a direct email with your referral link.</p>
    </div>

    <div class="bg-[#1a222d] rounded-lg shadow-lg overflow-hidden border border-[#334155]">
        <div class="p-8">
            <form onsubmit="event.preventDefault(); alert('Invites sent successfully! (Demo mode)'); this.reset();">
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-300 mb-2">Email Addresses (Comma separated)</label>
                    <textarea rows="3" required placeholder="friend1@example.com, friend2@example.com" class="w-full bg-[#0b1220] border border-[#334155] rounded-md shadow-sm py-2 px-3 text-gray-100 focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500"></textarea>
                </div>

                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-300 mb-2">Personal Message (Optional)</label>
                    <textarea rows="4" class="w-full bg-[#0b1220] border border-[#334155] rounded-md shadow-sm py-2 px-3 text-gray-100 focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500">I found this amazing platform for skill development and networking. Use my link to join!</textarea>
                </div>

                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-300 mb-2">Your Link Included in Email</label>
                    <div class="bg-[#111827] border border-[#334155] rounded-md py-2 px-3 text-indigo-400 font-mono text-sm">
                        {{ $referralLink }}
                    </div>
                </div>

                <div class="border-t border-[#334155] pt-6 flex justify-end">
                    <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-2 px-6 rounded-md shadow focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 focus:ring-offset-[#1a222d] transition-colors">
                        <i class="fa-solid fa-paper-plane mr-2"></i> Send Invites
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
