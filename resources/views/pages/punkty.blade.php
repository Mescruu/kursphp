@extends('layouts.app')
<!--css do poszczegolnej strony-->
@section('assets')

@endsection

@section('content')
    <h1>Historia punktów</h1>
    <table>
        <tr>
            <td>
                Ilość
            </td>
            <td>
                Komentarz
            </td>
            <td>
                Nauczyciel
            </td>
            <td>
                Data
            </td>
        </tr>
        @for($i = 0; $i < $iterations; $i++)
        <tr>
            <td>
                {{$ilosc[$i]}}
            </td>
            <td>
                {{$komentarz[$i]}}
            </td>
            <td>
                {{$nauczyciel[$i]}}
            </td>
            <td>
                {{$data[$i]}}
            </td>
        </tr>
        @endfor
    </table>
@endsection