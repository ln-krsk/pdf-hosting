<x-layout>
    <x-modal heading="Logge dich ein!">
        <form method="POST" action="{{ route('sessions') }}" class="w-full">
            @csrf
            <div class="w-full px-3 mb-1.5">
                <label class="block uppercase tracking-wide text-xs font-semibold"
                       for="email">
                    Email
                </label>
                <input
                    class="block w-full border rounded py-1 px-2 mb-1.5 max-w-lg focus:outline-none focus:bg-white"
                    id="email" name="email" type="text" value="{{old('email')}}">
                @error('email')
                <p class="text-pink text-xs italic">{{ $message }}</p>
                @enderror
            </div>
            <div class="w-full px-3 mb-1">
                <label class="block uppercase tracking-wide text-xs font-semibold mt-3"
                       for="password">
                    Passwort
                </label>
                <input
                    class="block w-full bg-gray-200 text-gray-700 border border-red-500 rounded py-1 px-2 mb-1.5  focus:outline-none focus:bg-white"
                    id="password" name="password" type="password" value=""
                    placeholder="">
                @error('password')
                <p class="text-pink text-xs italic">{{ $message }}</p>
                @enderror
                @error('Login')
                <p class="text-pink text-xs italic">{{ $message }}</p>
                @enderror

                <div class="w-full flex justify-center px-3 mt-6 mb-4">
                    <x-form-submit-button id="" value="Login"></x-form-submit-button>
                </div>
                <a href="{{ route('password.request') }}"
                   class="w-full flex justify-center text-lg text-thiel font-semibold hover:text-thiel--end mb-1">Passwort
                    vergessen?</a>
                <span class="inline flex justify-center text-sm mb-2">Keinen Account?
                <a href="{{ route('register.create') }}"
                   class="ml-1 text-sm text-thiel hover:text-thiel--end">Registriere
                    dich hier!</a></span>
            </div>
        </form>
    </x-modal>
</x-layout>
