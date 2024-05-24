<x-layout>
    <x-modal heading="Passwort ändern">
        <form method="POST" action="{{ route('password.update') }}" class="p-2">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">
            <div class="w-full px-3 mb-1.5">
                <label class="block uppercase tracking-wide text-xs font-bold"
                       for="email">
                    Email *
                </label>
                {{--todo: email aus Token (?) auslesen und anzeigen--}}
                <input
                    class="block w-full border rounded py-1 px-2 mb-1  focus:outline-none focus:bg-white"
                    id="email" name="email" type="text" value="{{ old('email')}}">
                @error('email')
                <p class="text-pink text-xs italic">{{ $message }}</p>
                @enderror
            </div>
            <div class="w-full px-3 mb-1.5">
                <label class="block uppercase tracking-wide text-xs font-bold mt-3"
                       for="password">
                    neues Passwort *
                </label>
                <input
                    class="block w-full bg-gray-200 text-gray-700 border border-red-500 rounded py-1 px-2 mb-1  focus:outline-none focus:bg-white"
                    id="password" name="password" type="password" value=""
                    placeholder="">
                <label class="block uppercase tracking-wide text-xs font-bold"
                       for="password_confirmation">
                    Passwort wiederholen *
                </label>
                <input
                    class="block w-full bg-gray-200 text-gray-700 border border-red-500 rounded py-1 px-2 mb-1 focus:outline-none focus:bg-white"
                    id="password_confirmation" name="password_confirmation" type="password" value=""
                    placeholder="">

            </div>
            <div class="px-3 mb-2">
                <p class="text-xs">* Pflichtfelder</p>
                @error('password')
                <p class="text-pink text-xs italic">{{ $message }}</p>
                @enderror
            </div>
            <div class="w-full flex justify-center px-3 my-3">
                <x-form-submit-button id="" value="Passwort ändern"></x-form-submit-button>
            </div>

            <div class="w-full flex justify-center px-3 my-3">
                @error('Passwort ändern')
                <p class="text-pink text-xs italic">{{ $message }}</p>
                @enderror
            </div>

            <div class="w-full ">
                <a href="{{ route('login') }}"
                   class="w-full flex justify-center text-sm px-3 my-0.5 font-bold text-thiel hover:text-thiel--end">Ohne Änderung zum Login</a>
            </div>
        </form>
    </x-modal>
</x-layout>
