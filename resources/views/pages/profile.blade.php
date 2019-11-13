@extends('layouts.app')
<!--css do poszczegolnej strony-->
@section('assets')

@endsection

@section('content')
<h1>

</h1>
<div class="container">
    <table class="table table-striped">
        <tr>
            <td>
                id
            </td>
            <td>
                {{ Auth::user()->id}}
            </td>
        </tr>
        <tr>
            <td>
                nazwa
            </td>
            <td>
                {{ Auth::user()->imie}}
            </td>
        </tr>
    </table>
</div>
@endsection