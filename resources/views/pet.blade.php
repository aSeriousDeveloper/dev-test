@extends('layouts.app')

@section('title', 'Home')

@section('content')
    <h3 class="typewriter mb-4">
        <span id="typewriterText">{{$breed['name']}}</span>
    </h3>

    <a href="{{ route('dashboard') }}" class="btn btn-primary">Go Back</a>

    <table class="table my-2">
        <thead>
          <tr>
            <th scope="col">Property</th>
            <th scope="col">Value</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($breed as $property => $value)
                <tr>
                    <th scope="row">{{ $property }}</th>
                    <td>{{ $value }}</td>
                </tr>
            @endforeach
        </tbody>
      </table>

@endsection
