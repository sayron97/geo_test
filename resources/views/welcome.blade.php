<!DOCTYPE html>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>


    <form action="{{ route('geo.upload') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">

            <div class="col-md-6">
                <input type="file" name="file" class="form-control">
            </div>

            <div class="col-md-6">
                <button type="submit" class="btn btn-success">Upload</button>
            </div>

        </div>
    </form>

    <form id="listForm" action="{{ route('geo.list') }}" method="GET" enctype="multipart/form-data">
    <select name="id">
        @isset($list)
            @foreach($list as $item)
                <option @if(isset($id) && $item->id === $id) selected @endif value="{{ $item->id }}">{{ $item->name }}</option>
            @endforeach
        @endisset
    </select>

    <input id="range" name="range" type="range" step="1" min="0" max="2000" list="rangeList" onchange="changeInput()">
    <datalist name="location" id="rangeList">
            @for ($i = 0; $i < 2000; $i++)
              <option value="{{ $i }}" label="{{ $i }}">
            @endfor
    </datalist>
    <span id="rangeValue">@if(isset($range)){{$range}} @else 1 @endif</span>
    </form>

    @isset($response)
        <table border="1">
            <caption>Range table</caption>
            <tr>
                <th>Place</th>
                <th>Range</th>

            </tr>
                @foreach($response as $item)
                <tr>
                <td>{{ $item->name }}</td>
                    <td>{{ round($item->distance, 2) }} km</td>
                </tr>
                @endforeach
        </table>
    @endisset
    </body>
</html>

<script>
    function changeInput() {
        value = document.getElementById('range').value;
        document.getElementById('rangeValue').innerHTML = value;
        document.getElementById("listForm").submit();
    }
</script>
