<x-layout>
    <x-modal heading="Passwort vergessen?">
        <form method="POST" action="{{ route('password.email') }}" class="w-full">
            @csrf
            <div class="w-full px-3 mb-1.5">
                <label class="block uppercase tracking-wide text-xs font-semibold"
                       for="email">
                    Emailadresse
                </label>
                <input
                    class="block w-full border rounded py-1 px-2 mb-1.5  focus:outline-none focus:bg-white"
                    id="email" name="email" type="text" value="{{old('email')}}">
                @error('email')
                <p class="text-pink text-xs italic">{{ $message }}</p>
                @enderror
                @error('Passwort zurücksetzen')
                <p class="text-pink text-xs italic">{{ $message }}</p>
                @enderror
            </div>
            <div class="w-full flex justify-center px-3 my-3 mt-4 mb-5">
                <x-form-submit-button id="" value="Passwort zurücksetzen"></x-form-submit-button>
            </div>
            <span class="inline flex justify-center text-sm mb-2">Nur verklickt?
                <a href="{{ route('login') }}"
                   class="ml-1 text-sm text-thiel hover:text-thiel--end">Log dich hier ein!</a></span>
        </form>
    </x-modal>
</x-layout>
