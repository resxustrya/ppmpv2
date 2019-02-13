<form action="{{ asset('print/print_bydate.php')}}" method="POST">
<input type="hidden" name="section" value="{{ Auth::user()->section }}" />
<input type="hidden" name="division" value="{{ Auth::user()->division }}" />
    <div class="form-group">
        <select name="expense" class="form-control">
            @foreach(DB::table('ppmp_code')->where('id','<>',1)->where('id','<>',2)->get() as $code)
                <option value="{{ $code->id }}">{{ $code->expense_name }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="from">Date From</label>
        <input type="date" name="from" required class="form-control">
    </div>
    <div class="form-group">
        <label for="to">Date From</label>
        <input type="date" name="to" required class="form-control">
    </div>
    <div class="row">
        <div class="button-demo col-sm-12">
            <button type="submit" class="btn btn-success btn-lg">Submit</button>
        </div>
    </div>
</form>



