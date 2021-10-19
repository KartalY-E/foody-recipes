<x-app-layout>
    <div class="">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden shadow-sm sm:rounded-lg">
                <div class="px-6">
                    <div class="flex" id="nav-img">
                        <div class="title mx-auto">
                            It's
                            <br>
                            &nbsp;Cooking
                            <br>
                            Time
                        </div>
                        <div id="eatingSvg" class="flex">
                            <img class="mx-auto" src="{{ asset('storage/svg/eating.svg')}}" alt="" srcset="">
                        </div>

                    </div>
                    <front-page></front-page>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
