<div class="mt-6">
    {{-- Heading --}}
    <table class="table table-xs rounded-box">
        <thead>
            <tr class=" bg-gray-300">
                <th colspan="9" class="text-xs">SALES RECORDS</th>
            </tr>
        </thead>

        <tbody>
            {{-- <span class="hidden">{{ $index = 0}}</span> --}}
            <colgroup>
                <col style="width:5%;">
                <col style="width:10%;">
                <col style="width:15%;">
                <col style="width:10%;">
                <col style="width:10%;">
                <col style="width:10%;">
                <col style="width:15%;">
                <col style="width:15%;">
                <col style="width:10%;">
            </colgroup>

            @if (count($result) > 0)
            <span class="hidden">{{ $index = 0}}</span>
                <tr class="table-row text-center">
                    <th class="border border-gray-300 text-xs">SER</th>
                    <th class="border border-gray-300 text-xs">DATE</th>
                    <th class="border border-gray-300 text-xs">ITEM</th>
                    <th class="border border-gray-300 text-xs">CP (FCFA)</th>
                    <th class="border border-gray-300 text-xs">SP (FCFA)</th>
                    <th class="border border-gray-300 text-xs">QTY<br/>(CREDIT)</th>
                    <th class="border border-gray-300 text-xs">SALES - CREDIT <br/>(FCFA)</th>
                    <th class="border border-gray-300 text-xs">EST PROFIT <br/>(FCFA)</th>
                    <th class="border border-gray-300 text-xs">REMARKS</th>
                </tr>

                <tr class="table-row text-center">
                    <th class="border border-gray-300 text-xs">(a)</th>
                    <th class="border border-gray-300 text-xs">(b)</th>
                    <th class="border border-gray-300 text-xs">(c)</th>
                    <th class="border border-gray-300 text-xs">(d)</th>
                    <th class="border border-gray-300 text-xs">(e)</th>
                    <th class="border border-gray-300 text-xs">(f)</th>
                    <th class="border border-gray-300 text-xs">(g)</th>
                    <th class="border border-gray-300 text-xs">(h)</th>
                    <th class="border border-gray-300 text-xs">(i)</th>

                </tr>

                @foreach ($result as $date => $items)
                    <span class="hidden">{{ ++$index}}</span>
                    @foreach ($items['creditHistory'] as $key => $value)
                        <tr>
                            @if ($loop->first)
                                <td rowspan="{{ count($items['creditHistory']) }}" class="border border-gray-300 text-xs">{{ $index }}.</td>

                                <td rowspan="{{ count($items['creditHistory']) }}" class="border border-gray-300 text-xs">{{ Carbon\Carbon::parse($date)->format('d M y') }}</td>
                            @endif
                            <td class="border border-gray-300 text-xs">{{ $value['item'] }}</td>

                            <td class="border border-gray-300 text-xs">
                                {{ number_format($value['cost_price']) }}
                            </td>

                            <td class="border border-gray-300 text-xs">
                                {{ number_format($value['selling_price']) }}
                            </td>

                            <td class="border border-gray-300 text-xs">{{ $value['credit_quantity'] }}</td>

                            <td class="border border-gray-300 text-xs">
                                {{ number_format($value['credit_total']) }}
                            </td>

                            <td class="border border-gray-300 text-xs">
                                {{ number_format($value['estimated_profit']) }}
                            </td>

                            <td class="border border-gray-300 text-xs"></td>
                        </tr>
                    @endforeach
                    <tr>
                        <td class="border border-gray-300 text-xs font-bold" colspan="6">Totals</td>
                        
                        <td class="border border-gray-300 text-xs font-bold">
                            {{number_format($items['totals']['total_credit_total']) }}
                        </td>
                        <td class="border border-gray-300 text-xs font-bold">
                            {{ number_format($items['totals']['total_estimated_profit']) }}
                        </td>
                        <td class="border border-gray-300 text-xs"></td>
                    </tr>

                    <tr>
                        <td colspan="7" rowspan="1" class=" border-none h-6"></td>
                    </tr>
                @endforeach

                 <tr>
                    <td class="border border-gray-300 text-xs font-bold" colspan="6">GRAND TOTAL</td>
                    
                    <td class="border border-gray-300 text-xs font-bold">
                        {{number_format($grandTotal['grand_total_credit_total']) }}
                    </td>

                    <td class="border border-gray-300 text-xs font-bold">
                        {{number_format($grandTotal['grand_total_estimated_profit']) }}
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