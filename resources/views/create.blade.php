<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <form id="whois-lookup-form" action="" method="POST">
        {{ method_field('POST') }}
        {{ csrf_field() }}
            <label for="domain">Domain</label>
            <input name="domain" type="text" class="form-control"
                placeholder="Domain name">
            @if ($errors->has('domain'))
                <span class="help-block">
                    <strong>{{ $errors->first('domain') }}</strong>
                </span>
            @endif
        </div>

        <button type="submit" class="btn btn-default btn-block btn-lg">Search</button>
    </form>

    <br>

    <div id="response"></div>




    <script>
        $(function() {
            $("#whois-lookup-form").on("submit", function(event) {
                event.preventDefault();
                var request = $.ajax({
                    url: $(this).attr('action'),
                    method: $(this).attr('method'),
                    data: $(this).serialize(),
                    dataType: "json",
                    cache: false
                });
            });
        });

        </body> 
		</html>
