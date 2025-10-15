<div class="mt-12">
    {{-- Heading --}}
    <table class="table summary-table table-xs rounded-box">
        <thead>
            <tr class=" bg-gray-300">
                <th colspan="12" class="text-xs">EXPENSE RECORDS RECORDS</th>
            </tr>
        </thead>

        <tbody>
            {{-- <span class="hidden">{{ $index = 0}}</span> --}}
            <colgroup>
                <col style="width:10%;">
                <col style="width:10%;">
                <col style="width:30%;">
                <col style="width:10%;">
                <col style="width:10%;">
                <col style="width:15%;">
                <col style="width:15%;">
            </colgroup>

            @if (count($expenseResults) > 0)
                <span class="hidden">{{ $index = 0}}</span>
                <tr class="table-row text-center">
                    <th>SER</th>
                    <th>DATE</th>
                    <th>ITEM</th>
                    <th>CP <br /> (FCFA)</th>
                    <th>TOTAL QTY</th>
                    <th>TOTAL PRICE <br />(FCFA)</th>
                    <th>REMARKS</th>
                </tr>

                <tr class="table-row text-center">
                    <th>(a)</th>
                    <th>(b)</th>
                    <th>(c)</th>
                    <th>(d)</th>
                    <th>(e)</th>
                    <th>(f)</th>
                    <th>(g)</th>
                </tr>

                @foreach ($expenseResults as $date => $items)
                    <span class="hidden">{{ ++$index}}</span>
                    @foreach ($items['expenses'] as $key => $value)
                        <tr>
                            @if ($loop->first)
                                <td rowspan="{{ count($items['expenses']) }}">{{ $index }}.
                                </td>

                                <td rowspan="{{ count($items['expenses']) }}">
                                    {{ Carbon\Carbon::parse($date)->format('d M y') }}
                                </td>
                            @endif
                            <td>{{ $value['description'] }}</td>

                            <td>
                                {{ number_format(floatval($value['unit_cost_price']), 2, '.', ',') }}
                            </td>

                            <td>
                                {{ number_format(intval($value['quantity']), 2, '.', ',') }}
                            </td>

                            <td>
                                {{ number_format(floatval($value['cost_price_total']), 2, '.', ',') }}
                            </td>
                            <td></td>
                        </tr>
                    @endforeach
                    <tr>
                        {{-- <td></td> --}}
                        <td colspan="5">Totals</td>
                        <td class="border border-gray-300 text-xs font-bold">
                            {{ number_format($items['totals']['total_cost_price'], 2, '.', ',') }}
                        </td>
                        <td></td>
                    </tr>

                    <tr>
                        <td colspan="6" rowspan="1" class=" border-none h-6"></td>
                    </tr>
                @endforeach

                <tr>
                    <td class="border border-gray-300 text-xs font-bold" colspan="5">GRAND TOTAL</td>

                    <td class="border border-gray-300 text-xs font-bold">
                        {{ number_format($expenseGrandTotal['grand_total_cost_price'], 2, '.', ',') }}
                    </td>
                    <td></td>
                </tr>

            @else
                <colgroup>
                    <col style="width:100%;">
                </colgroup>
                <tr>
                    <td class="border border-gray-300" colspan="12">No Expense Record Data Available for Period</td>
                </tr>
            @endif


        </tbody>
    </table>
</div>