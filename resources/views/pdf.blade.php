<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

  <style>
    {!! str_replace('px', 'pt', file_get_contents(asset('css/app.css'))) !!}

    @page {
      margin: .75in;
      padding: 0;
    }

    body {
      margin: 0;
      background: #fff;
    }

    .content {
      font-size: 12pt;
      margin: 0;
      padding: 0;
    }
  </style>
</head>

<body>
  <div class="content redactor-styles">{!! $content !!}</div>
</body>
</html>
