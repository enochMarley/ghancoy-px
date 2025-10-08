<div class="mt-6">
    {{-- Heading --}}
    <table class="table table-xs rounded-box">
        <thead>
            <tr class=" bg-gray-300">
                <th colspan="7" class="text-xs">PERSONNEL CREDIT HISTORY</th>
            </tr>
        </thead>

        <tbody>
            {{-- <span class="hidden">{{ $index = 0}}</span> --}}
            <colgroup>
                <col style="width:5%;">
                <col style="width:25%;">
                <col style="width:15%;">
                <col style="width:15%;">
                <col style="width:10%;">
                <col style="width:15%;">
                <col style="width:15%;">
            </colgroup>

            @if (count($result) > 0)
            <span class="hidden">{{ $index = 0}}</span>
                <tr class="table-row text-center">
                    <th class="border border-gray-300 text-xs">SER</th>
                    <th class="border border-gray-300 text-xs">PERSONNEL</th>
                    <th class="border border-gray-300 text-xs">ITEM</th>
                    <th class="border border-gray-300 text-xs">SP (FCFA)</th>
                    <th class="border border-gray-300 text-xs">QTY<br/>(CREDIT)</th>
                    <th class="border border-gray-300 text-xs">AMOUNT OWED <br/>(FCFA)</th>
                    <th class="border border-gray-300 text-xs">DATE</th>
                </tr>

                <tr class="table-row text-center">
                    <th class="border border-gray-300 text-xs">(a)</th>
                    <th class="border border-gray-300 text-xs">(b)</th>
                    <th class="border border-gray-300 text-xs">(c)</th>
                    <th class="border border-gray-300 text-xs">(d)</th>
                    <th class="border border-gray-300 text-xs">(e)</th>
                    <th class="border border-gray-300 text-xs">(f)</th>
                    <th class="border border-gray-300 text-xs">(g)</th>
                </tr>

                @foreach ($result as $personnel => $items)
                    <span class="hidden">{{ ++$index}}</span>
                    @foreach ($items['creditHistory'] as $key => $value)
                        <tr>
                            @if ($loop->first)
                                <td rowspan="{{ count($items['creditHistory']) }}" class="border border-gray-300 text-xs">{{ $index }}.</td>

                                <td rowspan="{{ count($items['creditHistory']) }}" class="border border-gray-300 text-xs">{{ $personnel }}</td>
                            @endif
                            <td class="border border-gray-300 text-xs">{{ $value['item'] }}</td>

                            <td class="border border-gray-300 text-xs">
                                {{ number_format($value['selling_price']) }}
                            </td>

                            <td class="border border-gray-300 text-xs">
                                {{ number_format($value['total_quantity']) }}
                            </td>

                            <td class="border border-gray-300 text-xs">
                                {{ number_format($value['amount_owed']) }}
                            </td>

                            <td class="border border-gray-300 text-xs">
                                {{ $value['date'] }}
                            </td>
                        </tr>
                    @endforeach
                    <tr>
                        {{-- <td></td> --}}
                        <td class="border border-gray-300 text-xs" colspan="5">Total</td>
                        
                        <td class="border border-gray-300 text-xs font-bold">
                            {{number_format($items['totals']['total_amount_owed']) }}
                        </td>
                       
                        <td class="border border-gray-300 text-xs"></td>
                    </tr>

                    <tr>
                        <td colspan="7" rowspan="1" class=" border-none h-6"></td>
                    </tr>
                @endforeach

                    <tr>
                        <td class="border border-gray-300 text-xs font-bold" colspan="5">GRAND TOTAL</td>
                        
                        <td class="border border-gray-300 text-xs font-bold">
                            {{number_format($grandTotal['grand_total_amount_owed']) }}
                        </td>
                       
                        <td class="border border-gray-300 text-xs"></td>
                    </tr>

            @else
                <tr>
                    <td class="border border-gray-300" colspan="12">No Credit Data Available for Period</td>
                </tr>
            @endif


        </tbody>
    </table>
</div>