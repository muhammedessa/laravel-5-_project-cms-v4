<html>
    <body>
        <h1>Hello, {{ Auth::user()->name }}</h1>

        

        @if (Auth::user()->hasRole('admin'))
        <h1>Hello, {{Auth::user()->name}} is admin</h1>
        @endif

        @if (Auth::user()->hasPermission('create-post'))
        <h1>Hello, {{Auth::user()->name}} you can create post</h1>
        @endif


    </body>
</html>


 