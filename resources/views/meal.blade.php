<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Home') }}
        </h2>
    </x-slot>

    <div class="p-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg relative">
                <div class="p-6" id="single-meal">  
                    <img src="{{ asset('storage/images/' . $meal->image) }}" alt="" class="">
                    <h1 class="w-2/3">
                        {{ $meal->name }} 
                        <span id="favoriteIconBlack">
                            <favorite :slug="'{{ $meal->slug }}'" :isfav="{{ $meal->isFav() }}"></favorite>
                        </span>
                    </h1>
                    <p class="w-2/3">
                        {{ \Illuminate\Support\Str::limit($meal->instructions,1500) .'.' }}
                    </p>
                    
                    
                    <h3>
                        <br>
                        Category: {{ $meal->category->category }}
                        <br>
                        From: {{ $meal->area }}
                    </h3>
                    <br>
                    <a href="{{ $meal->url }}" class="youtube">Youtube</a>
                    </div>
            </div>
        </div>  

        <div class="container mx-auto m-6 p-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3">
                @foreach($suggestedMeals as $meal)
                    
                <div class="flex justify-center meal-card m-8">
                    <a href="{{ route('meal.show',[$meal]) }}">
                        
                        <img src="{{ asset('storage/images/' . $meal->image) }}" alt="" srcset="" />
                        <p>
                            <span class="font-bold">{{ $meal->name }}</span>
                            <br />{{ $meal->area }}
                        </p>
                    </a>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
