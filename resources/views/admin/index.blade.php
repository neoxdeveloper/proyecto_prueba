<h1>Bienvenido</h1>
<p>
    @if($message = Session::get('mensaje'))
        {{ $message }}
    @endif
</p>