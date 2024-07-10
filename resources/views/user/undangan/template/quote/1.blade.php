<div class="w-full min-h-[20vh] py-8 flex flex-col items-center justify-center gap-4 text-[.8em] md:text-base text-center font-varela">
    <div class="w-4/5">
        {{
            $wedding->invitation ? $wedding->invitation->c_quote['quote'] :
            'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam id dolor id nibh ultricies vehicula ut id elit. Integer posuere erat a ante venenatis dapibus posuere velit aliquet. Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum.'
        }}
    </div>

    <div class="italic">
        -
        {{
            $wedding->invitation ? $wedding->invitation->c_quote['author'] :
            'Pengarang/Anonim'
        }}
        -
    </div>
</div>
