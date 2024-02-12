<x-app-layout>
   <div>
        <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-200">
            <div class="container mx-auto px-6 py-1 pb-16">
              <div class="bg-white shadow-md rounded my-6 p-5">

              <div class="container">
  <!-- Title -->
  <h1 class="text-center my-4">Hajira Payment System</h1>

  <!-- Search form -->
  <form class="flex justify-center items-center my-2 my-lg-0 mb-4" action="/admin/hajira">
    <div class="flex flex-col space-y-2">
      <input id="payment_code" type="text" name="payment_code" placeholder="Enter Payment code" class="px-4 mx-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200"/>
    </div>
    
    <button
      class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded"
      type="submit"
    >
      Search
    </button>
  </form>

  @if(isset($data['success']))
  @if($data['success'])
  <!-- Response and form divs -->
  <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-8">
    <div class="flex flex-col my-7">
      <!-- Table div -->

      <table class="border-collapse border border-slate-400 ...">
  
      <tbody>
    <tr>
      <td class="border border-slate-300 ...">First Name</td>
      <td class="border border-slate-300 ...">
 
        {{$data['pilgrim']['first_name']}}
  
       </td>
    </tr>
    <tr class="py-3">
      <td class="border border-slate-300 ...">Middle Name</td>
      <td class="border border-slate-300 ...">
      {{$data['pilgrim']['middle_name']}}
      </td>
    </tr>
    <tr>
      <td class="border border-slate-300 ...">Last Name</td>
      <td class="border border-slate-300 ...">
      {{$data['pilgrim']['last_name']}}
      </td>
    </tr>
    <tr>
      <td class="border border-slate-300 ...">Passport Number</td>
      <td class="border border-slate-300 ...">
      {{$data['pilgrim']['passport_number']}}
      </td>
    </tr>
    <tr>
      <td class="border border-slate-300 ... bold">Birth Date</td>
      <td class="border border-slate-300 ...">
      {{$data['pilgrim']['birth_date']}}
      </td>
    </tr>
    <tr>
      <td class="border border-slate-300 ...">Service Package</td>
      <td class="border border-slate-300 ...">
      {{$data['pilgrim']['service_package']}}
      </td>
    </tr>
    <tr>
      <td class="border border-slate-300 ...">Payment Code</td>
      <td class="border border-slate-300 ...">
      {{$data['pilgrim']['payment_code']}}
      </td>
    </tr>
    <tr>
      <td class="border border-slate-300 ...">Amount</td>
      <td class="border border-slate-300 ...">
      {{$data['pilgrim']['amount']}}
      </td>
    </tr>
    <tr>
      <td class="border border-slate-300 ...">Paid</td>
      <td class="border border-slate-300 ...">
      @if($data['pilgrim']['paid'])
        Paid
      @else
        Not Paid
      @endif
      </td>
    </tr>
  </tbody>
</table>
    </div>
    <div>

      <!-- Form div -->
      <form method="POST" action="{{ route('admin.posts.store') }}">
      @csrf

                    <input id="payment_code" type="text" name="payment_code" 
                      placeholder="Enter payment_code" class="hidden"
                      value="{{$data['pilgrim']['payment_code']}}"
                    />

                    <input id="bank_code" type="text" name="bank_code"   value="SIINQEE11" class="hidden"
                      placeholder="Enter bank_code"
                    />
        <div class="flex flex-col space-y-2 my-3">
                    <label for="account_holder" class="text-gray-700 select-none font-medium">Account Holder</label>
                    <input id="account_holder" type="text" name="account_holder" value="{{ old('title') }}"
                      placeholder="Enter account_holder" class="px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200"
                    />
        </div>
        <div class="flex flex-col space-y-2 my-3">
                    <label for="account_number" class="text-gray-700 select-none font-medium">Account Number</label>
                    <input id="account_number" type="text" name="account_number" value="{{ old('title') }}"
                      placeholder="Enter account_number " class="px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200"
                    />
        </div>
        
                    <input id="amount" type="number" name="amount" value="{{$data['pilgrim']['amount']}}"
                      placeholder="Enter amount" class="hidden"
                    />
        
        <div class="flex flex-col space-y-2 my-3">
                    <label for="reference_number" class="text-gray-700 select-none font-medium">Reference Number</label>
                    <input id="reference_number" type="text" name="refrence_number" value="{{ old('title') }}"
                      placeholder="Enter reference_number" class="px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200"
                    />
        </div>
   

                    <select class="hidden" name="paid">
                      <option value="true">paid</option>
                      <option value="false">unpaid</option>
                    </select>
                    <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">
          Submit
        </button>
                </div>
      
      </form>
    </div>
  </div>
</div>  
@else
<div class="warning">{{$data['error']}}</div>
@endif
@else
<div class="warning">Please Enter payment code</div>
@endif
            </div>
        </main>
    </div>
</div>
</x-app-layout>
