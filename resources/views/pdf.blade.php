<!doctype html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- <link rel="stylesheet" href="{{ asset('pdf.css') }}?v={{ filemtime(public_path('pdf.css')) }}" type="text/css"> --}}


    <title>ticket</title>
</head>

<body>
    @foreach ($data as $item)
        <table class="w-full">
            <tr>
                <div class="ticket_logo">
                    <h2>#gbc</h2>
                </div>
                <td class="w-half">
                    <h2>ticket ID:
                        {{ $item['token'] }}
                    </h2>
                </td>
            </tr>
        </table>

        <div class="margin-top">
            <table class="w-full">
                <tr>
                    <td class="w-half">
                        <div>
                            <h4>To:</h4>
                        </div>
                        <div>
                            {{ $item['user_name'] }}
                        </div>
                        <div>kinondon municipal.</div>
                    </td>
                    <td class="w-half">
                        <div>
                            <h4>From:</h4>
                        </div>
                        <div>
                            gbce event services
                        </div>
                        <div>Dar es salaam</div>
                    </td>
                </tr>
            </table>
        </div>

        <div class="margin-top">
            <table class="products">
                <tr>
                    <th>Description</th>
                    <th>Date</th>
                    <th>time</th>
                    <th>location</th>
                </tr>
                <tr class="items">

                    <td>
                        {{ $item['description'] }}
                    </td>
                    <td>
                        {{ $item['date'] }}
                    </td>
                    <td>
                        {{ $item['time'] }}
                    </td>
                    <td>
                        {{ $item['location'] }}
                    </td>

                </tr>
            </table>
        </div>
        {{--
    <div class="total">
        Total: $129.00 USD
    </div> --}}

        <div class="footer margin-top">
            <div>
                EVENT: {{ $item['title'] }}
            </div>
            <div> we are so excited to see you there!</div>
            <div>&copy; gbce event services</div>
        </div>
    @endforeach
</body>

</html>

<style>


    h4 {
        margin: 0;
    }

    .w-full {
        width: 100%;
    }

    .w-half {
        width: 50%;
    }

    .margin-top {
        margin-top: 1.25rem;
    }

    .footer {
        font-size: 0.875rem;
        padding: 1rem;
        background-color: rgb(241 245 249);
    }

    table {
        width: 100%;
        border-spacing: 0;
    }

    table.products {
        font-size: 0.875rem;
    }

    table.products tr {
        background-color: rgb(96 165 250);
    }

    table.products th {
        color: #ffffff;
        padding: 0.5rem;
    }

    table tr.items {
        background-color: rgb(241 245 249);
    }

    table tr.items td {
        padding: 0.5rem;
    }

    .total {
        text-align: right;
        margin-top: 1rem;
        font-size: 0.875rem;
    }
</style>
