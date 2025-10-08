<div class="mt-6">
    {{-- Heading --}}
    <table class="table table-xs rounded-box">
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
                    <th class="border border-gray-300 text-xs">SER</th>
                    <th class="border border-gray-300 text-xs">DATE</th>
                    <th class="border border-gray-300 text-xs">ITEM</th>
                    <th class="border border-gray-300 text-xs">CP (FCFA)</th>
                    <th class="border border-gray-300 text-xs">SP (FCFA)</th>
                    <th class="border border-gray-300 text-xs">TOTAL QTY</th>
                    <th class="border border-gray-300 text-xs">SALES - CASH <br/>(FCFA)</th>
                    <th class="border border-gray-300 text-xs">SALES - CREDIT <br/>(FCFA)</th>
                    <th class="border border-gray-300 text-xs">EXPECTED PROFIT <br/>(FCFA)</th>
                    <th class="border border-gray-300 text-xs">ACTUAL PROFIT <br/>(FCFA)</th>
                    <th class="border border-gray-300 text-xs">DEBT <br/>(FCFA)</th>
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
                    <th class="border border-gray-300 text-xs">(j)</th>
                    <th class="border border-gray-300 text-xs">(k)</th>

                </tr>

                @foreach ($result as $date => $items)
                    <span class="hidden">{{ ++$index}}</span>
                    @foreach ($items['salesHistory'] as $key => $value)
                        <tr>
                            @if ($loop->first)
                                <td rowspan="{{ count($items['salesHistory']) }}" class="border border-gray-300 text-xs">{{ $index }}.</td>

                                <td rowspan="{{ count($items['salesHistory']) }}" class="border border-gray-300 text-xs">{{ Carbon\Carbon::parse($date)->format('d M y') }}</td>
                            @endif
                            <td class="border border-gray-300 text-xs">{{ $value['item'] }}</td>

                            <td class="border border-gray-300 text-xs">
                                {{ number_format($value['cost_price']) }}
                            </td>

                            <td class="border border-gray-300 text-xs">
                                {{ number_format($value['selling_price']) }}
                            </td>

                            <td class="border border-gray-300 text-xs">
                                {{ $value['total_quantity'] }}
                                (
                                    {{ $value['cash_quantity'] }} cash,
                                    {{ $value['credit_quantity'] }} credit
                                )
                            </td>


                            <td class="border border-gray-300 text-xs">
                                {{ number_format($value['cash_total']) }}
                            </td>

                            <td class="border border-gray-300 text-xs">
                                {{ number_format($value['credit_total']) }}
                            </td>

                            <td class="border border-gray-300 text-xs">
                                {{ number_format($value['expected_profit']) }}
                            </td>

                            <td class="border border-gray-300 text-xs">
                                {{ number_format($value['actual_profit']) }}
                            </td>

                            <td class="border border-gray-300 text-xs">
                                {{ number_format($value['debt']) }}
                            </td>
                        </tr>
                    @endforeach
                    <tr>
                        {{-- <td></td> --}}
                        <td class="border border-gray-300 text-xs" colspan="6">Totals</td>
                        <td class="border border-gray-300 text-xs font-bold">
                            {{ number_format($items['totals']['total_cash_total']) }}
                        </td>
                        <td class="border border-gray-300 text-xs font-bold">
                            {{number_format($items['totals']['total_credit_total']) }}
                        </td>
                        <td class="border border-gray-300 text-xs font-bold">
                            {{ number_format($items['totals']['total_expected_profit']) }}
                        </td>

                        <td class="border border-gray-300 text-xs font-bold">
                            {{ number_format($items['totals']['total_actual_profit']) }}
                        </td>
                        
                        <td class="border border-gray-300 text-xs font-bold">
                            {{ number_format($items['totals']['total_debt']) }}
                        </td>
                    </tr>

                    <tr>
                        <td colspan="6" rowspan="1" class=" border-none h-6"></td>
                    </tr>
                @endforeach

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