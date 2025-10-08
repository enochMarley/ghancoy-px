<x-layout>
   <div class="flex flex-col justify-center pt-4">

      {{-- Heading Div --}}
      <x-print-components.general.header :title="$title" />


      {{-- Personnel Credit Info Div --}}
      <x-print-components.personnel-credit.personnel-credit-info :grandTotal="$grandTotal" :result="$result" />

   </div>
</x-layout>