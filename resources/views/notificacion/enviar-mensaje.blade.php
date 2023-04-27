

<form method="POST" action="/enviar-mensaje">
    @csrf
    <textarea name="mensaje"></textarea>
    <button type="submit">Enviar mensaje</button>
</form>