
<h5>Print By Program</h5>
<form action="{{ asset('create-program')}}" method="POST" id="form_program">
    <div class="form-group" data-getprogram="{{ asset('d/get/program') }}" data-getvenue="{{ asset('d/get/venue') }}">
        <select name="expense" class="form-control" onchange="expense_change(this);">
            @foreach(DB::table('ppmp_code')->where('id','<>',1)->where('id','<>',2)->get() as $code)
                <option value="{{ $code->id }}">{{ $code->expense_name }}</option>
            @endforeach
        </select>
    </div>
</form>
