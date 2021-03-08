@extends('layout.app')

@section('content')
  <div class="my-3 w-4/5 h-5/6 flex flex-col">
    <div class="m-3 p-4 w-full h-full bg-white rounded-xl">
      <form action="{{ url('/shoppinglists/'.request()->segment(2)) }}" method="post" class="w-full h-full ">  
        @method('put')
        @csrf
        <input type="hidden" name="shoppinglist_id" value="{{ $shoppinglist->id }}">
        <div class="my-1 flex justify-between">
          <label for="title" class="w-1/6 p-2 my-2 text-xl text-center">Title</label>
          <input type="text" name="title" id="title" required
          class="bg-gray-100 border-2 w-5/6 p-2 my-2" value="{{ $shoppinglist->title }}">
        </div>
        
        <div class="my-1 flex justify-between">
          <label for="datetime" class="w-1/6 p-2 my-2 text-xl text-center">Date</label>
          <input type="datetime-local" name="datetime" id="datetime" placeholder="Y-m-dTH:i:s" value="{{ (new \DateTime($shoppinglist->date))->format('Y-m-d\TH:i:s') }}" required
          class="bg-gray-100 border-2 w-5/6 p-2 my-2">
        </div>
        
        <div class="mt-4 mb-1 h-2/5 flex justify-between">
          <div class=" w-full flex-col">
            <div class="flex-row">
              <div class="flex text-center">
                <div class="w-1/12 border-2">Number</div>
                <div class="w-3/12 border-2">Item Name</div>
                <div class="w-1/12 border-2">Amount</div>
                <div class="w-2/12 border-2">Unit</div>
                <div class="w-5/12 border-2">Memo</div>
                <div class="w-10"></div>
              </div>
            </div>

            <div id="ShoppingItems" class="flex-row overflow-auto max-h-40">
              @foreach ($shoppinglistdetails as $shoppinglistdetail)
                <div id="row-{{ $shoppinglistdetail->number }}" class="flex ShoppingItem">
                  <div class="w-1/12 border-2"><input type="text" class="pl-2 w-full" name="numbers[]" class="w-full" disabled value="{{ $shoppinglistdetail->number }}"></div>
                  <div class="w-3/12 border-2"><input type="text" class="pl-2 w-full" name="itemnames[]" class="w-full" value="{{ $shoppinglistdetail->itemname }}" required></div>
                  <div class="w-1/12 border-2"><input type="text" class="pl-2 w-full" name="amounts[]" class="w-full" value="{{ $shoppinglistdetail->amount }}" required></div>
                  <div class="w-2/12 border-2"><input type="text" class="pl-2 w-full" name="units[]" class="w-full" value="{{ $shoppinglistdetail->unit }}" required></div>
                  <div class="w-5/12 border-2"><input type="text" class="pl-2 w-full" name="memos[]" class="w-full" value="{{ $shoppinglistdetail->memo }}"></div>
                  <div class="w-10 flex flex-row-reverse"><input type="button" class="bg-gray-200 w-8 px-2 border-2 border-gray-300 font-bold rounded cursor-pointer RemoveRow" onclick="RemoveRow(this)" value="-"></div>
                </div>
              @endforeach
            </div>
          </div>
        </div>
        
        <div class="my-1 flex flex-row-reverse">
          <input type="button" id="AddRow" class="bg-gray-200 w-8 px-2 border-2 border-gray-300 font-bold rounded cursor-pointer" onclick="" value="+">
        </div>
        
        <div class="my-1 text-m flex flex-row-reverse">
          <input type="submit" value="Submit"
           class="bg-gray-100 border-2 w-1/6 p-2 my-2 cursor-pointer">
        </div>
      </form>
    </div>
  </div>
  
  <script>
    var row_count = {{ count($shoppinglistdetails) }};
    
    $(document).ready(function () {
        $("#AddRow").click(AddRow);
    });

    function AddRow() {
      row_count = row_count + 1;
      var table = document.getElementById("ShoppingItems");
      var row = document.createElement("div");
      row.className = "flex ShoppingItem";
      row.id = "row-" + row_count;

      var col_number = document.createElement("div");
      var col_itemname = document.createElement("div");
      var col_amount = document.createElement("div");
      var col_unit = document.createElement("div");
      var col_memo = document.createElement("div");
      var remove_btn = document.createElement("div");
      
      col_number.className = "w-1/12 border-2";
      col_itemname.className = "w-3/12 border-2" ;
      col_amount.className = "w-1/12 border-2" ;
      col_unit.className = "w-2/12 border-2" ;
      col_memo.className = "w-5/12 border-2" ;
      remove_btn.className = "w-10 flex flex-row-reverse";

      col_number.innerHTML = '<input type="text" class="pl-2 w-full" name="numbers[]" class="w-full" disabled value="' + row_count + '">';
      col_itemname.innerHTML = '<input type="text" class="pl-2 w-full" name="itemnames[]" class="w-full" required>';
      col_amount.innerHTML = '<input type="text" class="pl-2 w-full" name="amounts[]" class="w-full" required>';
      col_unit.innerHTML = '<input type="text" class="pl-2 w-full" name="units[]" class="w-full" required>';
      col_memo.innerHTML = '<input type="text" class="pl-2 w-full" name="memos[]" class="w-full">';
      remove_btn.innerHTML = '<input type="button" class="bg-gray-200 w-8 px-2 border-2 border-gray-300 font-bold rounded cursor-pointer RemoveRow" onclick="RemoveRow(this)" value="-">';
    
      row.appendChild(col_number);
      row.appendChild(col_itemname);
      row.appendChild(col_amount);
      row.appendChild(col_unit);
      row.appendChild(col_memo);
      row.appendChild(remove_btn);

      table.appendChild(row);

      document.getElementsByClassName('RemoveRow').item(0).disabled = false;
    }

    function RemoveRow(btn){
      if(row_count == 1){
        return
      }

      row_count = row_count - 1;
      btn.parentNode.parentNode.parentNode.removeChild(btn.parentNode.parentNode);

      sort();
    }

    function sort() {
      var numbers = document.getElementsByName('numbers[]');
      for (let i = 0; i < numbers.length; i++) {
        var number = numbers.item(i);
        number.value = i + 1;
      }      
    }
  </script>
@endsection