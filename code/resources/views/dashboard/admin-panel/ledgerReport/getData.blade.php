


        <tr>
            <td colspan="6" style="font-size: 30px;text-align: center;"> {{ !empty($acntHead->name) ? $acntHead->name : '' }} Ledger </td>
        </tr>

        <tr>
            <td colspan="6" style="text-align: right;">Opening Balance: <span> {{ !empty($bfrBalance) ? $bfrBalance : 0 }} </span></td>
        </tr>

        @php $createBal = $bfrBalance @endphp

        @foreach( $getLedgers as $getLedger )

            <tr>
                <td> {{ $getLedger->id }} </td>
                <td> {{ $getLedger->date }} </td>
                <td> {{ $getLedger->detail }} </td>
                <td> {{ $getLedger->dr }} </td>
                <td> {{ $getLedger->cr }} </td>
                <td> @if( (!empty($acntHead->head_id) && $acntHead->head_id != 0) && ($acntHead->head_id == 1 || $acntHead->head_id == 5) )
{{--                        @php $createBal = $createBal + $getLedger->dr + (-$getLedger->cr) @endphp--}}
                         {{ $createBal = $createBal + $getLedger->dr + (-$getLedger->cr) }}
                    @else
{{--                        @php $createBal = $createBal + $getLedger->cr + (-$getLedger->dr) @endphp--}}
                        {{ $createBal = $createBal + $getLedger->cr + (-$getLedger->dr) }}
                    @endif
                </td>
            </tr>

        @endforeach



