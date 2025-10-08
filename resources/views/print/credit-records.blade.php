<x-layout>
   <div class="flex flex-col justify-center pt-4">

      {{-- Heading Div --}}
      <x-print-components.general.header :title="$title" />

      {{-- Sales Info Div --}}
      <x-print-components.credit-records.credit-info :result="$result" :grandTotal="$grandTotal" />

   </div>
</x-layout>