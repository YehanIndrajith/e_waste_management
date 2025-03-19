@extends('frontend.home.layouts.master')

@section('content')
<section style="padding: 20px;">
    <div style="display: flex; justify-content: space-between; align-items: center;">
        <h2>Repair Shop Directory</h2>
        {{-- <a href="{{ route('home') }}" class="home-button">Home</a> --}}
    </div>

    <table border="1" style="width: 100%; border-collapse: collapse; margin-top: 10px;">
        <thead>
            <tr>
                @if(!empty($rows) && count($rows) > 0)
                    @foreach ($rows[0] as $header)
                        <th style="border: 1px solid #ddd; padding: 8px; background-color: #f2f2f2;">{{ $header }}</th>
                    @endforeach
                @endif
            </tr>
        </thead>
        <tbody>
            @foreach ($rows as $index => $row)
                @if($index > 0) {{-- Skip header row --}}
                    <tr>
                        @foreach ($row as $column)
                            <td style="border: 1px solid #ddd; padding: 8px;">{{ $column }}</td>
                        @endforeach
                    </tr>
                @endif
            @endforeach
        </tbody>
    </table>
</section>

<!-- Add CSS for styling -->
<style>
    .home-button {
        padding: 10px 20px;
        background-color: lightgreen;
        color: black;
        text-decoration: none;
        font-size: 16px;
        font-weight: bold;
        border-radius: 5px;
        transition: background-color 0.3s ease;
    }

    .home-button:hover {
        background-color: #90ee90; /* Lighter green */
    }
</style>
@endsection
