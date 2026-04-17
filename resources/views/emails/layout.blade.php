<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        body {
            background-color: #060606;
            color: #e8e0d0;
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            margin: 0;
            padding: 0;
            line-height: 1.6;
        }
        .container {
            max-width: 600px;
            margin: 40px auto;
            background-color: #0d0d0d;
            border: 1px solid #1a1a1a;
            padding: 40px;
        }
        .header {
            text-align: center;
            margin-bottom: 40px;
            border-bottom: 1px solid #1a1a1a;
            padding-bottom: 20px;
        }
        .logo {
            font-size: 24px;
            letter-spacing: 0.2em;
            text-transform: uppercase;
            color: #f5ede0;
            text-decoration: none;
        }
        .content {
            margin-bottom: 40px;
        }
        h1 {
            color: #b8935a;
            font-size: 22px;
            font-weight: 300;
            margin-bottom: 20px;
            text-transform: uppercase;
            letter-spacing: 0.1em;
        }
        p {
            margin-bottom: 15px;
            font-size: 15px;
            color: #e8e0d0;
        }
        .footer {
            text-align: center;
            color: #6b6358;
            font-size: 12px;
            border-top: 1px solid #1a1a1a;
            padding-top: 20px;
        }
        .highlight {
            color: #b8935a;
            font-weight: bold;
        }
        .code-box {
            background-color: #161616;
            border: 1px solid #b8935a;
            padding: 20px;
            text-align: center;
            font-size: 20px;
            letter-spacing: 0.3em;
            margin: 30px 0;
            color: #f5ede0;
        }
        .btn {
            display: inline-block;
            background-color: #b8935a;
            color: #060606;
            padding: 12px 25px;
            text-decoration: none;
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <a href="{{ config('app.url') }}" class="logo">Obscura</a>
        </div>
        
        <div class="content">
            @yield('content')
        </div>
        
        <div class="footer">
            <p>&copy; 2026 xviilab — Burak Yıldırım.<br>
            Kadıköy | İstanbul</p>
        </div>
    </div>
</body>
</html>
