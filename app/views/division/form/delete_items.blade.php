@extends('division.layout.main')
@section('content')
    <table class="table table-bordered">
        <tr>
            <th>Code</th>
            <th>Item</th>
            <th>*</th>
        </tr>
        @foreach($items as $item)
            <tr>
                <td>{{ $item->code }}</td>
                <td>{{ $item->item }}</td>
                <td><a href="{{ asset('division/delete/'. $item->code) }}" class="btn btn-danger btn-xs">Delete</a></td>
            </tr>
        @endforeach
    </table>
@endsection