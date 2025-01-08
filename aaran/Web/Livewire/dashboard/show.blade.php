<div class="w-full bg-white">

    <x-slot name="header">Articles</x-slot>

    <x-web.home-new.items.banner label="Articles"
        desc="Our Library provides all the necessary direct and indirect tax-related data." padding="sm:px-[160px]"
        padding_mob="px-[40px]" />


    <div class="w-7/12 mx-auto mt-20">

        <div class="flex flex-col w-full h-auto my-14 gap-y-5">
            <div class="text-4xl leading-tight capitalize font-merri">
                {{ $blog['vname'] }}
            </div>

            <div class="flex text-red-600 uppercase gap-x-3 font-lex">

                <span class="text-gray-600">{{ date('d-m-Y', strtotime($blog['created_at'])) }}</span>
                <span>
                    <span class="text-gray-900">| &nbsp;</span>
                    <x-icons.icon-fill :iconfill="'tag-menu'" class="w-4 h-3 " :colour="'#dc2626'" />
                    <span>{{ $blog['category_name'] }}</span>
                </span>
                <span class="text-gray-900">| &nbsp;</span>
                <span>{{ $blog['tag_name'] }}</span>
            </div>

            @if ($blog['image'] != 'no image')
                <img src="{{ $blog['image'] }}" alt="{{ $blog['image'] }}"
                    class="h-[35rem] w-full shadow-md shadow-gray-400 rounded-sm" />
            @else
                <x-image.empty-img />
            @endif

            <div class="inline-flex text-gray-500 font-lex">

                <div class="flex gap-1.5 justify-center items-center text-xs">

                    <x-icons.icon :icon="'clock'" class="w-3 h-3" />
                    <span>{{ \Carbon\Carbon::parse($blog['created_at'])->diffForHumans() }}</span>
                </div>

                <span class="inline-flex items-center gap-x-1 mx-3 mt-0.5 text-xs">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                        class="text-gray-600 size-3">
                        <path fill-rule="evenodd"
                            d="M7.5 6a4.5 4.5 0 1 1 9 0 4.5 4.5 0 0 1-9 0ZM3.751 20.105a8.25 8.25 0 0 1 16.498 0 .75.75 0 0 1-.437.695A18.683 18.683 0 0 1 12 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 0 1-.437-.695Z"
                            clip-rule="evenodd" />
                    </svg>

                    <span class="uppercase">&nbsp;POST BY : </span>
                    <span class="text-red-600 uppercase"> {{ $blog['user_name'] }}</span>
                </span>

            </div>
            <div class="leading-loose text-gray-600 font-lex indent-10">
                {{ $blog['body'] }}
            </div>
        </div>

        <div class="w-full border"></div>

        <div class="py-10 space-y-3">
            <div class="text-sm font-semibold font-lex">About the Author</div>
            <div class="flex items-center gap-x-4">
                <div>
                    <img src="{{ $blog['user_image'] }}" alt="" class="w-10 h-10 rounded-full">
                </div>

                <div class="flex flex-col items-start justify-start font-semibold gap-y-1">
                    <div class="text-sm text-gray-800 underline capitalize"> {{ $blog['user_name'] }}</div>
                    <div class="text-xs text-gray-600">{{ $blog['user_role'] }}</div>
                </div>
            </div>
            <div class="text-sm text-gray-600 ">
                {{ $blog['user_bio'] }}
                {{-- <a class="px-2 font-semibold cursor-pointer">Read more...</a> --}}
            </div>
        </div>

        <div class="w-full border"></div>

        <div class="py-10 space-y-5">
            <div class="text-sm font-semibold font-lex">Further reading</div>
            <div class="grid w-full grid-cols-3 gap-5 ">
                @foreach ($collectBlog as $index => $row)
                    @if ($index != $blogIndex)
                        @if ($index <= 3)
                            <a href="{{ route('showArticles', [$index]) }}" class="flex flex-col h-56 shadow-md cursor-pointer gap-y-5 group hover:shadow-lg">
                                <div class="overflow-hidden rounded-md">
                                    <img src="{{ $row['image'] }}" alt=""
                                        class="object-cover w-full h-40 transition duration-500 ease-in-out group-hover:scale-105 " />
                                </div>
                                <div class="w-full px-5 pb-5 space-y-1 text-xs font-lex">
                                    <div class="text-xs font-semibold">{{ \Illuminate\Support\Str::words($row['vname'], 8) }}</div>
                                    <div class="text-xs text-gray-600"> {{ \Illuminate\Support\Str::words($row['body'], 8) }}</div>
                                </div>
                            </a>
                        @endif
                    @endif
                @endforeach
            </div>
        </div>
        <div class="w-full border"></div>
        <div class="py-10 space-y-5">
            <div class="space-y-3 font-semibold font-lex">Explore topics</div>

            <div class="flex flex-wrap gap-5 text-xs text-gray-600 font-lex ">
                @foreach ($blogCategory as $index => $row)
                    <div
                        class="px-4 py-1 font-bold text-gray-600 border border-gray-600 rounded-md cursor-pointer hover:text-red-600 hover:border-red-600">
                        {{ $row['category_name'] }}
                    </div>
                @endforeach
            </div>
        </div>

        <div class="flex items-center justify-between py-10 text-gray-800 gap-x-5 font-lex">
            <a href="{{ route('showArticles', [$blogIndex == 0 ? 0 : $blogIndex - 1]) }}"
                class="flex items-center justify-center px-4 py-2 text-xs transition-all duration-300 ease-in-out border rounded-md cursor-pointer gap-x-5 cursor group hover:bg-blue-600">

                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="text-gray-800 size-6 group-hover:text-white">

                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 15.75 3 12m0 0 3.75-3.75M3 12h18" />
                </svg>
                <span class="group-hover:text-white">Previous</span>
            </a>
            <a href="{{ route('showArticles', [isset($collectBlog[$blogIndex + 1]) ? $blogIndex + 1 : 0]) }}"
                class="flex items-center justify-center px-4 py-2 text-xs transition-all duration-300 ease-in-out border rounded-md cursor-pointer gap-x-5 cursor hover:bg-blue-600 group">

                <span class=" group-hover:text-white">Next</span>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="text-gray-800 size-6 group-hover:text-white">


                    <path stroke-linecap="round" stroke-linejoin="round" d="M17.25 8.25 21 12m0 0-3.75 3.75M21 12H3" />
                </svg>
            </a>
        </div>

        {{-- <div class="w-full border"></div> --}}

    </div>
    <div class="flex flex-col items-center justify-center w-full h-60 font-lex bg-gray-50">
        <div class="flex-col items-center justify-center w-7/12 mx-auto rounded-t-md">
            <div class="flex flex-col items-center justify-center w-2/3 py-5 mx-auto space-y-2 text-xs gap-x-5">
                <div>Subscribe to <span class="text-red-600">Codexsun</span> Newsletter</div>
                <div class="text-gray-600">Stay Connected and get latest updates and more about...</div>
            </div>
        </div>
        <div class="flex items-center justify-center w-7/12 gap-x-3 ">
            <div class="w-2/4 h-full ">
                {{--
                <x-input.floating label="Email*" /> --}}
                <div class="relative w-full">
                    <input type="text" id="floating_outlined"
                        class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent rounded-lg border-1
           border-gray-300 appearance-none
           focus:outline-none focus:ring-2 focus:ring-cyan-50 focus:border-blue-600 peer"
                        placeholder=" " autocomplete="off" />
                    <label for="floating_outlined"
                        class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300
           transform -translate-y-4 scale-75 top-2 z-20 origin-[0]
           bg-gray-50  px-2 peer-focus:px-2 peer-focus:text-blue-600
           peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100
           peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4
           rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto start-1 pointer-events-none">Email*</label>
                </div>

            </div>

            <button class="h-10 px-4 text-sm text-white bg-black rounded-md cursor-pointer ">Sign Up</button>
        </div>
        <div class="flex justify-center w-7/12 py-2 mx-auto gap-x-2 rounded-b-md">

            <div class="text-[10px] text-gray-400">By submitting this form, I agree to the Codexsun </div>
            <a href="{{route('policy.show')}}" class="text-[10px] text-gray-400 underline cursor-pointer">Privacy Policy</a>
            <div class="text-[10px] text-gray-400">/</div>
            <a  href="{{route('terms.show')}}" class="text-[10px] text-gray-400 underline cursor-pointer">Terms</a>
        </div>

    </div>
</div>
