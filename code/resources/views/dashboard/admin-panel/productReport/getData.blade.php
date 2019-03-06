
@foreach( $proRprts as $proRprt )
    @php $stckIn = $proRprt->proQuan+$proRprt->saleRtrnQuan;
     $stckOut = $proRprt->proRtrnQuan+$proRprt->salenQuan;
      $bal = $stckIn-$stckOut; @endphp
                    <tr class="even pointer">
                        <td> {{ $proRprt->name }} </td>
                        <td class=" ">
                            <table class="table table-striped" style="background-color: transparent;">
                                <tr style="background-color: transparent;">
                                    <td style="width: 33.3%;background-color: transparent;">{{ !empty($proRprt->proQuan) ? $proRprt->proQuan : 0}}</td>
                                    <td style="width: 33.3%;background-color: transparent;">{{ !empty($proRprt->saleRtrnQuan) ? $proRprt->saleRtrnQuan : 0 }}</td>
                                    <td style="width: 33.3%;background-color: transparent;"> {{ $stckIn }} </td>
                                </tr>
                            </table>

                        </td>
                        <td class=" ">

                            <table class="table table-striped" style="background-color: transparent;">
                                <tr style="background-color: transparent;">
                                    <td style="width: 33.3%;background-color: transparent;">{{ !empty($proRprt->salenQuan) ? $proRprt->salenQuan : 0 }}</td>
                                    <td style="width: 33.3%;background-color: transparent;">{{ !empty($proRprt->proRtrnQuan) ? $proRprt->proRtrnQuan : 0  }}</td>
                                    <td style="width: 33.3%;background-color: transparent;">{{ $stckOut }}</td>
                                </tr>
                            </table>
                        </td>
                        <td> {{$bal}} </td>
                    </tr>

@endforeach

