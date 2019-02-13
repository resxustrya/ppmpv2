@extends('division.layout.main')
@section('content')
<table class="table table-bordered">
    <thead>
        <tr>
            <th width="15%">Item Description / General Description</th>
            <th width="5px">Unit</th>
            <th width="7px">Unit Cost</th>
            
            @foreach(DB::table('section')->where('division','=', Auth::user()->division)->get(['short']) as $section)
                <th width="7px">{{ $section->short }}</th>
            @endforeach
            
            <th width="7px">Total Quantity</th>
        </tr>
    </thead>
    <tbody>
        
        @foreach(DB::table('table_e')->where('created_by','=','8888')->orderBy('item','ASC')->get() as $item)
        <?php $total = 0; $section_total = 0; ?>
        <tr>
            <td>{{ $item->item }}</td>
            <td>{{ $item->unit }}</td>
            <td>
                @if($item->q1_amt > 0)
                    ({{ number_format($item->q1_amt,2)}}) <br />
                @endif
                @if($item->q2_amt > 0)
                    ({{ number_format($item->q2_amt,2)}}) <br />
                @endif
                @if($item->q3_amt > 0)
                    ({{ number_format($item->q3_amt,2)}}) <br />
                @endif
                @if($item->q4_amt > 0)
                    ({{ number_format($item->q4_amt,2)}}) <br />
                @endif
            </td>
            @foreach(DB::table('section')->where('division','=', Auth::user()->division)->get() as $section)
            <?php
                $section_total = 0;
                $quantity = DB::table('table_e')
                                ->where('item','=',$item->item)
                                ->where('created_by','=',$section->id)
                                ->first();
                ?>
                @if(isset($quantity))
                    <?php
                        $section_total = $quantity->q1_qty + $quantity->q2_qty + $quantity->q3_qty + $quantity->q4_qty;
                        $total += $section_total;
                    ?>
                @endif
                <?php $section_total = $section_total > 0 ? number_format($section_total) : ''; ?>
                <td>{{ $section_total }}</td>
            @endforeach
            <?php $total = $total > 0 ? number_format($total) : ''; ?>
            <td>{{ $total }}</td>
        </tr>    
        @endforeach
        
    </tbody>
</table>
@endsection