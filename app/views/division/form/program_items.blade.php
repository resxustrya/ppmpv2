@extends('division.layout.main')
@section('content')
<table class="table">
    <tr>
        <td><strong>{{ $data['section']}}</strong></td>
    </tr>
    <tr>
        <td>{{ $data['program']}}</td>
        
    </tr>
    <tr>
        <td>{{ $data['venue']}}</td>
    </tr>    
</table>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>Item Name</th>
            <th>Unit</th>
            <th>Q1 Qty</th>
            <th>Q1 Amt</th>
            <th>Q2 Qty</th>
            <th>Q2 Amt</th>
            <th>Q3 Qty</th>
            <th>Q3 Amt</th>
            <th>Q4 Qty</th>
            <th>Q4 Amt</th>
        </tr>
    </thead>
    <tbody>
        @foreach($data['program_items'] as $item)
            @if($item->item)
                <?php $total = 0; ?>
                <tr>
                    <td>{{ $item->item }}</td>
                    <td>{{ $item->unit }}</td>
                    <td>{{ $item->q1_qty}}</td>
                    <td>
                        @if($item->q1_amt > 0)
                            ({{ number_format($item->q1_amt,2)}}) <br />
                        @endif
                    </td>
                    <td>{{ $item->q2_qty}}</td>
                    <td>
                        @if($item->q2_amt > 0)
                            ({{ number_format($item->q2_amt,2)}}) <br />
                        @endif
                    </td> 
                    <td>{{ $item->q3_qty}}</td>
                    <td>
                        @if($item->q3_amt > 0)
                            ({{ number_format($item->q3_amt,2)}}) <br />
                        @endif
                    </td>    
                    <td>{{ $item->q4_qty}}</td>
                    <td>
                        @if($item->q4_amt > 0)
                            ({{ number_format($item->q4_amt,2)}}) <br />
                        @endif
                    </td>
                </tr>
            @endif    
        @endforeach
    </tbody>
</table>
@endsection