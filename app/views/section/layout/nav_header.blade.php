
<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0;background-color:white;" id="ppmp_nav">
    <div class="navbar-header" style="background-color:white;">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="{{ asset('section/table_a') }}" style="background-color:#2ECC71;color:white;">DOH 7 | PPMP</a>
    </div>
    @if(Auth::check())
        <!-- /.navbar-header -->
        <ul class="nav navbar-top-links navbar-left" style="background-color:white;">
            <li class="dropdown">
                <a href="javascript:void(0);" id="save" title="File" class="btn" >
                    <i class="glyphicon glyphicon-floppy-disk"></i> <b>Save</b>
                </a>
                <!-- /.dropdown-messages -->
            </li>
            <!-- /.dropdown -->
            <li class="dropdown">
                <a href="#" class="dropdown-toggle"  data-toggle="dropdown" data-submenu="" aria-expanded="false">
                    <span class="glyphicon glyphicon-tasks"></span> Expenses <span class="caret"></span>
                </a>
                <ul class="dropdown-menu">
                    <li class="dropdown-submenu">
                        <a tabindex="0">OFFICE SUPPLIES</a>
                        <ul class="dropdown-menu">
                            <li class="dropdown-header">CONSUMABLE </li>
                            <li class="divider"></li>
                            <li><a tabindex="0" href="{{ asset('section/table_a') }}">(a.) Per Employee</a></li>
                            <li><a tabindex="0" href="{{ asset('section/table_b') }}">(b.) Per Section</a></li>
                            <li><a tabindex="0" href="{{ asset('section/table_c') }}">(c.) Training Supplies</a></li>
                            <li><a tabindex="0" href="{{ asset('section/table_d') }}">(d.) Equipment Consumable</a></li>
                            <li class="divider"></li>
                            <li class="dropdown-header"> NON-CONSUMABLE </li>
                            <li class="divider"></li>
                            <li><a tabindex="0" href="{{ asset('section/table_e') }}">(a.) Per Section</a></li>
                            <li class="divider"></li>
                            <li><a tabindex="0" href="{{ asset('section/table_z')}}">OTHER COMMON-USE OFFICE SUPPLIES SPECIFICALLY USED ONLY BY CONCERENED SECTION</a></li>
                        </ul>
                    </li>
                    <li class="dropdown-submenu">
                        <a tabindex="0">SEMI-EXPANDABLE EQUIPEMENT AND FURNITURE</a>
                        <ul class="dropdown-menu">
                            <li class="dropdown-header"> COMMON-USE/REGULAR/STANDARD OFFICE/IT/TRAINING EQUIPMENT/FURNITURE </li>
                            <li><a tabindex="0" href="{{ asset('section/table_f') }}">(a.) Per Employee</a></li>
                            <li><a tabindex="0" href="{{ asset('table_f/print')}}">Print Per Employee</a></li>
                            <li><a tabindex="0" href="{{ asset('section/table_g') }}">(b.) Per Section / Division</a></li>
                            <li><a tabindex="0" href="{{ asset('table_g/print') }}">Print Per Section / Division</a></li>
                        </ul>
                    </li>
                    <li class="divider"></li>
                    <li class="dropdown-header">OPEN LIST</li>
                    @foreach(DB::table('ppmp_code')->where('id','<>',1)->where('id','<>',2)->get() as $code)
                        @if($code->oneline == 1)
                            <li><a href="{{ asset('section/open-list/'.$code->id) }}">{{ $code->expense_name }}</a></li>
                        @else
                            <li class="dropdown-submenu">
                                <a tabindex="0">{{ $code->expense_name }}</a>
                                <ul class="dropdown-menu">
                                    <li><a tabindex="0" href="{{ asset('section/open-list/'.$code->id) }}">Items</a></li>
                                    <li><a tabindex="0" href="{{ asset('print_openlist/'.$code->id)}}">Print by Expense</a></li>
                                    <li class="dropdown-submenu">
                                        <a tabindex="0">Programs</a>
                                        <ul class="dropdown-menu">
                                            <li><a onclick="create_program(this,{{ $code->id}});" href="javascript:void(0);" data-link="{{ asset('create/program')}}" title="Create a new program to be added to ppmp">Create New</a></li>
                                            <li class="divider"></li>
                                            <li class="dropdown-header">List of Programs</li>
                                            @foreach(DB::table('program_name')->where('ppcode','=',$code->id)->where('section','=',Auth::user()->section)->get() as $program)
                                                <li class="dropdown-submenu">
                                                    <a href="#">{{ $program->name }}</a>
                                                    <ul class="dropdown-menu">
                                                        <li class="dropdown-header">Program Venues</li>
                                                        <?php
                                                            $venues = DB::table('program_training_venue')
                                                                ->leftJoin('training_venue','program_training_venue.venue_id','=', 'training_venue.id')
                                                                ->where('program_training_venue.program_id','=',$program->id)
                                                                ->orderBy('training_venue.order','ASC')
                                                                ->get();
                                                        ?>
                                                        @foreach($venues as $venue)
                                                            <li><a href="{{ asset('section/program/venue/'.$program->id.'/'.$venue->id) }}">{{ $venue->venue }}</a> </li>
                                                        @endforeach
                                                    </ul>
                                                </li>
                                            @endforeach
                                            <li class="divider"></li>
                                            <li class="dropdown-header">Remove Programs</li>
                                            @foreach(DB::table('program_name')->where('ppcode','=',$code->id)->where('section','=',Auth::user()->section)->get() as $program)
                                                <li>
                                                    <a href="{{ asset('delete/program/'.$program->id)}}" onclick="return confirm('Do you want to delete this program');" style="color:#F3927D;"><span class="glyphicon glyphicon-trash"> </span> {{ $program->name }}</a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                        @endif
                    @endforeach
                </ul>
            </li>
            <!-- /.dropdown -->

            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    <i class="glyphicon glyphicon-print"></i> Print
                    <i class="fa fa-caret-down"></i>
                </a>
                <ul class="dropdown-menu">
                    <li><a href="{{ asset('print/print_plan.php?section='.Auth::user()->section.'&division='.Auth::user()->division) }}" target="_blank"> Print Whole</a></li>
                    <li><a href="{{ asset('print/print_table_a.php?section='.Auth::user()->section.'&division='.Auth::user()->division) }}" target="_blank">Print Consumale/ Per Employee</a></li>
                    <li><a href="{{ asset('print/print_table_b.php?section='.Auth::user()->section.'&division='.Auth::user()->division) }}" target="_blank">Print Consumale/ Per Section</a></li>
                    <li><a href="{{ asset('other_common_used')}}">Other Common Used</a></li>
                    <li><a href="javascript:void(0)" id="print_date" data-url="{{ asset('print-bydate') }}">Print By Date Added</a></li>
                    <li><a href="javascript:void(0)" id="print_program" data-url="{{ asset('print-program') }}">Print By Program</a></li>
                </ul>
            </li>

            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    <span class="glyphicon glyphicon-user"> </span>
                        {{ strtoupper(DB::table('section')->where('id','=',Auth::user()->section)->first()->short) }}
                    <i class="fa fa-caret-down"></i>
                </a>
                <ul class="dropdown-menu dropdown-user">
                    <li>
                        <a href="{{ asset('logout') }}"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                    </li>
                </ul>
            </li>
            <li><strong style="font-size:12px;font-weight: bold;">{{ Session::get('page') }}</strong></li>
            <!-- /.dropdown -->
            <!-- /.dropdown -->
        </ul>
    @endif    
</nav>