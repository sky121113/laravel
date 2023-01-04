<!-- View stored in resources/views/firstview.blade.php -->

<html>
    <body>
        <h1>Hello, {{ $name }}</h1>

        <h1>Hello, {!! $name !!}.</h1>

        <h1>Hello, @{{ name }}.</h1>
        @verbatim
            <div class="container">
                Hello, {{ name }}.
            </div>
        @endverbatim
        <br>
        <div><input type='text' name="acc" placeholder="請輸入帳號"></div>
        <div><input type='text' name="name" placeholder="請輸入名稱"></div>
        <div><input type='text' name="gender" placeholder="請輸入性別">male or woman</div>
        <div><input type='text' name="born" placeholder="請輸入生日">ex:1999-11-11</div>
        <div><input type='button' value="確定" ></div>
    </body>
    <script type="text/javascript">
        
    </script>
</html>
