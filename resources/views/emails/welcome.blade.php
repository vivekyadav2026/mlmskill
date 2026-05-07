<x-mail::message>
# Welcome to Samarth Digital, {{ $user->name }}!

We're thrilled to have you on board. Your account has been created successfully. 

Currently, your account is in **pending approval/inactive** status. Once you activate your account by purchasing a package or contacting the administrator, you will have full access to our dashboard and features.

Your Referral Code is: **{{ $user->referral_code }}**

<x-mail::button :url="route('login')">
Login to your account
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
