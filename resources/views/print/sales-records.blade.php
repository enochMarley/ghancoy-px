<x-layout>
   <div class="flex flex-col justify-center pt-4">

      {{-- Heading Div --}}
      <x-print-components.general.header :title="$title" />

      {{-- Sales Info Div --}}
      <x-print-components.sales-records.sales-info :result="$result" />

   </div>
</x-layout>