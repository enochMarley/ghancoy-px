<div class="mt-6">
    {{-- Heading --}}
    <table class="table summary-table table-xs rounded-box">
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
                    <th>SER</th>
                    <th>DATE</th>
                    <th>ITEM</th>
                    <th>CP (FCFA)</th>
                    <th>SP (FCFA)</th>
                    <th>QTY<br />(CREDIT)</th>
                    <th>SALES - CREDIT <br />(FCFA)</th>
                    <th>EST PROFIT <br />(FCFA)</th>
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
                    <th>(h)</th>
                    <th>(i)</th>

                </tr>

                @foreach ($result as $date => $items)
                    <span class="hidden">{{ ++$index}}</span>
                    @foreach ($items['creditHistory'] as $key => $value)
                        <tr>
                            @if ($loop->first)
                                <td rowspan="{{ count($items['creditHistory']) }}">{{ $index }}.
                                </td>

                                <td rowspan="{{ count($items['creditHistory']) }}">
                                    {{ Carbon\Carbon::parse($date)->format('d M y') }}
                                </td>
                            @endif
                            <td>{{ $value['item'] }}</td>

                            <td>
                                {{ number_format($value['cost_price']) }}
                            </td>

                            <td>
                                {{ number_format($value['selling_price']) }}
                            </td>

                            <td>{{ $value['credit_quantity'] }}</td>

                            <td>
                                {{ number_format($value['credit_total']) }}
                            </td>

                            <td>
                                {{ number_format($value['estimated_profit']) }}
                            </td>

                            <td></td>
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
                        <td></td>
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

                    <td></td>
                </tr>

            @else
                <colgroup>
                    <col style="width:100%;">
                </colgroup>
                <tr>
                    <td class="border border-gray-300" colspan="9">No Credit Record Data Available for Period</td>
                </tr>
            @endif


        </tbody>
    </table>
</div>