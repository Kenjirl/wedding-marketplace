<div class="relative w-full lg:min-h-[50vh] flex items-center justify-center" style="background-color: #e9e6e1; color: #8c867f;"
    id="quote">
    <div class="absolute top-0 left-4 text-base md:text-[2em] lg:text-[4em] -skew-x-6">
        <i class="fa-solid fa-quote-left"></i></div>
    <div class="relative w-full min-h-[20vh] py-8 flex flex-col items-center justify-center gap-4 text-[.8em] md:text-base text-center font-varela">
        <div class="w-4/5 mb-4 lg:mb-8 font-semibold text-base md:text-[1.5em] lg:text-[2em] italic" id="quoteText">
            {{
                $wedding->invitation ? $wedding->invitation->quote['quote'] :
                'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam id dolor id nibh ultricies vehicula ut id elit. Integer posuere erat a ante venenatis dapibus posuere velit aliquet. Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum.'
            }}
        </div>

        <div class="w-fit py-2 px-4 font-bold italic border-b-2 border-white rounded-sm drop-shadow-sm font-sacramento text-xl md:text-3xl">
            -
            <span id="quoteAuthor">
                {{
                    $wedding->invitation ? $wedding->invitation->quote['author'] :
                    'Pengarang/Anonim'
                }}
            </span>
            -
        </div>

    </div>
    <div class="absolute bottom-0 right-4 text-base md:text-[2em] lg:text-[4em] -skew-x-6">
        <i class="fa-solid fa-quote-right"></i></div>
</div>
