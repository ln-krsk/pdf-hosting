<div class="container bg-greylight border border-grey rounded-2xl drop-shadow-lg mx-auto max-w-xl mt-2">
    <a class="flex justify-start  text-thiel underline text-sm m-2" href="{{ route('entries') }}">Zurück</a>
    <div class="flex flex-row w-full sm:px-6 ">
        <div class="flex flex-col w-full">
            <h2 class="uppercase tracking-wide font-semibold text-3xl text-center mt-2 mb-4"> {{ $heading }} </h2>
            <div class="flex justify-center w-full z-100">
                {{ $slot }}
            </div>
        </div>
    </div>
</div>
