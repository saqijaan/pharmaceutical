

@if( isset($accountSubHeads) && !empty($accountSubHeads) && $check == 'new' )
    @foreach( $accountSubHeads as $accountSubHead )
        <option value="{{ $accountSubHead->id }}"> {{ $accountSubHead->name }}</option>
    @endforeach
@endif

@if( $check == 'update' )
    @foreach( $accountSubHeads as $accountSubHead )
        <option value="{{ $accountSubHead->id }}" @if( isset($accounts) && !empty($accounts) ) {{ ( $accountSubHead->id == $accounts->sub_head_id ) ? 'selected' : '' }} @endif> {{ $accountSubHead->name }}</option>
    @endforeach
@endif