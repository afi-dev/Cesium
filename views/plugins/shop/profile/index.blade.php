@extends('layouts.app')
@section('title', trans('shop::messages.profile.payments'))
@section('content')
<div class="container mx-auto w-full col-span-12 flex flex-col">
   <div class="w-full  border-steel-200 border rounded-2xl pb-8 px-8">
      <div class="grid divide-y divide-steel-200 gap-8 overflow-x-scroll">
         <div class="flex flex-wrap items-start pt-8">
            <div class="w-full sm:w-1/4 mb-8 sm:mb-0">
               <span class="block text-sm font-medium text-white">{{ trans('shop::messages.profile.payments') }}</span>
               <p class="text-xs text-steel-50 mt-1">{{ trans('shop::messages.profile.payments_desc') }}</p>
            </div>
            <div class="w-full sm:w-3/4 ">
               <div class="flex flex-wrap">
                  <div class="w-full rounded-xl border border-steel-200">
                     <table class="text-left table-auto w-full">
                        <thead class="text-xs font-semibold text-steel-50">
                           <tr>
                              <th class="px-4 py-4 text-white">#</th>
                              <th class="px-4 py-4 text-white">{{ trans('shop::messages.fields.price') }}</th>
                              <th class="px-4 py-4 text-white">{{ trans('messages.fields.type') }}</th>
                              <th class="px-4 py-4 text-white">{{ trans('messages.fields.status') }}</th>
                              <th class="px-4 py-4 text-white">{{ trans('shop::messages.fields.payment_id') }}</th>
                              <th class="px-4 py-4 text-white">{{ trans('messages.fields.date') }}</th>
                           </tr>
                        </thead>
                        <tbody class="text-xs text-steel-50">
                           @foreach($payments as $payment)
                           <tr class="border-steel-200 border-t">
                              <td class="px-4 py-4">0</td>
                              <td class="px-4 py-4">40€</td>
                              <td class="px-4 py-4">{{ $payment->getTypeName() }}</td>
                              <td class="px-4 py-4">
                                 <span class="bg-{{ $payment->statusColor() }} rounded text-white p-1 font-semibold">
                                 {{ trans('shop::admin.payments.status.'.$payment->status) }}
                                 </span>
                              </td>
                              <td class="px-4 py-4">{{ $payment->transaction_id ?? trans('messages.unknown') }}</td>
                              <td class="px-4 py-4">{{ format_date_compact($payment->created_at) }}</td>
                           </tr>
                           @endforeach
                           @if ($payments == null)
                           <tr class="border-t border-steel-200">
                              <td class="px-4 py-3 text-center text-white font-medium" colspan="6">
                                 {{ trans('shop::messages.profile.empty') }}
                              </td>
                           </tr>
                           @endif
                        </tbody>
                     </table>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <div class="w-full border-steel-200 border rounded-2xl p-8 mt-10">
      <div class="grid divide-y divide-steel-200">
         <div class="flex flex-wrap items-start -mx-4">
            <div class="w-full sm:w-1/4 px-4 mb-8 sm:mb-0">
               <span class="block text-sm font-medium text-white">{{ trans('shop::messages.fields.code') }}</span>
               <p class="text-xs text-steel-50 mt-1">{{ trans('shop::messages.giftcards.add') }}</p>
            </div>
            <form action="{{ route('shop.giftcards.add') }}" method="POST" class="w-full sm:w-3/4 px-4">
               @csrf
               <div class="flex flex-wrap -mx-4 -mb-10">
                  <div class="w-full lg:w-1/2 px-4 mb-8">
                     <label class="flex relative w-full h-14 py-4 border border-steel-200 hover:border-white rounded-xl transition duration-200">
                     <span class="absolute bottom-full left-0 ml-3 -mb-1 transform translate-y-0.5 text-xs font-semibold text-white px-1.5 bg-steel-300">{{ trans('shop::messages.fields.code') }}</span>
                     <input id="code" name="code" class="h-full block w-full outline-none bg-transparent text-white placeholder-steel-100 font-medium focus:ring-0 focus:outline-none border-0 focus:border-0 px-5" type="text" value="{{ old('code') }}" placeholder="{{ trans('shop::messages.fields.code') }} " required="">
                     </label>
                     @error('code')
                     <span class="text-danger text-xs pr-12 mt-2 font-semibold flex items-center truncate" role="alert">
                     <svg class="flex-shrink-0 h-4 w-4 fill-danger my-auto mr-1" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M7.84308 3.80211C9.8718 2.6007 10.8862 2 12 2C13.1138 2 14.1282 2.6007 16.1569 3.80211L16.8431 4.20846C18.8718 5.40987 19.8862 6.01057 20.4431 7C21 7.98943 21 9.19084 21 11.5937V12.4063C21 14.8092 21 16.0106 20.4431 17C19.8862 17.9894 18.8718 18.5901 16.8431 19.7915L16.1569 20.1979C14.1282 21.3993 13.1138 22 12 22C10.8862 22 9.8718 21.3993 7.84308 20.1979L7.15692 19.7915C5.1282 18.5901 4.11384 17.9894 3.55692 17C3 16.0106 3 14.8092 3 12.4063V11.5937C3 9.19084 3 7.98943 3.55692 7C4.11384 6.01057 5.1282 5.40987 7.15692 4.20846L7.84308 3.80211ZM13 16C13 16.5523 12.5523 17 12 17C11.4477 17 11 16.5523 11 16C11 15.4477 11.4477 15 12 15C12.5523 15 13 15.4477 13 16ZM12 6.25C12.4142 6.25 12.75 6.58579 12.75 7V13C12.75 13.4142 12.4142 13.75 12 13.75C11.5858 13.75 11.25 13.4142 11.25 13V7C11.25 6.58579 11.5858 6.25 12 6.25Z"/>
                     </svg>
                     {{ $message }}
                     </span>
                    @enderror
                  </div>
                  <div class="w-full lg:w-1/2 px-4 mb-10">
                     <button type="submit" class="w-full bg-steel-400 py-4 px-4 text-white text-md rounded-xl transition duartion-200 hover:bg-steel-200">{{ trans('messages.actions.send') }}</button>
                  </div>
               </div>
            </form>
         </div>
      </div>
   </div>
</div>

@endsection