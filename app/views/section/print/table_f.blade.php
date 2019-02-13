
@extends('section.layout.layout')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h4>{{ $head }}</h4>
                <form action="{{ asset('print/print_table_f.php') }}" method="POST">
                    <input type="hidden" name="section" value="{{ Auth::user()->section }}" />
                    <input type="hidden" name="division" value="{{ Auth::user()->division }}" />
                    <table class="table table-bordered">
                        <tr>
                            <th>Select</th>
                            <th>Item Name</th>
                        </tr>
                        @foreach($table_f as $f)
                            <tr>
                                <td><input type="checkbox" name="items[]" value="{{ $f->item }}" /></td>
                                <td>{{ $f->item }}</td>
                            </tr>
                        @endforeach
                    </table>
                    <button type="submit" class="btn btn-success">
                        <span class="glyphicon glyphicon-print"></span> Print
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('js')
    
@endsection
