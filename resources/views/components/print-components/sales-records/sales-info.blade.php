<div class="mt-6">
    {{-- Heading --}}
    <table class="table summary-table table-xs rounded-box">
        <thead>
            <tr class=" bg-gray-300">
                <th colspan="12" class="text-xs">SALES RECORDS</th>
            </tr>
        </thead>

        <tbody>
            {{-- <span class="hidden">{{ $index = 0}}</span> --}}
            <colgroup>
                <col style="width:3%;">
                <col style="width:7%;">
                <col style="width:12%;">
                <col style="width:7%;">
                <col style="width:7%;">
                <col style="width:13%;">
                <col style="width:10%;">
                <col style="width:10%;">
                <col style="width:12%;">
                <col style="width:11%;">
                <col style="width:7%;">
            </colgroup>

            @if (count($result) > 0)
                <span class="hidden">{{ $index = 0}}</span>
                <tr class="table-row text-center">
                    <th>SER</th>
                    <th>DATE</th>
                    <th>ITEM</th>
                    <th>CP (FCFA)</th>
                    <th>SP (FCFA)</th>
                    <th>TOTAL QTY</th>
                    <th>SALES - CASH <br />(FCFA)</th>
                    <th>SALES - CREDIT <br />(FCFA)</th>
                    <th>EXPECTED PROFIT <br />(FCFA)</th>
                    <th>ACTUAL PROFIT <br />(FCFA)</th>
                    <th>DEBT <br />(FCFA)</th>
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
                    <th>(j)</th>
                    <th>(k)</th>

                </tr>

                @foreach ($result as $date => $items)
                    <span class="hidden">{{ ++$index}}</span>
                    @foreach ($items['salesHistory'] as $key => $value)
                        <tr>
                            @if ($loop->first)
                                <td rowspan="{{ count($items['salesHistory']) }}">{{ $index }}.
                                </td>

                                <td rowspan="{{ count($items['salesHistory']) }}">
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

                            <td>
                                {{ $value['total_quantity'] }}
                                (
                                {{ $value['cash_quantity'] }} cash,
                                {{ $value['credit_quantity'] }} credit
                                )
                            </td>


                            <td>
                                {{ number_format($value['cash_total'], 2, '.', ',') }}
                            </td>

                            <td>
                                {{ number_format($value['credit_total'], 2, '.', ',') }}
                            </td>

                            <td>
                                {{ number_format($value['expected_profit'], 2, '.', ',') }}
                            </td>

                            <td>
                                {{ number_format($value['actual_profit'], 2, '.', ',') }}
                            </td>

                            <td>
                                {{ number_format($value['debt'], 2, '.', ',') }}
                            </td>
                        </tr>
                    @endforeach
                    <tr>
                        {{-- <td></td> --}}
                        <td colspan="6">Totals</td>
                        <td class="border border-gray-300 text-xs font-bold">
                            {{ number_format($items['totals']['total_cash_total'], 2, '.', ',') }}
                        </td>
                        <td class="border border-gray-300 text-xs font-bold">
                            {{number_format($items['totals']['total_credit_total'], 2, '.', ',') }}
                        </td>
                        <td class="border border-gray-300 text-xs font-bold">
                            {{ number_format($items['totals']['total_expected_profit'], 2, '.', ',') }}
                        </td>

                        <td class="border border-gray-300 text-xs font-bold">
                            {{ number_format($items['totals']['total_actual_profit'], 2, '.', ',') }}
                        </td>

                        <td class="border border-gray-300 text-xs font-bold">
                            {{ number_format($items['totals']['total_debt'], 2, '.', ',') }}
                        </td>
                    </tr>

                    <tr>
                        <td colspan="6" rowspan="1" class=" border-none h-6"></td>
                    </tr>
                @endforeach

                <tr>
                    <td class="border border-gray-300 text-xs font-bold" colspan="5">GRAND TOTAL</td>
                    <td></td>

                    <td class="border border-gray-300 text-xs font-bold">
                        {{ number_format($saleGrandTotal['grand_total_cash_total'], 2, '.', ',') }}
                    </td>
                    <td class="border border-gray-300 text-xs font-bold">
                        {{number_format($saleGrandTotal['grand_total_credit_total'], 2, '.', ',') }}
                    </td>
                    <td class="border border-gray-300 text-xs font-bold">
                        {{ number_format($saleGrandTotal['grand_total_expected_profit'], 2, '.', ',') }}
                    </td>

                    <td class="border border-gray-300 text-xs font-bold">
                        {{ number_format($saleGrandTotal['grand_total_actual_profit'], 2, '.', ',') }}
                    </td>

                    <td class="border border-gray-300 text-xs font-bold">
                        {{ number_format($saleGrandTotal['grand_total_debt'], 2, '.', ',') }}
                    </td>
                </tr>

            @else
                <colgroup>
                    <col style="width:100%;">
                </colgroup>
                <tr>
                    <td class="border border-gray-300" colspan="12">No Sales Record Data Available for Period</td>
                </tr>
            @endif


        </tbody>
    </table>
</div>