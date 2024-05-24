@if (session()->has('success'))
<div x-data="{show: true}"
     x-init="setTimeout(() => show = false, 6000)"
     x-show="show"
     class="fixed left-1/2 -translate-x-1/2 text-thiel--end bg-greylight text-xl py-1 px-3 mt-2 rounded-2xl drop-shadow-lg">
    <p>{{ session('success') }}</p>
</div>
@endif
