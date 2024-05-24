<div class="container bg-greylight border border-grey rounded-2xl drop-shadow-lg mx-auto max-w-xl mt-4 sm:mt-8 sm:px-6">
    <div class="flex flex-row w-full ">
        <div class="flex flex-col w-full">
            <h2 class="flex justify-center inline-flex text-3xl m-6"> {{ $heading }} </h2>
            <div class="flex justify-center w-full rounded-xl z-100">
                {{ $slot }}
            </div>
        </div>
    </div>
</div>
