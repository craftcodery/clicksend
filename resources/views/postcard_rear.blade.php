<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

  <style>
    .redactor-styles {
        margin: 0;
        padding: 16pt 18pt;
        color: #333;
        font-family: "Trebuchet MS", "Helvetica Neue", Helvetica, Tahoma, sans-serif;
        font-size: 1em;
        line-height: 1.5;
        box-sizing: border-box;
    }
    
    .redactor-styles *,
    .redactor-styles *:before,
    .redactor-styles *:after {
        box-sizing: inherit;
    }
    
    .redactor-styles[dir="rtl"] {
        direction: rtl;
        unicode-bidi: embed;
    }
    
    .redactor-styles[dir="rtl"] ul li,
    .redactor-styles[dir="rtl"] ol li {
        text-align: right;
    }
    
    .redactor-styles[dir="rtl"] ul,
    .redactor-styles[dir="rtl"] ol,
    .redactor-styles[dir="rtl"] ul ul,
    .redactor-styles[dir="rtl"] ol ol,
    .redactor-styles[dir="rtl"] ul ol,
    .redactor-styles[dir="rtl"] ol ul {
        margin-left: 1.5em;
    }
    
    .redactor-styles[dir="rtl"] figcaption {
        text-align: right;
    }
    
    .redactor-styles ul[dir="rtl"],
    .redactor-styles ul[dir="rtl"] ul,
    .redactor-styles ul[dir="rtl"] ol,
    .redactor-styles ol[dir="rtl"],
    .redactor-styles ol[dir="rtl"] ul,
    .redactor-styles ol[dir="rtl"] ol {
        margin-right: 1.5em;
    }
    
    .redactor-styles ul[dir="rtl"] li,
    .redactor-styles ol[dir="rtl"] li {
        text-align: right;
    }
    
    .redactor-styles a,
    .redactor-styles a:hover {
        color: #3397ff;
    }
    
    .redactor-styles p,
    .redactor-styles dl,
    .redactor-styles blockquote,
    .redactor-styles hr,
    .redactor-styles pre,
    .redactor-styles table,
    .redactor-styles figure,
    .redactor-styles address {
        padding: 0;
        margin: 0;
        margin-bottom: 1em;
    }
    
    .redactor-styles ul,
    .redactor-styles ol {
        padding: 0;
    }
    
    .redactor-styles ul,
    .redactor-styles ul ul,
    .redactor-styles ul ol,
    .redactor-styles ol,
    .redactor-styles ol ul,
    .redactor-styles ol ol {
        margin: 0 0 0 1.5em;
    }
    
    .redactor-styles ul li,
    .redactor-styles ol li {
        text-align: left;
    }
    
    .redactor-styles ol ol li {
        list-style-type: lower-alpha;
    }
    
    .redactor-styles ol ol ol li {
        list-style-type: lower-roman;
    }
    
    .redactor-styles ul,
    .redactor-styles ol {
        margin-bottom: 1em;
    }
    
    .redactor-styles h1,
    .redactor-styles h2,
    .redactor-styles h3,
    .redactor-styles h4,
    .redactor-styles h5,
    .redactor-styles h6 {
        font-weight: bold;
        color: #111;
        text-rendering: optimizeLegibility;
        margin: 0;
        padding: 0;
        margin-bottom: 0.5em;
        line-height: 1.2;
    }
    
    .redactor-styles h1 {
        font-size: 2.0736em;
    }
    
    .redactor-styles h2 {
        font-size: 1.728em;
    }
    
    .redactor-styles h3 {
        font-size: 1.44em;
    }
    
    .redactor-styles h4 {
        font-size: 1.2em;
    }
    
    .redactor-styles h5 {
        font-size: 1em;
    }
    
    .redactor-styles h6 {
        font-size: 0.83333em;
        text-transform: uppercase;
        letter-spacing: .035em;
    }
    
    .redactor-styles blockquote {
        font-style: italic;
        color: rgba(0, 0, 0, 0.5);
        border: none;
    }
    
    .redactor-styles table {
        width: 100%;
    }
    
    .redactor-styles time, .redactor-styles small, .redactor-styles var, .redactor-styles code, .redactor-styles kbd, .redactor-styles mark {
        display: inline-block;
        font-family: Consolas, Menlo, Monaco, "Courier New", monospace;
        font-size: 87.5%;
        line-height: 1;
        color: rgba(51, 51, 51, 0.9);
    }
    
    .redactor-styles var, .redactor-styles cite {
        opacity: .6;
    }
    
    .redactor-styles var {
        font-style: normal;
    }
    
    .redactor-styles dfn,
    .redactor-styles abbr {
        text-transform: uppercase;
    }
    
    .redactor-styles dfn[title],
    .redactor-styles abbr[title] {
        text-decoration: none;
        border-bottom: 1pt dotted rgba(0, 0, 0, 0.5);
        cursor: help;
    }
    
    .redactor-styles code, .redactor-styles kbd {
        position: relative;
        top: -1pt;
        padding: 0.25em;
        padding-bottom: 0.2em;
        border-radius: 2pt;
    }
    
    .redactor-styles code {
        background-color: #eff1f2;
    }
    
    .redactor-styles mark {
        border-radius: 2pt;
        padding: 0.125em 0.25em;
        background-color: #fdb833;
    }
    
    .redactor-styles kbd {
        border: 1pt solid #e5e7e9;
    }
    
    .redactor-styles sub,
    .redactor-styles sup {
        font-size: 75%;
        line-height: 0;
        position: relative;
        vertical-align: baseline;
    }
    
    .redactor-styles sub {
        bottom: -0.25em;
    }
    
    .redactor-styles sup {
        top: -0.5em;
    }
    
    .redactor-styles pre {
        font-family: Consolas, Menlo, Monaco, "Courier New", monospace;
        font-size: .9em;
    }
    
    .redactor-styles pre,
    .redactor-styles pre code {
        background-color: #f6f7f8;
        padding: 0;
        top: 0;
        display: block;
        line-height: 1.5;
        color: rgba(51, 51, 51, 0.85);
        overflow: none;
        white-space: pre-wrap;
    }
    
    .redactor-styles pre {
        padding: 1rem;
    }
    
    .redactor-styles table {
        border-collapse: collapse;
        max-width: 100%;
        width: 100%;
    }
    
    .redactor-styles table caption {
        text-transform: uppercase;
        padding: 0;
        color: rgba(0, 0, 0, 0.5);
        font-size: 11pt;
    }
    
    .redactor-styles table th,
    .redactor-styles table td {
        border: 1pt solid #eee;
        padding: 16pt;
        padding-bottom: 15pt;
    }
    
    .redactor-styles table tfoot th,
    .redactor-styles table tfoot td {
        color: rgba(0, 0, 0, 0.5);
    }
    
    .redactor-styles img,
    .redactor-styles video,
    .redactor-styles audio,
    .redactor-styles embed,
    .redactor-styles object {
        max-width: 100%;
    }
    
    .redactor-styles img,
    .redactor-styles video,
    .redactor-styles embed,
    .redactor-styles object {
        height: auto !important;
    }
    
    .redactor-styles img {
        vertical-align: middle;
        -ms-interpolation-mode: bicubic;
    }
    
    .redactor-styles figcaption {
        display: block;
        opacity: .6;
        font-size: 12pt;
        font-style: italic;
        text-align: left;
    }

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
