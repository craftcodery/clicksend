<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

  <style>
    {!! str_replace('px', 'pt', file_get_contents(asset('css/app.css'))) !!}

    @page {
      margin: 0;
      padding: 0;
    }

    body {
      margin: 0;
    }

    .content {
      margin-top: 408px;
      margin-left: 31px;
      width: 1011px;
      height: 1041px;
      padding: 5pt 10pt;
      overflow: hidden;
    }
  </style>
</head>

<body>
  <div class="content redactor-styles">{!! $content !!}</div>
</body>
</html>
