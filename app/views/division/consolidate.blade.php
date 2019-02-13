
@extends('division.layout.main')
@section('content')
<section class="content" style="padding: 7px;" id="get_expense" data-expense="{{ asset('get/expense') }}">
    <ul  style="text-decorration :none;" class="timeline">
        <li class="time-label">
            <span class="bg-green">
                I. OFFICE SUPPLIES
            </span>
        </li>
        <!--
        <li>
            <div class="timeline-item">
                <h3 class="timeline-header"><a href="javascript:void(0);">A. COMMON-USE/REGULAR/STANDARD OFFICE SUPPLIES</a></h3>
                <div class="timeline-body">
                    <ul id="get_section" data-section="{{ asset('get/sections')}}">
                        <li><strong>1. CONSUMABLE</strong>
                            <ul>
                                <li><strong>a. PER EMPLOYEE</strong><span> (You can only change the quantity in this items)</span>
                                    <div class="table_con">
                                        <table>
                                            <thead>
                                                <tr>
                                                    <th width="15%">Item Description / General Description</th>
                                                    <th width="5px">Unit</th>
                                                    <th width="7px">Unit Cost</th>
                                                    {{-
                                                        @foreach(DB::table('section')->where('division','=', Auth::user()->division)->get(['short']) as $section)
                                                        <th width="7px">{{ $section->short }}</th>
                                                        @endforeach
                                                    -}}
                                                    
                                                    <th width="7px">Total Quantity</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                {{-
                                                    @foreach(DB::table('table_a')->where('created_by','=','8888')->orderBy('item','ASC')->get() as $item)
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
                                                                $quantity = DB::table('table_a')
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
                                                -}}
                                                
                                            </tbody>
                                        </table>
                                    </div>
                                </li>
                                <li><strong>b. PER SECTION</strong>
                                    <div class="table_con">
                                        <table>
                                            <thead>
                                                <tr>
                                                    <th width="15%">Item Description / General Description</th>
                                                    <th width="5px">Unit</th>
                                                    <th width="7px">Unit Cost</th>
                                                    {{--
                                                        @foreach(DB::table('section')->where('division','=', Auth::user()->division)->get(['short']) as $section)
                                                        <th width="7px">{{ $section->short }}</th>
                                                        @endforeach
                                                    --}}
                                                    
                                                    <th width="7px">Total Quantity</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                {{-
                                                    @foreach(DB::table('table_b')->where('created_by','=','8888')->orderBy('item','ASC')->get() as $item)
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
                                                            $quantity = DB::table('table_b')
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
                                                -}}
                                                
                                            </tbody>
                                        </table>
                                    </div>    
                                </li>
                                <li><strong>c. TRAINING SUPPLIES</strong>
                                    <div class="table_con">
                                        <table>
                                            <thead>
                                                <tr>
                                                    <th width="15%">Item Description / General Description</th>
                                                    <th width="5px">Unit</th>
                                                    <th width="7px">Unit Cost</th>
                                                    {{-
                                                    @foreach(DB::table('section')->where('division','=', Auth::user()->division)->get(['short']) as $section)
                                                        <th width="7px">{{ $section->short }}</th>
                                                    @endforeach
                                                    -}}
                                                    <th width="7px">Total Quantity</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                {{-
                                                @foreach(DB::table('table_c')->where('created_by','=','8888')->orderBy('item','ASC')->get() as $item)
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
                                                            $quantity = DB::table('table_c')
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
                                                -}}
                                            </tbody>
                                        </table>
                                    </div>
                                </li>
                                <li><strong>d. EQUIPMENT CONSUMABLE</strong>
                                    <div class="table_con">
                                        <table>
                                            <thead>
                                                <tr>
                                                    <th width="15%">Item Description / General Description</th>
                                                    <th width="5px">Unit</th>
                                                    <th width="7px">Unit Cost</th>
                                                    {{-
                                                    @foreach(DB::table('section')->where('division','=', Auth::user()->division)->get(['short']) as $section)
                                                        <th width="7px">{{ $section->short }}</th>
                                                    @endforeach
                                                    -}}
                                                    <th width="7px">Total Quantity</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                {{-
                                                @foreach(DB::table('table_d')->where('division','=',Auth::user()->division)->groupBy('code')->orderBy('item','ASC')->get() as $item)
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
                                                            $quantity = DB::table('table_d')
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
                                                -}}
                                            </tbody>
                                        </table>
                                    </div>
                                </li>
                            </ul>
                        </li>
                        <li><strong>2. NON-CONSUMABLE</strong>
                            <ul>
                                <li><strong>a. PER SECTION</strong>
                                    <div class="table_con">
                                        <table>
                                            <thead>
                                                <tr>
                                                    <th width="15%">Item Description / General Description</th>
                                                    <th width="5px">Unit</th>
                                                    <th width="7px">Unit Cost</th>
                                                    {{-
                                                    @foreach(DB::table('section')->where('division','=', Auth::user()->division)->get(['short']) as $section)
                                                        <th width="7px">{{ $section->short }}</th>
                                                    @endforeach
                                                    -}}
                                                    <th width="7px">Total Quantity</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                {{-
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
                                                -}}
                                            </tbody>
                                        </table>
                                    </div>    
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </li>    
        <li>
            <div class="timeline-item">
                <h3 class="timeline-header"><a href="javascript:void(0)">B. OTHER COMMON-USE OFFICE SUPPLIES SPECIFICALLY USED ONLY BY CONCERNED SECTION (OPEN LIST BY SECTION / PROGRAM)</a></h3>
                <div class="timeline-body">
                    <ul>
                        <li>
                            <ul>
                               <div class="table_con">
                                    <table>
                                        <thead>
                                            <tr>
                                                <th width="15%">Item Description / General Description</th>
                                                <th width="5px">Unit</th>
                                                <th width="7px">Unit Cost</th>
                                                {{-
                                                @foreach(DB::table('section')->where('division','=', Auth::user()->division)->get(['short']) as $section)
                                                    <th width="7px">{{ $section->short }}</th>
                                                @endforeach
                                                -}}
                                                <th width="7px">Total Quantity</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            {{-
                                            @foreach(DB::table('table_z')->where('division','=',Auth::user()->division)->groupBy('item')->orderBy('item','ASC')->get() as $item)
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
                                                        $quantity = DB::table('table_z')
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
                                                    <?php $section_total = $section_total > 0 ? number_format($section_total) : NULL; ?>
                                                    <td>{{ $section_total }}</td>

                                                @endforeach
                                                <?php $total = $total > 0 ? number_format($total) : ''; ?>
                                                <td>{{ $total }}</td>
                                            </tr>    
                                            @endforeach
                                            -}}
                                        </tbody>
                                    </table>
                                </div>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </li>
        <li class="time-label">
            <span class="bg-green">
                II. SEMI-EXPANDABLE EQUIPMENT AND FURNITURE
            </span>
        </li>
        <li>
            <div class="timeline-item">
                <h3 class="timeline-header"><a href="javascript:void(0);">A. COMMON-USE/REGULAR/STANDARD OFFICE/IT/TRAINING EQUIPMENT/FURNITURE</a></h3>
                <div class="timeline-body">
                    <ul>
                        <li>
                            <ul>
                                <li><strong>a. PER EMPLOYEE</strong>
                                    <div class="table_con">
                                        <table>
                                            <thead>
                                                <tr>
                                                    <th width="15%">Item Description / General Description</th>
                                                    <th width="5px">Unit</th>
                                                    <th width="7px">Unit Cost</th>
                                                    {{-
                                                    @foreach(DB::table('section')->where('division','=', Auth::user()->division)->get(['short']) as $section)
                                                        <th width="7px">{{ $section->short }}</th>
                                                    @endforeach
                                                    -}}
                                                    <th width="7px">Total Quantity</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                {{-
                                                @foreach(DB::table('table_f')->where('created_by','=','8888')->orderBy('item','ASC')->get() as $item)
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
                                                            $quantity = DB::table('table_f')
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
                                                -}}
                                            </tbody>
                                        </table>
                                    </div>
                                </li>
                                <li><strong>b. PER SECTION/DIVISION</strong>
                                    <div class="table_con">
                                        <table>
                                            <thead>
                                                <tr>
                                                    <th width="15%">Item Description / General Description</th>
                                                    <th width="5px">Unit</th>
                                                    <th width="7px">Unit Cost</th>
                                                    {{-
                                                    @foreach(DB::table('section')->where('division','=', Auth::user()->division)->get(['short']) as $section)
                                                        <th width="7px">{{ $section->short }}</th>
                                                    @endforeach
                                                    -}}
                                                    <th width="7px">Total Quantity</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                {{-
                                                @foreach(DB::table('table_g')->where('created_by','=','8888')->orderBy('item','ASC')->get() as $item)
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
                                                            $quantity = DB::table('table_g')
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
                                                -}}
                                            </tbody>
                                        </table>
                                    </div>    
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </li>
        <!--
            {{-
        <?php $start = 9; ?>
        <?php $expense = DB::table('ppmp_code')->where('id','<>','1')->where('id','<>','2')->get(); ?>
        @foreach($expense as $code)
            <li class="time-label" id="view_code{{$code->id}}">
            @if($code->oneline == 0)
                <span class="bg-green">
                {{ $code->expense_name }}
                </span>
            @else
                <span style="background-color :#EDBB99;color:white;">
                {{ $code->expense_name }}
                </span>
            @endif
            </li>
            <li>
                @if($code->oneline == 0)
                    <div class="timeline-item">
                        <div class="timeline-body">
                            <ul>
                                <li>
                                    <ul>
                                        <li>
                                            <div class="table_con">
                                                <table>
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
                                                        @foreach(DB::table('open_list')->where('ppcode','=',$code->id)->where('division','=',Auth::user()->division)->groupBy('item')->orderBy('item','ASC')->get() as $item)
                                                            @if($item->item)
                                                                <?php $total = 0; ?>
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
                                                                            $quantity = DB::table('open_list')
                                                                                            ->where('ppcode','=',$code->id)
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
                                                            @endif    
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                @else
                <div class="timeline-item">
                    <div class="timeline-body">
                        <ul>
                            <li>
                                <ul>
                                    <li>
                                        <div id="container{{ $code->id }}" data-save="{{ asset('supply/save/section/open-list') }}" data-get="{{ asset('supply/get/section/open-list') }}" data-expense="{{ $code->id}}" class="status"></div>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
                <?php
                    $json = "[";
                    $count = 1;
                    $items = DB::table('open_list')
                            ->where('created_by','=',Auth::user()->division)
                            ->where('ppcode','=',$code->id)
                            ->groupBy('item')
                            ->orderBy('date_added','DESC')
                            ->where('item','<>','')
                            ->get();
                    if($items) {
                        foreach($items as $item)
                        {
                            if($item->item) {
                                $total = ($item->q1_qty * $item->q1_amt) + ($item->q2_qty * $item->q2_amt) + ($item->q3_qty * $item->q3_amt) + ($item->q4_qty * $item->q4_amt);
                                $json .= "['" . $item->code ."','".$item->item ."','" . $item->unit ."','" . number_format($item->q1_qty) . "','" . number_format($item->q1_amt,2) ."','" . number_format($item->q2_qty) ."','" . number_format($item->q2_amt,2) . "','" . number_format($item->q3_qty) . "','" . number_format($item->q3_amt,2) . "','" . number_format($item->q4_qty) ."','" . number_format($item->q4_amt,2) ."']";
                                if($count < count($items)) {
                                    $json.= ",";
                                }
                                $count++;
                            }
                        }
                        $json.="]";
                    } else {
                        $json .= "['','".$code->expense_name ."','','','','','','','','','','']";
                         $json.="]";
                    }
                ?>
                @include('division.open_list_js')
                @endif
            </li>
            @if($code->oneline == 0)
                <?php
                $sections = DB::table('section')->where('division','=',Auth::user()->division)->get();
                $label = null;
                ?>
                <?php $expense_programs = DB::table('program_name')->where('ppcode','=', $code->id)->where('division','=',Auth::user()->division)->count(); ?>
                @if($expense_programs > 0)
                    <li class="time-label">
                        <span style="background-color:#737373;color:white;">SECTION PROGRAMS AND OTHER EXPENSES</span>
                    </li>
                    @foreach($sections as $section)
                        <?php $label = 'A'; ?>
                        <?php $program_made = DB::table('program_name')->where('ppcode','=',$code->id)->where('section','=',$section->id)->where('division','=',Auth::user()->division)->get(); ?>
                            @if(count($program_made))
                                <li>
                                    <div class="timeline-item">
                                        <h3 class="timeline-header"><a href="javascript:void(0);">{{ $section->description }}</a></h3>
                                        <div class="timeline-body">
                                            <ul>
                                                @foreach($program_made as $program)

                                                    <li><strong> {{ $label.")." }} {{ strtoupper($program->name) }}</strong>
                                                        <ul>
                                                            <?php $venues = DB::table('program_training_venue')->where('program_id','=',$program->id)->get(); ?>

                                                            @foreach($venues as $venue)
                                                                <li><span><b>{{ DB::table('training_venue')->where('id','=',$venue->venue_id)->first()->venue }}</b></span>
                                                                    <div class="table_con">
                                                                        <table>
                                                                            <thead>
                                                                            <tr>
                                                                                <th width="20px">Item Description / General Description</th>
                                                                                <th width="7px">Unit</th>
                                                                                <th width="7px">Q1 Qty</th>
                                                                                <th width="7px">Q1 Amt</th>
                                                                                <th width="7px">Q2 Qty</th>
                                                                                <th width="7px">Q2 Amt</th>
                                                                                <th width="7px">Q3 Qty</th>
                                                                                <th width="7px">Q3 Amt</th>
                                                                                <th width="7px">Q4 Qty</th>
                                                                                <th width="7px">Q4 Amt</th>
                                                                            </tr>
                                                                            </thead>
                                                                            <tbody>
                                                                            @foreach(DB::table('program_items')->where('program_id','=',$venue->program_id)->where('venue_id','=',$venue->venue_id)->get() as $program_item)
                                                                                <tr>
                                                                                    <td>{{ $program_item->item }}</td>
                                                                                    <td><center>{{ $program_item->unit }}</center></td>
                                                                                    <td><center>{{ number_format($program_item->q1_qty)}}</center></td>
                                                                                    <td><center>{{ number_format($program_item->q1_amt,2)}}</center></td>
                                                                                    <td><center>{{ number_format($program_item->q2_qty)}}</center></td>
                                                                                    <td><center>{{ number_format($program_item->q2_amt,2)}}</center></td>
                                                                                    <td><center>{{ number_format($program_item->q3_qty)}}</center></td>
                                                                                    <td><center>{{ number_format($program_item->q3_amt,2)}}</center></td>
                                                                                    <td><center>{{ number_format($program_item->q4_qty)}}</center></td>
                                                                                    <td><center>{{ number_format($program_item->q4_amt,2)}}</center></td>
                                                                                </tr>
                                                                            @endforeach
                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    </li>
                                                    <?php $label++; ?>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </li>
                            @endif
                    @endforeach
                @endif
            @endif
        @endforeach
        -}}
                            -->
        <li>
            <i class="fa fa-clock-o bg-gray"></i>
        </li>
    </ul>
</section>
<span data-openlist="{{ asset('openlist/forms') }}"></span>
@endsection
@section('js')
    <script>
        $('.scroll').click(function(){
            var id = $(this).data('id');
            document.getElementById('view_code'+id).scrollIntoView();
        });
    </script>
@endsection
