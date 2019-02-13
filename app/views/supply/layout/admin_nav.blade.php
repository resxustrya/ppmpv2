<nav class="navbar" style="background-color:#00CC99;">
    <div class="container-fluid">
        <div class="navbar-header" style="padding:5px;">
            <a class="navbar-brand">
                <img style="margin-top:-10px;" src="{{ asset('public/asset/images/doh.png')}}" height="50" width="50">
            </a>
            <P class="navbar-brand">
                PROJECT PROCUREMENT MANAGEMENT PLAN
            </P>
        </div>
        <div class="collapse navbar-collapse" id="navbar-collapse">
            <ul class="nav navbar-nav navbar-right">
                
                <li class="dropdown">
                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="glyphicon glyphicon-tasks"></i> INVENTORY<span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu" style="width: 400px; height: 600px; overflow: auto">
                        <li><a href="javascript:void(0);" class="scroll" data-id="1">OFFICE SUPPLIES</a></li>
                        @foreach(DB::table('ppmp_code')->where('id','<>',1)->get() as $code)
                            <li><a class="scroll" href="javascript:void(0);" data-id="{{ $code->id }}">{{ $code->expense_name }}</a></li>
                        @endforeach
                    </ul>
                </li>
                <li><a href="{{ asset('units')}}"><span class="glyphicon glyphicon-filter" aria-hidden="true"></span>UNITS</a>
                <li><a href="{{ asset('logout')}}">LOGOUT</a>
            </ul>
        </div>
    </div>
</nav>
