@extends('layout.app')

@section('content')
  <div class="flex my-3 w-full h-5/6 space-x-4">
      <div class="w-1/4 h-full">
        <div class="w-full h-2/3 bg-white">
          <h1 class="mx-3 mb-0.5 p-0.5 border-b-2 border-red-600 text-center text-2xl ">
            Shopping Lists
          </h1>
          
          <div class="m-1 overflow-auto">
            <ul class="mx-2">
              @foreach ($shoppinglists as $shoppinglist)
              <li>
                <a href="{{ url('/shoppinglists/'.$shoppinglist->id) }}"> {{ $shoppinglist->title }} </a>
              </li>
              @endforeach
            </ul>
          </div>
        </div>

        @if (request()->is('shoppinglists/*'))
          <div class="m-5 flex justify-around">
            <a class="px-4 py-2 border-2 border-gray-400 bg-white rounded" href="{{ url('/shoppinglists/'.request()->segment(2)).'/edit' }}">Update</a>
            
            <form action="{{ url('/shoppinglists/'.request()->segment(2)) }}" class="inline" method="post">
              @method('delete')
              @csrf
              <input type="submit" class="px-4 py-2 border-2 border-gray-400 bg-white cursor-pointer rounded" value="Delete">
            </form>
          </div>
        @endif
      </div>
      
      <div class="w-3/4 bg-white h-full">
        <h1 class="mx-3 mb-0.5 p-0.5 border-b-2 border-red-600 text-center text-2xl ">
            Shopping List Details
        </h1>

        <div class="mt-4 mb-1 flex justify-between">
          <div class="mx-3 w-full flex-col">
            <div class="flex-row">
              <div class="flex text-center">
                <div class="w-1/12 border-2">Number</div>
                <div class="w-3/12 border-2">Item Name</div>
                <div class="w-1/12 border-2">Amount</div>
                <div class="w-2/12 border-2">Unit</div>
                <div class="w-5/12 border-2">Memo</div>
              </div>
            </div>

            <div id="items" class="flex-row">
              
              @if (request()->is('shoppinglists/*'))
                @foreach ($shoppinglistdetails as $shoppinglistdetail)
                    
                    <div id="item" class="flex text-sm">
                      <div class="w-1/12 pl-2 border-2">{{ $shoppinglistdetail->number }}</div>
                      <div class="w-3/12 pl-2 border-2">{{ $shoppinglistdetail->itemname }}</div>
                      <div class="w-1/12 pl-2 border-2">{{ $shoppinglistdetail->amount }}</div>
                      <div class="w-2/12 pl-2 border-2">{{ $shoppinglistdetail->unit }}</div>
                      <div class="w-5/12 pl-2 border-2">{{ $shoppinglistdetail->memo }}</div>
                    </div>

                @endforeach
              @endif

            </div>
          </div>
        </div>
      </div>
  </div>
@endsection