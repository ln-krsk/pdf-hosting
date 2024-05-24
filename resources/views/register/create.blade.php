<x-layout>
    <x-modal heading="Registriere dich!">
        <form method="POST" action="{{ route('register.store') }}" class="w-full">
            @csrf
            <div class="w-full px-3 mb-1.5">
                <label class="block uppercase tracking-wide text-xs font-semibold"
                       for="email">
                    Email *
                </label>
                <input
                    class="block w-full border rounded py-1 px-2 mb-1.5  focus:outline-none focus:bg-white"
                    id="email" name="email" type="text" value="{{old('email')}}">
                @error('email')
                <p class="text-pink text-xs italic">{{ $message }}</p>
                @enderror
            </div>
            <div class="w-full px-3 mb-1.5">
                <label class="block uppercase tracking-wide text-xs font-semibold mt-3"
                       for="password">
                    Passwort *
                </label>
                <input
                    class="block w-full bg-gray-200 text-gray-700 border border-red-500 rounded py-1 px-2 mb-1.5  focus:outline-none focus:bg-white"
                    id="password" name="password" type="password" value=""
                    placeholder="">
            </div>
            <div class="w-full px-3 mb-1.5">
                <label class="block uppercase tracking-wide text-xs font-semibold"
                       for="password_confirmation">
                    Passwort wiederholen *
                </label>
                <input
                    class="block w-full bg-gray-200 text-gray-700 border border-red-500 rounded py-1 px-2 mb-1.5  focus:outline-none focus:bg-white"
                    id="password_confirmation" name="password_confirmation" type="password" value=""
                    placeholder="">

                <div class="flex-row flex justify-between">
                    @error('password')
                    <div class="text-pink text-xs italic">{{ $message }}</div>
                    @enderror
                    @error('Registrieren')
                    <div class="text-pink text-xs italic">{{ $message }}</div>
                    @enderror
                    <div class="text-xs">* Pflichtfelder</div>
                </div>
            </div>
            <div class="w-full flex justify-center px-3 my-3 mt-6 mb-5">
                <x-form-submit-button id="" value="Registrieren"></x-form-submit-button>
            </div>
            <span class="inline flex justify-center text-sm mb-2">Du hast schon einen Account?
                <a href="{{ route('login') }}"
                   class="ml-1 text-sm text-thiel hover:text-thiel--end">Log dich hier ein!</a></span>
        </form>
    </x-modal>
</x-layout>
