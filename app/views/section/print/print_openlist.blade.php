
@extends('section.layout.layout')
@section('content')
<form action="{{ $form_action }}" method="POST">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h4>{{ $head }}</h4>
                <input type="hidden" name="section" value="{{ Auth::user()->section }}" />
                <input type="hidden" name="division" value="{{ Auth::user()->division }}" />
                <input type="hidden" name="ppcode" value="{{ $ppcode }}" />
                <table class="table table-bordered">
                    <tr>
                        <th>Select</th>
                        <th>Item Name</th>
                        <th>Unit</th>
                        <th>Q1 Qty</th>
                        <th>Q1 Amt.</th>
                        <th>Q2 Qty</th>
                        <th>Q2 Amt</th>
                        <th>Q3 Qty</th>
                        <th>Q3 Amt</th>
                        <th>Q4 Qty</th>
                        <th>Q4 Amt</th>
                    </tr>
                    @foreach($items as $item)
                        <tr>
                            <td><input type="checkbox" name="items[]" value="{{ $item->code}}" /></td>
                            <td style="width=20px;">{{ $item->item }}</td>
                            <td>{{ $item->unit }}</td>
                            <td>{{ $item->q1_qty }}</td>
                            <td>{{ $item->q1_amt }}</td>
                            <td>{{ $item->q2_qty }}</td>
                            <td>{{ $item->q2_amt }}</td>
                            <td>{{ $item->q3_qty }}</td>
                            <td>{{ $item->q3_amt }}</td>
                            <td>{{ $item->q4_qty }}</td>
                            <td>{{ $item->q4_amt }}</td>
                        </tr>
                    @endforeach
                </table>
                
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <button type="submit" class="btn btn-success btn-lg">
                    <span class="glyphicon glyphicon-print"></span> Print
                </button>
            </div>
        </div>
    </div>
</form>    
@endsection
@section('js')
    
@endsection
